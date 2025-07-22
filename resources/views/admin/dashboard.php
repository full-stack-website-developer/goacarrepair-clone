<?php

// session_unset();
// session_destroy();
// die;

$successMessage = $_SESSION["success"] ?? '';
$errorMessage = $_SESSION["error"] ?? '';

$serviceIconError                     = $_SESSION["service_icon_error"] ?? '';
$serviceBannerError                   = $_SESSION["service_banner_error"] ?? '';
$serviceTitleError                    = $_SESSION["service_title_error"] ?? '';
$serviceMainDescriptionError          = $_SESSION["service_main_description_error"] ?? '';
$specializationHeadingError           = $_SESSION["specialization_heading_error"] ?? '';
$specializationSubHeadingError        = $_SESSION["specialization_sub_heading_error"] ?? '';
$specializationDescriptionError       = $_SESSION["specialization_description_error"] ?? '';
$specializationCardsTitleError        = $_SESSION["specialization_cards_title_error"] ?? '';
$specializationCardsDescriptionError  = $_SESSION["specialization_cards_description_error"] ?? '';
$tipsHeadingError                     = $_SESSION["tips_heading_error"] ?? '';
$tipsParagraphError                   = $_SESSION["tips_paragraph_error"] ?? '';
$tipsCardTitleError                   = $_SESSION["tips_card_title_error"] ?? '';
$tipsCardDescriptionError             = $_SESSION["tips_card_description_error"] ?? '';
$faqsHeadingError                     = $_SESSION["faqs_heading_error"] ?? '';
$questionError                        = $_SESSION["question_error"] ?? '';
$answerError                          = $_SESSION["answer_error"] ?? '';


// echo "<pre>";
// print_r($_SESSION);
// print_r($value);
// die;

unset(
    $_SESSION["success"],
    $_SESSION["error"],

    $_SESSION["service_icon_error"],
    $_SESSION["service_banner_error"],
    $_SESSION["service_title_error"],
    $_SESSION["service_main_description_error"],
    $_SESSION["specialization_heading_error"],
    $_SESSION["specialization_sub_heading_error"],
    $_SESSION["specialization_description_error"],
    $_SESSION["specialization_cards_title_error"],
    $_SESSION["specialization_cards_description_error"],
    $_SESSION["tips_heading_error"],
    $_SESSION["tips_paragraph_error"],
    $_SESSION["tips_card_title_error"],
    $_SESSION["tips_card_description_error"],
    $_SESSION["faqs_heading_error"],
    $_SESSION["question_error"],
    $_SESSION["answer_error"]
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoaCarRepair Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>
<body>
  
    <div class="d-flex">
        <!-- Sidebar -->
        <?php layouts('admin-sidebar')?>
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 280px;">
        <!-- Header -->
            <?php layouts('admin-header')?>
            <!-- Main Content Area -->
            <div class="p-4">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <?php   foreach($data['breadcrumbs'] as $breadcrumb) { ?>

                        <li class="breadcrumb-item"><a href="<?= $breadcrumb['href'] ?>"><?= $breadcrumb['title'] ?></a></li>
                        <?php } ?>
                    </ol>
                </nav>

                <h1 class="text-justify">Welcome User</h1>
             
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= assets('js/single_service.js')  ?>"></script>
    
</body>
</html>