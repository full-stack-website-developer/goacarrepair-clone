<?php 
declare(strict_types = 1);

$conn  = getConnection();


function handleSettingsView() : void{
    $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Settings'
    ];
    viewAdmin('settings/list', $data);
}

function handleSettingsCreate() : void
{
    $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Settings',
        'href' => '/admin/settings',
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Create',
    ];

    viewAdmin('settings/create', $data);
}

function handleSettingsStore() : void
{
    // print_r($_POST);
    // die;

    global $conn;
    $request = $_POST;

    $logo = null;
    $email = htmlspecialchars($request['email']);
    $phone = htmlspecialchars($request['phone']);
    
    $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];


    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads';


    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['logo']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['logo']['name']);
        $fileSize = $_FILES['logo']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $logo = 'uploads/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    $_SESSION['errors'] = [];
    if (empty($logo)){
        $_SESSION['errors']['logoError'] = "Logo is required";
    }
    if (empty($phone)){
        $_SESSION['errors']['phoneError'] = "Phone is required";
    }
    if (empty($logo)){
        $_SESSION['errors']['emailError'] = "Email is required";

    }

    if ($_SESSION['errors'] > 0){
        redirect('/admin/settings/create');
    }

    $sql = "INSERT INTO settings (
        logo,
        email,
        phone
    ) VALUES(
        :logo,
        :email,
        :phone
    )";

    $stmt = $conn->prepare($sql);
    $executed = $stmt->execute([
        ':logo' => $logo,
        ':email' => $email,
        ':phone' => $phone
    ]);

    if($executed){
      $_SESSION['success'] = "Setting Created Successfully";
        redirect('/admin/settings');
    }
}

function  handleSettingDelete()  :void
{
    global $conn;
    // die('here');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = "DELETE FROM settings WHERE ID = $id";
    $stmt = $conn->prepare($sql);
    $executed =  $stmt->execute();
    if($executed){
        $_SESSION["success"] = "Setting Deleted Successfully";
       redirect('/admin/settings');
    }
}

function handleSettingsEdit() : void
{
   
    $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin'
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Settings',
        'href' => '/admin/settings',
    ];
    $data['breadcrumbs'][] = [
        'title' => 'Edit',
    ];

    viewAdmin('settings/edit', $data);
}
function handleSettingsUpdate() : void
{
    
    global $conn;
    $request = $_POST;

    $logo = null;
    $email = htmlspecialchars($request['email']);
    $phone = htmlspecialchars($request['phone']);
    
    $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];


    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads';


    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['logo']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['logo']['name']);
        $fileSize = $_FILES['logo']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $logo = 'uploads/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT logo from settings WHERE id = :id");
    $stmt->execute([
        ":id" => $id,
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$logo && isset($result['logo'])){
         $logo = $result['logo'];
    }   


    $_SESSION['errors'] = [];
    if (empty($phone)){
        $_SESSION['errors']['phoneError'] = "Phone is required";
    }
    if (empty($logo)){
        $_SESSION['errors']['emailError'] = "Email is required";

    }

    if (count($_SESSION['errors']) > 0){
        redirect('/admin/settings/edit?editId=' . $id);
    }


    $sql = "UPDATE settings set
     logo = :logo,
     phone = :phone,
     email = :email WHERE id = $id";

    $stmt = $conn->prepare($sql);
    $executed = $stmt->execute([
        ':logo' => $logo,
        ':email' => $email,
        ':phone' => $phone
    ]);

    if($executed){
      $_SESSION['success'] = "Setting Updated Successfully";
        redirect('/admin/settings');
    }
}




 

?>