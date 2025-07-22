<?php

$conn = getConnection();
if(isset($_GET['editId'])){
    $editId = $_GET['editId'];
}else{
    echo "Id not found";
    die;
}

$sql = "SELECT * FROM services WHERE id = :editId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':editId', $editId, PDO::PARAM_INT);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
$services = $services[0];



$decodedspecializationCardsTitle        = json_decode($services['specialization_card_title'], TRUE);
$decodedSpecializationCardsDescription  = json_decode($services['specialization_card_description'], TRUE);
$deceodedTipsCardTitle                  = json_decode($services['tips_card_title'], TRUE);
$decodedTipsCarsDescription             = json_decode($services['tips_card_description'], TRUE);
$decodedQuestions                       = json_decode($services['question'], TRUE);
$decodedAnswers                         = json_decode($services['answer'], TRUE);

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
// $faqsHeadingError                     = $_SESSION["faqs_heading_error"] ?? '';
$questionError                        = $_SESSION["question_error"] ?? '';
$answerError                          = $_SESSION["answer_error"] ?? '';
$slugError = $_SESSION["slug_error"] ?? '';

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
    // $_SESSION["faqs_heading_error"],
    $_SESSION["question_error"],
    $_SESSION["answer_error"],
    $_SESSION["slug_error"],
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
                     <?php    foreach($data['breadcrumbs'] as $breadcrumbs) { ?>
                        <li class="breadcrumb-item">
                            <?php if(isset($breadcrumbs['href'])) { ?>    
                        <a href="<?=$breadcrumbs['href']?>"><?= $breadcrumbs['title']; ?></a>
                            <?php  } else { ?>
                                <?= $breadcrumbs['title']; ?>
                                <?php  } ?>
                    </li>
                        <?php } ?>
                    </ol>
                </nav>
                <!-- Dashboard Content -->
                <!-- <h1 class="mb-4">Dashboard</h1> -->
                <!-- Create New Service Form -->
                 <!-- px-md-5 use ful for below  -->
                <div class="container-fluid mt-5 px-3">
                    <div class="card shadow-sm p-4 p-md-5 border-0">
                        <form action="/admin/services/update" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="editId" value="<?= $editId ?>">
                            <!-- <input type="hidden">
                            <input type="hidden"> -->
                            <!-- Alert Area -->
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
                            
                            <div class="form-header">
                                <h1>Single Service / Edit</h1>
                                <a href="/admin/services" class="btn btn-sm btn-secondary">Back</a>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <div class="row mb-4">
                                    <!-- Service Icon -->
                                    <div class="col-md-6">
                                        <label for="service_icon" class="form-label fw-bold text-dark">Service Icon</label>
                                        <input class="form-control rounded-3" type="file" id="service_icon" name="service_icon">
                                        <?php if (!empty($services['service_icon'])){ ?>
                                            <img src="<?= BASE_URL . $services['service_icon'] ?>" alt="icon" class="img-fluid mt-2" style="max-height: 100px;">
                                        <?php } ?>
                                        <p class="text-danger"><?= $serviceIconError ?></p>
                                    </div>

                                    <!-- Service Banner -->
                                    <div class="col-md-6">
                                        <label for="service_banner" class="form-label fw-bold text-dark">Service Banner</label>
                                        <input class="form-control rounded-3" type="file" id="service_banner" name="service_banner" accept="image/*">
                                        <?php if(!empty($services['service_image'])){ ?>
                                            <img src="<?= BASE_URL . $services['service_icon'] ?>" alt="icon" class="img-fluid mt-2" style="max-height: 100px;">

                                       <?php }?>
                                        <p class="text-danger"><?= $serviceBannerError ?></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="service_title" class="form-label fw-bold text-dark">Service Title</label>
                                    <input type="text" class="form-control rounded-3" id="service_title" name="service_title" placeholder="e.g. Engine Servive Title" value="<?= $services['service_title']  ?>">
                                    <p class="text-danger"><?= $serviceTitleError ?></p>
                                </div>
                                <div class="mb-4">
                                    <label for="service_main_description" class="form-label fw-bold text-dark">Service Main Description</label>
                                    <textarea class="form-control rounded-3" id="service_main_description" name="service_main_description" rows="6" placeholder="Describe the service main description in detail..."
                                    ><?= $services['service_main_description'] ?></textarea>
                                    <p class="text-danger"><?= $serviceMainDescriptionError ?></p>

                                </div>

                                <!-- slug -->
                                <div class="mb-4">
                                    <label for="slug" class="form-label fw-bold text-dark">Slug</label>
                                    <input type="text" class="form-control rounded-3" id="service_title" name="slug" placeholder="e.g. Engine Slug" value="<?= $services['slug']  ?>">
                                    <p class="text-danger"><?= $slugError ?></p>
                                </div>

                            </div>

                            <!-- Specialization Section -->
                            <div class="specialization-section mb-4 p-4 border rounded-3 bg-light">
                                <h4 class="text-primary mb-2">Specialization</h4>
                                <div class="mb-4">
                                    <label for="specialization_heading" class="form-label fw-bold text-dark">Specialization Heading</label>
                                    <input type="text" class="form-control rounded-3" id="specialization_heading" name="specialization_heading" placeholder="e.g. Engine Specialization Heading" value="<?= $services['specialization_heading'] ?>">
                                    <p class="text-danger"><?= $specializationHeadingError ?></p>
                                </div>
                                <div class="mb-4">
                                    <label for="specialization_sub_heading" class="form-label fw-bold text-dark">Specialization Subheading</label>
                                    <input type="text" class="form-control rounded-3" id="specialization_sub_heading" name="specialization_sub_heading" placeholder="e.g. Engine Specialization Sub Heading" value="specialization_sub_heading">
                                                                    <p class="text-danger"><?= $specializationSubHeadingError ?></p>

                                </div>
                                <div class="mb-4">
                                    <label for="specialization_description" class="form-label fw-bold text-dark">Specialization Description</label>
                                    <textarea type="text" class="form-control rounded-3" id="specialization_description" name="specialization_description" placeholder="e.g. Engine Specialization Description.." rows="6"><?= $services['specialization_description'] ?></textarea>
                                                                   <p class="text-danger"><?= $specializationDescriptionError ?></p>

                                </div>
                            </div>

                            <!-- Specialization Card Section -->
                            <div id="specialization-card-wrapper-container" class="scrollable-wrapper mb-4 p-4 border rounded-3 bg-light overflow-auto" style="max-height: 400px;">
                                <div id="specialization-card-wrapper">

                                <?php if(!empty($decodedspecializationCardsTitle) && is_array($decodedspecializationCardsTitle)){
                                    for ($i=0; $i < count($decodedspecializationCardsTitle) ; $i++) { 
                                        $decCardTitle = $decodedspecializationCardsTitle[$i] ?? '';
                                        $decCardDesc = $decodedSpecializationCardsDescription[$i] ?? '';
                                    ?>
                                    <div class="card-section rounded-3 p-4 bg-white">
                                        <div class="spec-card-row mb-3 d-flex justify-content-between align-items-center">
                                            <h4 class="text-primary m-0">Specialization Cards</h4>
                                            <button type="button" class="spec-card-create btn btn-primary" id="create-specialization-card" style="background-color: #0f1436; border-color: #0f1436;">
                                                <i class="fa fa-plus me-1"></i> Create
                                            </button>
                                        </div>
                                        <div class="mb-4">
                                            <label for="specialization_cards_title" class="form-label fw-bold text-dark">Specialization Card Title</label>
                                            <input type="text" class="form-control rounded-3 specialization-title" name="specialization_cards_title[]" id="specialization_cards_title"
                                             placeholder="e.g. Enter Specialization Card Title" value="<?=  $decCardTitle ?>">
                                        <p class="text-danger"><?= $specializationCardsTitleError ?></p>

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-dark">Specialization Card Description</label>
                                            <textarea class="form-control rounded-3 specialization-desc" name="specialization_cards_description[]" id="specialization_cards_description"
                                             placeholder="e.g. Enter Specialization Card Description" rows="4"><?= $decCardDesc ?></textarea>
                                         <p class="text-danger"><?= $specializationCardsDescriptionError  ?></p>
                                        </div>
                                    </div>
                                    <?php } }?>
                                </div>
                            </div>

                            <!-- Tips Main Section -->
                            <div class="tips-main-section mb-4 p-4 border rounded-3 bg-light">
                                <h4 class="text-primary mb-2">Tips</h4>
                                <div class="mb-4">
                                    <label for="tips_heading" class="form-label fw-bold text-dark">Tips Heading</label>
                                    <input type="text" class="form-control rounded-3" id="tips_heading" name="tips_heading" placeholder="e.g. Enter Tips Heading" value="<?= $services['tips_heading']  ?>">
                                    <p class="text-danger"><?= $tipsHeadingError ?></p>

                                </div>
                                <div class="mb-4">
                                    <label for="tips_paragraph" class="form-label fw-bold text-dark">Tips Paragraph</label>
                                    <input type="text" class="form-control rounded-3" id="tips_paragraph" name="tips_paragraph" placeholder="e.g. Enter Tips Paragraph" value="<?= $services['tips_heading']  ?>">
                                    <p class="text-danger"><?= $tipsParagraphError  ?></p>

                                </div>
                            </div>

                            <!-- Tips List Section -->
                            <div class="tips-scrollable-wrapper mb-4 p-4 border rounded-3 bg-light overflow-auto" style="max-height: 500px;">
                                <div class="tips-wrapper">
                                      <?php if(!empty($deceodedTipsCardTitle) && is_array($deceodedTipsCardTitle)){
                                    for ($i=0; $i < count($deceodedTipsCardTitle) ; $i++) { 
                                        $tipCardTitle = $deceodedTipsCardTitle[$i] ?? '';
                                        $tipCardDesc = $decodedTipsCarsDescription[$i] ?? '';
                                    ?>
                                    <div class="tips-main p-4 rounded-3 bg-white">
                                        <div class="tips-list-header d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="text-primary mb-2">Tips List</h4>
                                            <button type="button" class="btn btn-primary" id="create-tips" style="background-color: #0f1436; border-color: #0f1436;">Create</button>
                                        </div>
                                        <div class="mb-4">
                                            <label for="tips_card_title" class="form-label fw-bold text-dark">Tips Card Title</label>
                                            <input type="text" class="form-control rounded-3" id="tips_card_title" name="tips_card_title[]"
                                             placeholder="e.g. Enter Tips Card Title" value="<?=  $tipCardTitle  ?>">
                                         <p class="text-danger"><?= $tipsCardTitleError  ?></p>

                                        </div>
                                        <div class="mb-4">
                                            <label for="tips_card_description" class="form-label fw-bold text-dark">Tips Card Description</label>
                                            <input type="text" class="form-control rounded-3" id="tips_card_description" name="tips_card_description[]"
                                             placeholder="e.g. Enter Tips Card Description" value="<?=  $tipCardDesc ?>">
                                        <p class="text-danger"><?= $tipsCardDescriptionError  ?></p>

                                        </div>
                                    </div>
                                    <?php }}?>
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
                                            if (!empty($decodedQuestions) && is_array($decodedQuestions)) {
                                                for ($i = 0; $i < count($decodedQuestions); $i++) { 
                                                    $q = $decodedQuestions[$i] ?? '';
                                                    $a = $decodedAnswers[$i] ?? '';
                                            ?>
                                            <div class="faqs-section p-4 rounded-3 bg-white mb-3 border position-relative">
                                                <!-- Close Button -->
                                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 close-faqs-card" aria-label="Close"></button>

                                                <div class="mb-4">
                                                    <label class="form-label fw-bold text-dark">Question <?php echo $i+1; ?></label>
                                                    <input type="text" class="form-control rounded-3" name="question[]" placeholder="e.g. Enter Question" value="<?= $q ?>">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label fw-bold text-dark">Answer <?php echo $i+1; ?></label>
                                                    <input type="text" class="form-control rounded-3" name="answer[]" placeholder="e.g. Enter Answer" value="<?= $a ?>">
                                                </div>
                                            </div>
                                            <?php }} ?>

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