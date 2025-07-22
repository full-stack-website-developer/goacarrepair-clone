<?php

declare(strict_types=1);

$conn = getConnection();

function handleDashboard(): void {
    $data['breadcrumbs'] = [];

    $data['breadcrumbs'][] = [
      'title' => 'Dashboard',
      'href' => '/admin'
    ];

    viewAdmin('dashboard', $data);
}

function handleAdminServicesCreate(): void
{
    $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'Home',
        'href' => '/admin',
    ];
    
    $data['breadcrumbs'][] = [
        'title' => 'services',
        'href' => '/admin/services',
    ];

    $data['breadcrumbs'][] = [
        'title' => 'Create',
    ];

    viewAdmin('services/create', $data);
}

function handleAdminServiceEdit() : void
{
        $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'Home',
        'href' => '/admin',
    ];
    
    $data['breadcrumbs'][] = [
        'title' => 'services',
        'href' => '/admin/services',
    ];

    $data['breadcrumbs'][] = [
        'title' => 'Edit',
    ];
    viewAdmin('services/edit', $data);
}

function handleServicesView() : void
{
     $data['breadcrumbs'] = [];
    $data['breadcrumbs'][] = [
        'title' => 'Home',
        'href' => '/admin',
    ];
    
    $data['breadcrumbs'][] = [
        'title' => 'services',
    ];

    viewAdmin('services/list', $data);
}

function handlegalleryCreate() : void
{
   viewAdmin('gallery/create');
}
function handleServiceStore(): void
{
    global $conn;

    $request                        = $_POST;
    $serviceIcon                    = (string)null;
    $slug                           = htmlspecialchars($request['slug'] ?? '');
    $serviceTitle                   = htmlspecialchars(ucwords($request['service_title']) ?? '');
    $ServiceMainDescription         = htmlspecialchars($request['service_main_description'] ?? '');
    $serviceBanner                  = (string)null;
    $specializationHeading          = htmlspecialchars(ucwords($request['specialization_heading']) ?? '');
    $SpecializationSubHeading       = htmlspecialchars(ucwords($request['specialization_sub_heading']) ?? '');
    $specializationDescription      = htmlspecialchars($request['specialization_description'] ?? '');
    $specializationCardsTitle       = json_encode(array_map('htmlspecialchars', ucwords($request['specialization_cards_title']) ?? []));
    $specializationCardsDescription = json_encode(array_map('htmlspecialchars', $request['specialization_cards_description'] ?? []));
    $tipsHeading                    = htmlspecialchars($request['tips_heading'] ?? '');
    $tipsParagraph                  = htmlspecialchars($request['tips_paragraph'] ?? '');
    $tipsCardTitle                  = json_encode(array_map('htmlspecialchars', ucwords($request['tips_card_title'] )?? []));
    $tipsCardDescription            = json_encode(array_map('htmlspecialchars', $request['tips_card_description'] ?? []));
    $question                       = json_encode(array_map('htmlspecialchars', $request['question'] ?? []));
    $answer                         = json_encode(array_map('htmlspecialchars', $request['answer'] ?? []));

    $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/svg+xml'
    ];

    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/single_service';

    if (isset($_FILES['service_banner']) && $_FILES['service_banner']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['service_banner']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['service_banner']['name']);
        $fileSize = $_FILES['service_banner']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $serviceBanner = 'uploads/single_service/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    if (isset($_FILES['service_icon']) && $_FILES['service_icon']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['service_icon']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['service_icon']['name']);
        $fileSize = $_FILES['service_icon']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $serviceIcon = 'uploads/single_service/' . $fileName;
        } else {
            die('Invalid file type or size for icon.');
        }
    }

    if(validateSingleServiceFields(
        $slug,
        $serviceIcon,
        $serviceBanner,
        $serviceTitle,
        $ServiceMainDescription,
        $specializationHeading,
        $SpecializationSubHeading,
        $specializationDescription,
        $specializationCardsTitle,
        $specializationCardsDescription,
        $tipsHeading,
        $tipsParagraph,
        $tipsCardTitle,
        $tipsCardDescription,
        $question,
        $answer
    )){
        $_SESSION["temp_data"] = $_POST;
        redirect('/admin/services/create');
    };

    $sql = "INSERT INTO services (
        service_icon,
        service_title,
        service_image,
        service_main_description,
        specialization_heading,
        specialization_sub_heading,
        specialization_description,
        specialization_card_title,
        specialization_card_description,
        tips_heading,
        tips_paragraph,
        tips_card_title,
        tips_card_description,
        question,
        answer,
        slug
    ) VALUES(
        :serviceIcon,
        :serviceTitle,
        :serviceBanner,
        :ServiceMainDescription,
        :specializationHeading,
        :SpecializationSubHeading,
        :specializationDescription,
        :specializationCardsTitle,
        :specializationCardsDescription,
        :tipsHeading,
        :tipsParagraph,
        :tipsCardTitle,
        :tipsCardDescription,
        :question,
        :answer
        :slug
    )";

    $stmt = $conn->prepare($sql);

    $executed =  $stmt->execute([
        'serviceIcon'                      => $serviceIcon,
        'serviceTitle'                     => $serviceTitle,
        'serviceBanner'                    => $serviceBanner,
        'ServiceMainDescription'           => $ServiceMainDescription,
        'specializationHeading'            => $specializationHeading,
        'SpecializationSubHeading'         => $SpecializationSubHeading,
        'specializationDescription'        => $specializationDescription,
        'specializationCardsTitle'         => $specializationCardsTitle,
        'specializationCardsDescription'   => $specializationCardsDescription,
        'tipsHeading'                      => $tipsHeading,
        'tipsParagraph'                    => $tipsParagraph,
        'tipsCardTitle'                    => $tipsCardTitle,
        'tipsCardDescription'              => $tipsCardDescription,
        'question'                         => $question,
        'answer'                           => $answer,
        'slug'                             => $slug,
    ]);

    if (!$executed) {
        $_SESSION["error"] = "Sorry Service Cannot Created";
        redirect('/admin/services/create');
    } else {
        $_SESSION["success"] =  "service Created successfully";
        redirect('/admin/services');
    }
}

function handleServiceUpdate() : void
{
    global $conn;
   
    $request = $_POST;
    $serviceIcon                    = (string)null;
    $slug                           = htmlspecialchars($request['slug'] ?? '');
    $serviceTitle                   = htmlspecialchars($request['service_title'] ?? '');
    $ServiceMainDescription         = htmlspecialchars($request['service_main_description'] ?? '');
    $serviceBanner                  = (string)null;
    $specializationHeading          = htmlspecialchars($request['specialization_heading'] ?? '');
    $SpecializationSubHeading       = htmlspecialchars($request['specialization_sub_heading'] ?? '');
    $specializationDescription      = htmlspecialchars($request['specialization_description'] ?? '');
    $specializationCardsTitle       = json_encode(array_map('htmlspecialchars', $request['specialization_cards_title'] ?? []));
    $specializationCardsDescription = json_encode(array_map('htmlspecialchars', $request['specialization_cards_description'] ?? []));
    $tipsHeading                    = htmlspecialchars($request['tips_heading'] ?? '');
    $tipsParagraph                  = htmlspecialchars($request['tips_paragraph'] ?? '');
    $tipsCardTitle                  = json_encode(array_map('htmlspecialchars', $request['tips_card_title'] ?? []));
    $tipsCardDescription            = json_encode(array_map('htmlspecialchars', $request['tips_card_description'] ?? []));
    $question                       = json_encode(array_map('htmlspecialchars', $request['question'] ?? []));
    $answer                         = json_encode(array_map('htmlspecialchars', $request['answer'] ?? []));

   $allowedMimeTypes = [
    'image/jpeg',
    'image/png',
    'image/webp',
    'image/gif',
    'image/svg+xml'
    ];

    $maxFileSize = 2 * 1024 * 1024;

    $uploadDir = BASE_PATH . '/public/uploads/single_service';
   

    if (isset($_FILES['service_banner']) && $_FILES['service_banner']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['service_banner']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['service_banner']['name']);
        $fileSize = $_FILES['service_banner']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $serviceBanner = 'uploads/single_service/' . $fileName;
        } else {
            die('Invalid file type or size for banner.');
        }
    }

    if (isset($_FILES['service_icon']) && $_FILES['service_icon']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['service_icon']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['service_icon']['name']);
        $fileSize = $_FILES['service_icon']['size'];
        $fileMime = mime_content_type($fileTmpPath);

        if (in_array($fileMime, $allowedMimeTypes) && $fileSize <= $maxFileSize) {
            $uploadPath = $uploadDir . '/' . $fileName;
            move_uploaded_file($fileTmpPath, $uploadPath);
            $serviceIcon = 'uploads/single_service/' . $fileName;
        } else {
            die('Invalid file type or size for icon.');
        }
    }
        $id = (int)$request['editId'];

        $existingServiceStmt = $conn->prepare("SELECT service_icon, service_image FROM services WHERE id = :id");
        $existingServiceStmt->execute([
            'id' => $id
        ]);
        $existingService = $existingServiceStmt->fetch(PDO::FETCH_ASSOC);

        if (!$serviceIcon && isset($existingService['service_icon'])) {
            $serviceIcon = $existingService['service_icon'];
        }

        if (!$serviceBanner && isset($existingService['service_image'])) {
            $serviceBanner = $existingService['service_image'];
        }

    if (!(validateSingleServiceFields(
        $slug,
        $serviceIcon,
        $serviceBanner,
        $serviceTitle,
        $ServiceMainDescription,
        $specializationHeading,
        $SpecializationSubHeading,
        $specializationDescription,
        $specializationCardsTitle,
        $specializationCardsDescription,
        $tipsHeading,
        $tipsParagraph,
        $tipsCardTitle,
        $tipsCardDescription,
        $question,
        $answer
    ))){
        redirect('/admin/services/edit?editId=' . $id);
    };


    $sql = "UPDATE services SET 
        service_icon = :serviceIcon,
        service_title = :service_title,
        service_image = :service_image,
        service_main_description = :service_main_description,
        specialization_heading  = :specialization_heading,
        specialization_sub_heading = :specialization_sub_heading,
        specialization_description = :specialization_description,
        specialization_card_title = :specialization_card_title,
        specialization_card_description = :specialization_card_description,
        tips_heading = :tips_heading,
        tips_paragraph = :tips_paragraph,
        tips_card_title = :tips_card_title,
        tips_card_description = :tips_card_description,
        question = :question,
        answer = :answer,
        slug = :slug
    WHERE id = $id";

    $stmt = $conn->prepare($sql);

    $executed = $stmt->execute([
        'serviceIcon'                    => $serviceIcon,
        'service_title'                  => $serviceTitle,
        'service_image'                  => $serviceBanner,
        'service_main_description'       => $ServiceMainDescription,
        'specialization_heading'         => $specializationHeading,
        'specialization_sub_heading'     => $SpecializationSubHeading,
        'specialization_description'     => $specializationDescription,
        'specialization_card_title'      => $specializationCardsTitle,
        'specialization_card_description'=> $specializationCardsDescription,
        'tips_heading'                   => $tipsHeading,
        'tips_paragraph'                 => $tipsParagraph,
        'tips_card_title'                => $tipsCardTitle,
        'tips_card_description'          => $tipsCardDescription,
        'question'                       => $question,
        'answer'                         => $answer,
        'slug'                           => $slug,
    ]);

    if($executed)
    {
        $_SESSION["success"] = "Servive Updated Successfully!";
        redirect('/admin/services');
    }
}

function handleServiceDestroy() : void
{
    global $conn;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM services WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
    }
    if($result){
        $_SESSION["success"] = "Service Deleted Successfully";
        redirect('/admin/services');
    }
    else{
        $_SESSION["error"] = "Sorry Servive Dont Deleted";
        redirect('/admin/services');
    }

}


function validateSingleServiceFields(
    string $slug,
    string $serviceIcon,
    string $serviceBanner,
    string $serviceTitle,
    string $ServiceMainDescription,
    string $specializationHeading,
    string $SpecializationSubHeading,
    string $specializationDescription,
    string $specializationCardsTitle,
    string $specializationCardsDescription,
    string $tipsHeading,
    string $tipsParagraph,
    string $tipsCardTitle,
    string $tipsCardDescription,
    string $question,
    string $answer

    ) :bool  {

   $_SESSION['errors'];

    if (!isset($_POST['editId'])){
        if (empty($serviceIcon)) {
        $_SESSION['errors']["service_icon_error"] = "The Service Icon is required";
        }
        if (empty($serviceBanner)) {
            $_SESSION['errors']["service_banner_error"] = "The Service Banner is required";
        }        
    }
    if (empty($serviceTitle)) {
        $_SESSION['errors']["service_title_error"] = "The Service Title is required";
    }
    if (empty($slug)){
        $_SESSION['errors']["slug_error"] = "Slug is Required";
    }
    if (empty($ServiceMainDescription)) {
        $_SESSION['errors']["service_main_description_error"] = "The Service Main Description is required";
    }
    if (empty($specializationHeading)) {
        $_SESSION['errors']["specialization_heading_error"] = "The Specialization Heading is required";
    }
    if (empty($SpecializationSubHeading)) {
        $_SESSION['errors']["specialization_sub_heading_error"] = "The Specialization Sub Heading is required";
    }
    if (empty($specializationDescription)) {
        $_SESSION['errors']["specialization_description_error"] = "The Specialization Description is required";
    }
    $decodedspecializationCardsTitle = json_decode($specializationCardsTitle);
    if (empty(array_filter($decodedspecializationCardsTitle))) {
        $_SESSION['errors']["specialization_cards_title_error"] = "At least one Specialization Card Title is required";
    }
    $decodedspecializationCardsDescription = json_decode($specializationCardsDescription);
    if (empty(array_filter($decodedspecializationCardsDescription))) {
        $_SESSION['errors']["specialization_cards_description_error"] = "At least one Specialization Card Description is required";
    }
     if (empty($tipsHeading)) {
        $_SESSION['errors']["tips_heading_error"] = "The Tips Heading is required";
    }
    if (empty($tipsParagraph)) {
        $_SESSION['errors']["tips_paragraph_error"] = "The Tips Paragraph is required";
    }
    $decodedtipsCardTitle = json_decode($tipsCardTitle);
    if (empty(array_filter($decodedtipsCardTitle))) {
        $_SESSION['errors']["tips_card_title_error"] = "At least one Tips Card Title is required";
    }
    $decodedtipsCardDescription = json_decode($tipsCardDescription, TRUE);
    if (empty(array_filter($decodedtipsCardDescription))) {
        $_SESSION['errors']["tips_card_description_error"] = "At least one Tips Card Description is required";
    }
    $decodedQuestions = (json_decode($question, TRUE));
    if (empty(array_filter($decodedQuestions))){
        $_SESSION['errors']["question_error"] = 'At least one Question Is  required';
    }
    $decodedAnswers = json_decode($answer, TRUE);
    if (empty(array_filter($decodedAnswers))){
        $_SESSION['errors']["answer_error"] = 'At least one Answer is required';
    }

    return true;
}

