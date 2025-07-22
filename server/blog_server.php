<?php 

    declare(strict_types = 1);

    $conn = getConnection();

function  handleBlogView() : void
{
    viewAdmin('/blog/list');
}

function handleBlogCreate()  :void
{
    $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'Home',
        'href' => '/admin',
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Blog',
        'href' => '/admin/blog'
    ];

    $data['breadcrumbs'][] = [
        'title' => 'Blog',
        'href' => ''
    ];
    viewAdmin('/blog/create', $data);
}

function handleBlogStore() : void
{
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment-btn'])) {

        $blogId = $_POST['commentId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $slug = $_POST['slug'];
        $userComment = $_POST['comment'];
        $website = $_POST['website'];
        $time = date('m/d/Y h:i:s a', time());

        $sql = "SELECT comment FROM blog WHERE id = :blogId";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':blogId' => $blogId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row['comment']){
            $row['comment'] = "";
        }

        $existingComments = json_decode($row['comment'], true) ?? [];

        $existingComments[] = [
            'name' => $name,
            'email' => $email,
            'comment' => $userComment,
            'website' => $website,
            'time' => $time,
        ];

        $jsonComment = json_encode($existingComments);

        $sql = "UPDATE blog SET comment = :comment WHERE id = :blogId";
        $stmt = $conn->prepare($sql);
        $executed = $stmt->execute([
            ':comment' => $jsonComment,
            ':blogId' => $blogId,
        ]);

        if ($executed) {
            redirect('/blog/' . $slug);
        }
    }
    
    $request = $_POST;
    $banner = null;
    $title = htmlspecialchars(ucwords($request['title']) ?? '');
    $slug = htmlspecialchars($request['slug']);
    // $order = htmlspecialchars($request['order']);
    $slug = str_replace(" ", '-', $slug);
      $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];

    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/blog';
    
    if (isset($_FILES['otherImages'])) {
        foreach ($_FILES['otherImages']['name'] as $index => $imgName) {

            $tmpName = $_FILES['otherImages']['tmp_name'][$index];
            $newFileName = time() . '_' . basename($imgName);
    
            $uploadPath = $uploadDir . '/' . $newFileName;

            if(move_uploaded_file($tmpName, $uploadPath)){
                $otherImages[] = $newFileName;
            };
        }
    }

    // print_r($otherImages);
    $imageIndex = 0;

    foreach ($_POST['additional'] as &$data) {
        if (isset($data['image']) && isset($otherImages[$imageIndex])) {
            $data['image'] = "uploads/blog/" . $otherImages[$imageIndex];
            $imageIndex++;
        }
    }
    unset($data); 

    $additional=  $_POST['additional'];
     
    $jsonContent = json_encode($additional);

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['banner']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['banner']['name']);
        $fileSize = $_FILES['banner']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $banner = 'uploads/blog/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    $_SESSION['errors'] = [];

    if (empty($banner)){
        $_SESSION['errors']['banner'] = "Banner is Required";
    }
    if (empty($title)){
        $_SESSION['errors']['title'] = "title is Required";
    }
    if (empty($slug)){
        $_SESSION['errors']['slug'] = "slug is Required";
    }


    if(count($_SESSION['errors']) > 0){
        redirect('/admin/blog/create');
    }

    $sql = "INSERT INTO blog (
        title,
        banner,
        content,
        slug
    ) VALUES (
        :title,
        :banner,
        :additional,
        :slug
    )";

    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute([
        ':title' => $title,
        ':banner' => $banner,
        ":additional" => $jsonContent,
        ':slug' => $slug
    ]);

    if($executed){
        $_SESSION["success"] = "Blog Created Successfully";
        redirect('/admin/blog');
    }

}
function handleBlogEditView() : void
{
    viewAdmin('blog/edit');
}

function handleBlogUpdate() : void
{
    echo "<pre>";
    print_r($_FILES);
    print_r($_POST);
  

    global $conn;

    $request = $_POST;
    $banner = null;
    $title = isset($request['title']) ? htmlspecialchars(ucwords($request['title'])) : '';
    $slug = isset($request['slug']) ? htmlspecialchars(str_replace(" ", '-', $request['slug'])) : '';

    // $order = htmlspecialchars($request['order']);
    $slug = str_replace(" ", '-', $slug);
    $id = $request['editId'];
      $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];

    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/blog';
    
    if (isset($_FILES['otherImages'])) {
        foreach ($_FILES['otherImages']['name'] as $index => $imgName) {

            $tmpName = $_FILES['otherImages']['tmp_name'][$index];
            $newFileName = time() . '_' . basename($imgName);
    
            $uploadPath = $uploadDir . '/' . $newFileName;

            if(move_uploaded_file($tmpName, $uploadPath)){
                $otherImages[] = $newFileName;
            };
        }
    }

    
    // print_r($otherImages);
    $imageIndex = 0;

    foreach ($_POST['additional'] as &$data) {
        if (isset($data['image']) && isset($otherImages[$imageIndex])) {
            $data['image'] = "uploads/blog/" . $otherImages[$imageIndex];
            $imageIndex++;
        }
    }
    unset($data); 

     
    $sqll = "SELECT content FROM blog WHERE id = :id";
    $stmt = $conn->prepare($sqll);
    $stmt->execute([
        ':id' => $id,
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $decoded = json_decode($result['content'], TRUE);
    // print_r($decoded);
    // die('here');
    foreach($decoded as $index =>  $content){
       if (isset($content['image'])) {
            $images[] = $content['image'];
       }
    }
    print_r($images);
    
    $imageIndex = 0;
    foreach ($_POST['additional'] as &$block) {
        if (isset($block['image']) && empty($block['image'])) {
            $block['image'] = $images[$imageIndex] ?? null;
        } elseif (isset($block['image']) && !empty($block['image'])) {
            // Do nothing; image already set (new or from upload)
        }
        if (isset($block['image'])) {
            $imageIndex++;
        }
    }

    
    $additional=  $_POST['additional'];
     
    $jsonContent = json_encode($additional);

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['banner']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['banner']['name']);
        $fileSize = $_FILES['banner']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $banner = 'uploads/blog/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    if(empty($banner)){
        $sql = "SELECT * FROM blog WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
        ]);
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);
        $banner = $blog['banner']; 
    }

    $_SESSION['errors'] = [];

    if (empty($banner)) {
        $_SESSION['errors']['banner'] = "Banner is Required";
    }
    if (empty($title)) {
        $_SESSION['errors']['title'] = "title is Required";
    }
    if (empty($slug)) {
        $_SESSION['errors']['slug'] = "slug is Required";
    }


    if(count($_SESSION['errors']) > 0){
        $_SESSION['temp_data'] = $_POST;
        redirect('/admin/blog/edit?editId=' . $id);
    }


    $sql = "UPDATE blog SET title = :title, banner = :banner, content = :additional, slug = :slug WHERE Id = :id";


    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute([
        ':title' => $title,
        ':banner' => $banner,
        ":additional" => $jsonContent,
        ':slug' => $slug,
        ':id' => $id
    ]);

    if($executed){
        $_SESSION["success"] = "Blog Updated Successfully";
        redirect('/admin/blog');
    }
}

function handleBlogDelete() : void
{
    $conn = getConnection();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $sql = "DELETE FROM blog WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $executed = $stmt->execute([
        ":id" => $id,
    ]);

    if ($executed) {
        $_SESSION["success"] = "Blog Deleted Successfully";
        redirect('/admin/blog');
    }
}


?>