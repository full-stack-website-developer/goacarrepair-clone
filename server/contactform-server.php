<?php 

declare (strict_types = 1);
$conn = getConnection();

function handleContactsView(){
    $data['breadcrumbs'] = [];

    $data['breadcrumbs'][] = [
        'title' => 'home',
        'href' => '/admin',
    ];

    $data['breadcrumbs'][] = [
        'title' => 'contacts',
    ];

    viewAdmin('contacts/list', $data);
}
function handleContactFormStore() : void
{
    global $conn;
 
    $request = $_POST;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact'])){ 
        // $name = htmlspecialchars($request['name']);
        // $email = htmlspecialchars($request['email']);
        // $phone = htmlspecialchars($request['phone']);
        // $message = htmlspecialchars($request['message']);

        $name = $request['name'];
        $email = $request['email'];
        $phone = $request['phone'];
        $message = $request['message'];

        $page = "contact";

        $_SESSION['errors'] = [];
        if (empty($name)){
            $_SESSION['errors']["nameError"] = "Name is required";
        }

        if (empty($email)){
            $_SESSION['errors']["emailError"] = "email is required";
        } 
        
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']["emailError"] = "Invalid email format";
        }

        if (empty($phone)){
            $_SESSION['errors']["phoneError"] = "phone is required";
        }
    
        if (empty($message)){
            $_SESSION['errors']["messageError"] = "message is required";
        }

        if (count($_SESSION['errors']) > 0) {
            redirect('/contact');
        }

        $sql = "INSERT INTO contacts (name, email, phone , message, page) VALUES (:name, :email, :phone, :message, :page)";

        $stmt = $conn->prepare($sql);

        $executed = $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':message' => $message,
            ':page' => $page,
        ]);
        
        if ($executed) {
            $_SESSION["success"] = "Enquiry Sent Successfully!";
            redirect('/contact');
        }
    }

    if (
        (
            $_SERVER['REQUEST_METHOD'] === 'POST' && 
            isset($_POST['bookService'])
        ) || 
        isset($_POST['servicePageContact'])
    ){
        $name = htmlspecialchars($request['name']);
        $email = htmlspecialchars($request['email']);
        $phone = htmlspecialchars($request['phone']);
        $service = htmlspecialchars($request['service']);

        if(isset($_POST['servicePageContact'])){
            $slug = $request['slug'];
        }

        $page = "home";

        if(isset($_POST['servicePageContact'])){
            $page = "Service";
        }

       $_SESSION['errors'] = [];

        if(empty($name)){
            $_SESSION['errors']["nameError"] = "Name is required";
        }
        if(empty($email)){
            $_SESSION['errors']["emailError"] = "email is required";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']["emailError"] = "Invalid email format";
        }
        if(empty($phone)){
            $_SESSION['errors']["phoneError"] = "phone is required";
        }
    
        if(empty($service)){
            $_SESSION['errors']["serviceError"] = "service is required";
        }

        if ($_SESSION['errors']) {
            if (isset($_POST['servicePageContact'])){    
                redirect('/single-service/' . $slug); 
            }
            redirect('/');
        }

        $sql = "INSERT INTO contacts (name, email, phone , service, page) VALUES (:name, :email, :phone, :service, :page)";

        $stmt = $conn->prepare($sql);

        $executed = $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':service' => $service,
            ':page' => $page,
        ]);
        
        if ($executed) {
            $_SESSION["success"] = "Enquiry Sent Successfully!";

            if (isset($_POST['servicePageContact'])){
                redirect('/single-service/' . $slug); 
            }
            redirect('/');
        }
     }
}

function validateContactFields(
        string $name,
        string $email,
        string $phone,
        string $service,
        string $message,

) : bool
{
    $error = false;
    if(empty($name)){
        $_SESSION["nameError"] = "Name is required";
        $error = true;
    }
    if(empty($email)){
        $_SESSION["emailError"] = "email is required";
        $error = true;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["emailError"] = "Invalid email format";
    }
    if(empty($phone)){
        $_SESSION["phoneError"] = "phone is required";
        $error = true;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact'])){
        if(empty($message)){
            $_SESSION["messageError"] = "message is required";
            $error = true;
        }
    }

    if(empty($service)){
            $_SESSION["serviceError"] = "service is required";
            $error = true;
    }
    return $error;
}
    

function handleContactDelete() : void{
    global $conn;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = "DELETE FROM contacts where id = $id";

    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute();

    if ($executed){
        $_SESSION['success'] = "Enquiry Deleted Successfully";
        redirect('/admin/contacts');
    }
}

function replyRecipient(): void
{
    $request = $_POST;
    $to = $request['recipientEmail'] ?? '';
    // echo $to;
    // die;

    $subject = "Testing";
    $message = htmlspecialchars($request['reply'] ?? ''); 
    $headers = "From: choudaryshehroz450@gmail.com\r\n";

    $check = mail($to, $subject, $message, $headers);
    
    if ($check) {
        $_SESSION["success"] = "Response Sent Successfully";
        redirect('/admin/contacts');
    } else {
        $_SESSION['error'] = "Response Not Sent. Please check mail settings.";
    }
}


?>