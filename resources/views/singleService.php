<?php

$slug = isset($_GET['slug']) ? $_GET['slug'] : ''; 
$conn = getConnection();

$sql = "SELECT *  FROM services WHERE slug  = :slug";

$stmt = $conn->prepare($sql);

$stmt->execute([
    'slug' => $slug,
]);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($services as $service){

    $specialiationCardTitles = json_decode($service['specialization_card_title'], TRUE);
    $specialiationCardDescriptions = json_decode($service['specialization_card_description'], TRUE);

    $tipsCardTitle = json_decode($service['tips_card_title'], TRUE);
    $tipsCardDescription = json_decode($service['tips_card_description'], TRUE);

    $question = json_decode($service['question'], TRUE);
    $answer = json_decode($service['answer'], TRUE);
}

if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
}

$success = $_SESSION["success"]             ?? '';
$nameError = $_SESSION['nameError']         ?? ''; 
$emailError = $_SESSION['emailError']       ?? '';
$phoneError = $_SESSION['phoneError']       ?? '';
$serviceError  = $_SESSION["serviceError"]  ?? '';

unset(
    $_SESSION["success"],
    $_SESSION["nameError"],
    $_SESSION["emailError"],
    $_SESSION["phoneError"],
    $_SESSION["serviceError"],
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Denting Services In Abu Dhabi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>

<body>
    
        <?php view('layouts/header') ?>
        <section class="single-service-page-header-starter">
            <div class="header-starter-container auto-denting-services"
                style="background: url('/uploads/single_service/1751694648_services-banner.webp'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                <div class="container pt-3rem pb-3rem text-center auto-denting-services">
                    <h2><?= $service['service_title'] ?></h2>
                    <div class="btn-group d-flex justify-content-center gap-3">
                        <a href="tel:+923089375935">
                            <button class="p-3">
                                <i class="fa-solid fa-phone pe-1"></i>
                                +92 3089375935
                            </button>
                        </a>
                        <a href="mailto:info@nexgensoft.com">
                            <button class="p-3">
                                <i class="fa-solid fa-envelope pe-1"></i>
                                info@nexgensoft.com
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="service-form-section auto-denting-services">
            <div class="container form-container">
                <h2 class="mb-4">Book For A Service</h2>
                <form action="/admin/contacts/store" method="POST" class="quote-form">
                    <input type="hidden" name="slug" id="slug" value="<?= $slug ?>">
                    <div class="mb-3 d-flex gap-3">
                        <input type="text" class="form-control p-3 rounded-1 <?= $nameError ? 'is-invalid' : '' ?>" name="name" id="" placeholder="Your Name">
                        <input type="text" class="form-control p-3 rounded-1 <?= $phoneError ? 'is-invalid' : '' ?>" name="phone" id="phone"
                            placeholder="Your phone number">
                    </div>
                       <?php 
                            $sql = "SELECT * FROM services";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            $titles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                    <div class="mb-3 d-flex gap-3">
                        <input type="text" class="form-control  p-3 rounded-1 <?= $emailError ? 'is-invalid' : '' ?>" name="email" id="" placeholder="Your Email">
                         <select class="form-select  p-3 <?= $serviceError ? 'is-invalid' : '' ?>" aria-label="Default select example" name="service" id="service">
                        <option selected="">Select a Service</option>
                        <?php 
                            foreach($titles as $title) { ?>
                                <option value="<?=$title['id'] ?>"> <?= $title['service_title'] ?></option>
                           <?php } ?>

                        <option value="Other Service">Other Service</option>
                    </select>
                    </div>
                    <div class="btn-quote">
                        <div class="">
                             <div class="g-recaptcha" data-sitekey="6LdDmoArAAAAAEkFxi64L0qdxWGRBmzayxSNUaHu" data-callback="enableSubmitBtn"></div>
                        </div>
                        <button type="submit" id="mySubmitBtn" name="servicePageContact" disabled="disabled" title="Please Check Captcha First">GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button> 
                    </div>
                </form>
            </div>
        </section>

        <section class="flawless-finish">
            <div class="container pt-5 pb-5">
                <h2 class="mb-4"><?= $service['specialization_heading']  ?></h2>
                <p class="paragraph mb-5"><?= $service['specialization_description']  ?></p>
               
                <div class="cards-container">
                    <?php 
                    if(!empty($specialiationCardTitles) && is_array($specialiationCardTitles)) {
                       $count = max(count($specialiationCardTitles), count($specialiationCardDescriptions), 1);

                    for ($i=0; $i < $count ; $i++) {
                        $specListtitle = $specialiationCardTitles[$i] ?? '';
                        $specListdescription = $specialiationCardDescriptions[$i] ?? '';
                        ?>   
                        <div class="service">
                            <div class="heading">
                                <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i><?= $specListtitle ?></h5>
                            </div>
                            <div class="about">
                                <p><?= $specListdescription ?> </p>
                                <button class="btn p-0">Read More</button>
                            </div>
                        </div>
                    <?php 
                            }  
                        }
                        ?>
                </div>

                <div class="below-card">
                    <p class="pt-5">t Goa Refitz, we take pride in our dedication to provide top-notch dent repair services
                        and our
                        attention to detail. Our knowledgeable specialists receive ongoing training to stay current with the
                        most recent dent repair methods and technologies, guaranteeing that we provide the finest caliber of
                        service.</p>
                    <h2 class="mb-4"><?=  $service['specialization_sub_heading']  ?></h2>
                    <p> <?=  $service['service_main_description']  ?></p>
                </div>

                <div class="cars-banner">
                    <img class="w-85" width="100%" src="https://www.goacarrepair.com/assets/img/about.png"
                        alt="cars-banner">
                </div>
                <div class="preserving-beauty py-5">
                    <H2 class="mb-4">
                        <?= $service['tips_heading'] ?>
                    </H2>
                    <p><?= $service['tips_paragraph'] ?></p>
                </div>
                <div class="services-container preserving-beauty-cards">

                 <?php 
                    if(!empty($tipsCardTitle) && is_array($tipsCardTitle)) {
                    for ($i=0; $i < count($tipsCardTitle) ; $i++) {
                        $tipsListTitle = $tipsCardTitle[$i] ?? '';
                        $TipsListDescription = $tipsCardDescription[$i] ?? '';
                        ?>
                    <div class="service ">
                        <h4 class="mb-2"><?= $tipsListTitle ?></h4>
                        <p> <?= $TipsListDescription ?></p>

                    </div>

                    <?php
                    }}
                    ?>
                </div>
            </div>
        </section>

        <section class="questions">
            <div class="container">
                <h2 class="mb-4">Frequently Asked Questions (FAQ'S)</h2>
                <div class="questions-container mb-5">
                    <?php if (!empty($question) && is_array($question)) {
                        $count = max(count($question), count($answer), 1);
                        for ($i = 0; $i < $count; $i++) {
                            $q = $question[$i];
                            $a = $answer[$i];
                    ?>
                        <div class="first querybox">
                            <button class="btn" onclick="show('ans<?= $i ?>', event)">
                                <?= $q ?>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div class="answer" id="ans<?= $i ?>">
                                <?= $a ?>
                            </div>
                        </div>
                    <?php
                        }
                    } ?>
                </div>
            </div>
            </div>
        </section>
   
    <?php view('layouts/footer') ?>
    <script src="<?= assets('js/common.js') ?>"></script>
            <script>
        function enableSubmitBtn(){
                const btn = document.getElementById('mySubmitBtn');
                btn.disabled= false;       
                btn.removeAttribute('title');
        }
         </script>
</body>

</html>