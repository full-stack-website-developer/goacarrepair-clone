<?php

$values = $_SESSION['temp_data'] ?? [];


$serviceTitle                   = $values['service_title'] ?? '';
$slug                           = $values['slug'] ?? "";
$serviceMainDescription         = $values['service_main_description'] ?? '';
$specializationHeading          = $values['specialization_heading'] ?? '';
$specializationSubHeading       = $values['specialization_sub_heading'] ?? '';
$specializationDescription      = $values['specialization_description'] ?? '';
$specializationCardsTitle       = $values['specialization_cards_title'] ?? [];
$specializationCardsDescription = $values['specialization_cards_description'] ?? [];
$tipsHeading                    = $values['tips_heading'] ?? '';
$tipsParagraph                  = $values['tips_paragraph'] ?? '';
$tipsCardTitle                  = $values['tips_card_title'] ?? [];
$tipsCardDescription            = $values['tips_card_description'] ?? [];
$question                       = $values['question'] ?? [];
$answer                         = $values['answer'] ?? [];

$successMessage = $_SESSION["success"] ?? '';
$errorMessage = $_SESSION["error"] ?? '';

$error = $_SESSION['errors'];
$serviceIconError                     = $error["service_icon_error"]                     ?? '';
$serviceBannerError                   = $error["service_banner_error"]                   ?? '';
$slugError                            = $error["slug_error"]                             ?? '';
$serviceTitleError                    = $error["service_title_error"]                    ?? '';
$serviceMainDescriptionError          = $error["service_main_description_error"]         ?? '';
$specializationHeadingError           = $error["specialization_heading_error"]           ?? '';
$specializationSubHeadingError        = $error["specialization_sub_heading_error"]       ?? '';
$specializationDescriptionError       = $error["specialization_description_error"]       ?? '';
$specializationCardsTitleError        = $error["specialization_cards_title_error"]       ?? '';
$specializationCardsDescriptionError  = $error["specialization_cards_description_error"] ?? '';
$tipsHeadingError                     = $error["tips_heading_error"]                     ?? '';
$tipsParagraphError                   = $error["tips_paragraph_error"]                   ?? '';
$tipsCardTitleError                   = $error["tips_card_title_error"]                  ?? '';
$tipsCardDescriptionError             = $error["tips_card_description_error"]            ?? '';
$questionError                        = $error["question_error"]                         ?? '';
$answerError                          = $error["answer_error"]                           ?? '';

unset(
    $_SESSION["success"],
    $_SESSION["error"],

    $_SESSION['errors']["service_icon_error"],
    $_SESSION['errors']["service_banner_error"],
    $_SESSION['errors']["service_title_error"],
    $_SESSION['errors']["service_main_description_error"],
    $_SESSION['errors']["specialization_heading_error"],
    $_SESSION['errors']["specialization_sub_heading_error"],
    $_SESSION['errors']["specialization_description_error"],
    $_SESSION['errors']["specialization_cards_title_error"],
    $_SESSION['errors']["specialization_cards_description_error"],
    $_SESSION['errors']["tips_heading_error"],
    $_SESSION['errors']["tips_paragraph_error"],
    $_SESSION['errors']["tips_card_title_error"],
    $_SESSION['errors']["tips_card_description_error"],
    $_SESSION['errors']["faqs_heading_error"],
    $_SESSION['errors']["answer_error"],
    $_SESSION['errors']["slug_error"],                 
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
        <?php layouts('admin-sidebar')?>
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 280px;">
            <?php layouts('admin-header')?>
            <!-- Main Content Area -->
            <div class="p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if (!empty($breadcrumbs)) : ?>
                        <?php foreach ($data['breadcrumbs'] as $breadcrumb) : ?>
                            <li class="breadcrumb-item" aria-current="page">
                                <?php if (isset($breadcrumb['href'])) : ?>
                                    <a href="<?= $breadcrumb['href'] ?>"><?= $breadcrumb['title'] ?></a>
                                <?php else : ?>
                                    <?= $breadcrumb['title'] ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ol>
            </nav>

                <div class="container-fluid mt-5 px-3">
                    <div class="card shadow-sm p-4 p-md-5 border-0">
                        <div class="alert-area mb-4">
                                <?php
                                if (!empty($successMessage)) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $successMessage ?>
                                    </div>
                                <?php
                                }
                                if (!empty($errorMessage)) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $errorMessage ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <form action="/admin/services/store" method="POST" enctype="multipart/form-data">
                            <div class="form-header">
                                <h1>Single Service / Create</h1>
                                <a href="/admin/services" class="btn btn-sm btn-secondary">Back</a>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <div class="mb-4">
                                    <label for="service_icon" class="form-label fw-bold text-dark">Service Icon</label>
                                    <input class="form-control rounded-3" type="file" id="service_icon" name="service_icon">
                                    <p class="text-danger"><?= $serviceIconError ?></p>
                                </div>
                                <div class="mb-4">
                                    <label for="service_banner" class="form-label fw-bold text-dark">Service Banner</label>
                                    <input class="form-control rounded-3" type="file" id="service_banner" name="service_banner" accept="image/*">
                                    <p class="text-danger"><?= $serviceBannerError ?></p>

                                </div>

                            
                                <div class="mb-4">
                                    <label for="service_title" class="form-label fw-bold text-dark">Service Title</label>
                                    <input type="text" class="form-control rounded-3" id="service_title" name="service_title"
                                     placeholder="e.g. Engine Servive Title" value="<?= $serviceTitle ?>">
                                    <p class="text-danger"><?= $serviceTitleError ?></p>
                                </div>
                              
                                <div class="mb-4">
                                    <label for="service_main_description" class="form-label fw-bold text-dark">Service Main Description</label>
                                    <textarea class="form-control rounded-3" id="service_main_description" name="service_main_description" rows="6"
                                     placeholder="Describe the service main description in detail..."><?= $serviceMainDescription ?></textarea>
                                    <p class="text-danger"><?= $serviceMainDescriptionError ?></p>
                                </div>

                                <!-- slug -->
                                 <div class="mb-4">
                                    <label for="slug" class="form-label fw-bold text-dark">Slug</label>
                                    <input type="text" class="form-control rounded-3" id="slug" name="slug"
                                     placeholder="e.g. Engine Servive Title" value="<?= $slug ?>">
                                    <p class="text-danger"><?= $slugError ?></p>
                                </div>
                            </div>

                            <!-- Specialization Section -->
                            <div class="specialization-section mb-4 p-4 border rounded-3 bg-light">
                                <h4 class="text-primary mb-2">Specialization</h4>
                                <div class="mb-4">
                                    <label for="specialization_heading" class="form-label fw-bold text-dark">Specialization Heading</label>

                                    <input type="text" class="form-control rounded-3" id="specialization_heading" name="specialization_heading"
                                    placeholder="e.g. Engine Specialization Heading" value="<?= $specializationHeading ?>">

                                    <p class="text-danger"><?= $specializationHeadingError ?></p>
                                </div>
                                <div class="mb-4">
                                    <label for="specialization_sub_heading" class="form-label fw-bold text-dark">Specialization Subheading</label>
                                    <input type="text" class="form-control rounded-3" id="specialization_sub_heading" name="specialization_sub_heading"
                                     placeholder="e.g. Engine Specialization Sub Heading" value="<?= $specializationSubHeading ?? '' ?>">
                                    <p class="text-danger"><?= $specializationSubHeadingError ?></p>

                                </div>
                                <div class="mb-4">
                                    <label for="specialization_description" class="form-label fw-bold text-dark">Specialization Description</label>
                                    <textarea type="text" class="form-control rounded-3" id="specialization_description" name="specialization_description"
                                     placeholder="e.g. Engine Specialization Description.." rows="6"><?= $specializationDescription ?></textarea>
                                    <p class="text-danger"><?= $specializationDescriptionError ?></p>

                                </div>
                            </div>

                            <!-- Specialization Card Section -->
                            <div id="specialization-card-wrapper-container" class="scrollable-wrapper mb-4 p-4 border rounded-3 bg-light overflow-auto" style="max-height: 400px;">
                                <div id="specialization-card-wrapper">
                                    <div class="card-section rounded-3 p-4 bg-white">
                                        <div class="spec-card-row mb-3 d-flex justify-content-between align-items-center">
                                            <h4 class="text-primary m-0">Specialization Cards</h4>
                                            <button type="button" class="spec-card-create btn btn-primary" id="create-specialization-card" style="background-color: #0f1436; border-color: #0f1436;">
                                                <i class="fa fa-plus me-1"></i> Create
                                            </button>
                                        </div>
                        
                                        <?php
                                        $title = $values['specialization_cards_title'] ?? [];
                                        $description = $values['specialization_cards_description'] ?? [];
                                        $count = max(count($title), count($description), 1);
                                 
                                        for ($i = 0; $i < $count; $i++) {
                                        ?>
                                            <div class="mb-4">
                                                <label for="specialization_cards_title_<?= $i ?>" class="form-label fw-bold text-dark">Specialization Card Title</label>
                                                <input type="text"
                                                    class="form-control rounded-3 specialization-title"
                                                    name="specialization_cards_title[]"
                                                    id="specialization_cards_title_<?= $i ?>"
                                                    placeholder="e.g. Enter Specialization Card Title"
                                                    value="<?= $title[$i] ?? '' ?>">
                                            </div>

                                            <div class="mb-4">
                                                <label for="specialization_cards_description_<?= $i ?>" class="form-label fw-bold text-dark">Specialization Card Description</label>
                                                <textarea
                                                    class="form-control rounded-3 specialization-desc"
                                                    name="specialization_cards_description[]"
                                                    id="specialization_cards_description_<?= $i ?>"
                                                    placeholder="e.g. Enter Specialization Card Description"
                                                    rows="4"><?= $description[$i] ?? '' ?></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Tips Main Section -->
                            <div class="tips-main-section mb-4 p-4 border rounded-3 bg-light">
                                <h4 class="text-primary mb-2">Tips</h4>
                                <div class="mb-4">
                                    <label for="tips_heading" class="form-label fw-bold text-dark">Tips Heading</label>
                                    <input type="text" class="form-control rounded-3" id="tips_heading" name="tips_heading" 
                                    placeholder="e.g. Enter Tips Heading" value="<?= $tipsHeading ?>">
                                    <p class="text-danger"><?= $tipsHeadingError ?></p>

                                </div>
                                <div class="mb-4">
                                    <label for="tips_paragraph" class="form-label fw-bold text-dark">Tips Paragraph</label>
                                    <input type="text" class="form-control rounded-3" id="tips_paragraph" name="tips_paragraph" 
                                    placeholder="e.g. Enter Tips Paragraph" value="<?= $tipsParagraph ?>">
                                    <p class="text-danger"><?= $tipsParagraphError  ?></p>

                                </div>
                            </div>

                            <!-- Tips List Section -->
                            <div class="tips-scrollable-wrapper mb-4 p-4 border rounded-3 bg-light overflow-auto" style="max-height: 500px;">
                                <div class="tips-wrapper">
                                    <div class="tips-main p-4 rounded-3 bg-white">
                                        <div class="tips-list-header d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="text-primary mb-2">Tips List</h4>
                                            <button type="button" class="btn btn-primary" id="create-tips" style="background-color: #0f1436; border-color: #0f1436;">Create</button>
                                        </div>

                                        <?php 
                                            $tipsTitle = $tipsCardTitle ?? [];
                                            $Tipsdesc = $tipsCardDescription ?? [];

                                            var_dump($tipsCardTitle);
                                            var_dump($tipsCardDescription);

                                            $count = max(count($tipsTitle), count($Tipsdesc), 1);
                                        ?>

                                        <?php for ($i=0; $i < $count; $i++) {  ?>
                                            <div class="mb-4">
                                            <label for="tips_card_title" class="form-label fw-bold text-dark">Tips Card Title</label>
                                            <input type="text" class="form-control rounded-3" id="tips_card_title" name="tips_card_title[]" 
                                            placeholder="e.g. Enter Tips Card Title" value="<?= htmlspecialchars($tipsTitle[$i] ?? '') ?>">
                                             <p class="text-danger"><?= $tipsCardTitleError  ?></p>

                                        </div>
                                        <div class="mb-4">
                                            <label for="tips_card_description" class="form-label fw-bold text-dark">Tips Card Description</label>
                                            <input type="text" class="form-control rounded-3" id="tips_card_description" name="tips_card_description[]" 
                                            placeholder="e.g. Enter Tips Card Description" value="<?= $Tipsdesc[$i] ?? '' ?>">
                                            <p class="text-danger"><?= $tipsCardDescriptionError ?? ''  ?></p>

                                        </div>
                                     <?php   }?>
                                     
                                    </div>
                                </div>
                            </div>

                            <!-- FAQs Section -->
                            <div class="faqs-main-container mb-4 p-4 border rounded-3 bg-light overflow-auto" style="max-height: 400px;">
                                <div id="faqs-card-wrapper">
                                    <div class="faqs-section p-4 rounded-3 bg-white">
                                        <div class="faqs-header d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="text-primary mb-2">FAQ'S</h4>
                                            <button type="button" class="btn btn-primary" id="create-faqs-card" style="background-color: #0f1436; border-color: #0f1436;">Create</button>
                                        </div>
                            
                                            <?php 
                                            $listfaqQuestion = $question;
                                            $listfaqAnswer = $answer;
                                            $count = max(count($listfaqAnswer), count($listfaqQuestion), 1);

                                            for ($i = 0; $i < $count; $i++) {
                                        ?>
                                            <div class="mb-4">  
                                                <label for="question" class="form-label fw-bold text-dark">Question</label>
                                                <input type="text" class="form-control rounded-3" id="question" name="question[]" 
                                                    placeholder="e.g. Enter Question" 
                                                    value="<?= htmlspecialchars($listfaqQuestion[$i] ?? '') ?>">
                                                <p class="text-danger"><?= $questionError ?></p>
                                            </div>

                                            <div class="mb-4">
                                                <label for="answer" class="form-label fw-bold text-dark">Answer</label>
                                                <input type="text" class="form-control rounded-3" id="answer" name="answer[]" 
                                                    placeholder="e.g. Engine Answer"
                                                    value="<?= htmlspecialchars($listfaqAnswer[$i] ?? '') ?>">
                                                <p class="text-danger"><?= $answerError ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end gap-3">
                                <button type="submit" class="btn btn-primary rounded-3 px-4 py-2" style="background-color: #0f1436; border-color: #0f1436;">Save Service</button>
                                <a href="service-list.php" class="btn btn-outline-secondary rounded-3 px-4 py-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= assets('js/single_service.js')  ?>"></script>
    
</body>
</html>