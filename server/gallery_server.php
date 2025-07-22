<?php 

declare (strict_types = 1);
$conn = getConnection();

function handleGalleryView() : void
{
    $data['breadcrumbs'] = [];

    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];

    $data['breadcrumbs'][] = [
        'title' => 'gallery',
    ];

    viewAdmin('gallery/list', $data);
}
function handleGalleryCreateView() : void
{
    $data['breadcrumbs'] = [];

    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];

    $data['breadcrumbs'][] = [
        'title' => 'gallery',
        'href' => '/admin/gallery',
    ];

    $data['breadcrumbs'][] = [
        'title' => 'create',
    ];
    viewAdmin('gallery/create', $data);   
}

function handleGalleryEditView() :  void
{
    
    $data['breadcrumbs'] = [];

    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];

    $data['breadcrumbs'][] = [
        'title' => 'gallery',
        'href' => '/admin/gallery',
    ];

    $data['breadcrumbs'][] = [
        'title' => 'edit',
    ];
    viewAdmin('gallery/edit', $data);   
}

function handleGalleryStore() : void
{
    global $conn;
    $galleryImage = (string)null;
    $sortOrder = htmlspecialchars($_POST['sort_order']);

    
    $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];


    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/gallery';


    if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gallery_image']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['gallery_image']['name']);
        $fileSize = $_FILES['gallery_image']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $galleryImage = 'uploads/gallery/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    $_SESSION["errors"] = [];
    if (empty($galleryImage)){
        $_SESSION['errors']["galleryError"] = "Image is required";
    }

    if ($_SESSION["errors"]){
        redirect('create');
    }

    $sql = "INSERT INTO galleries (gallery_image, sort_order) VALUES (:gallery_image, :sort_order)";

    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute([
        ':gallery_image' => $galleryImage,
        ':sort_order' => $sortOrder
    ]);

    if ($executed) {
        $_SESSION["success"] = "Gallery Created Successfully";
        redirect('/admin/gallery');
    }
}



function handleGalleryUpdate() : void
{
    global $conn;
    $id = $_POST['editId'] ?? '';
    $galleryImage = null;
    $galleryImage = 0;
    $galleryImage = false;
    $galleryImage = "";


    $sortOrder = htmlspecialchars($_POST['sort_order']);

    $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];

    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/gallery';


    if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gallery_image']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['gallery_image']['name']);
        $fileSize = $_FILES['gallery_image']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $galleryImage = 'uploads/gallery/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

       // Get existing image if no new one was uploaded
        $existingGalleryStmt = $conn->prepare("SELECT gallery_image FROM galleries WHERE id = :id");
        $existingGalleryStmt->execute([':id' => $id]);
        $result = $existingGalleryStmt->fetch(PDO::FETCH_ASSOC);

        if (!$galleryImage && isset($result['gallery_image'])) {
            $galleryImage = $result['gallery_image'];
        }

    $_SESSION['errors'] = [];
    if (empty($galleryImage)){
        $_SESSION['errors']["galleryError"] = "Image is required";
    }

    $id = $_POST['editId'];
    
    if ($_SESSION['errors']){
        redirect('/admin/galleries/edit?editId=' . $id);
    }

    $sql = "UPDATE galleries SET gallery_image = :gallery_image , sort_order = :sort_order WHERE id = $id";

    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute([
        ':gallery_image' => $galleryImage,
        ':sort_order' => $sortOrder,
    ]);
    
    if ($executed) {
        $_SESSION["success"] = "Gallery Updated Successfully";
        redirect('/admin/gallery');
    }
}



function handleGalleryDelete() : void
{
    global $conn;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

        $sql = "DELETE FROM galleries WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
    
    if($result){
        $_SESSION["success"] = "Gallery Deleted Successfully";
        redirect('/admin/gallery');
    }
    else{
        $_SESSION["error"] = "Sorry Gallery Dont Deleted";
        redirect('/admin/gallery');
    }
}
?>