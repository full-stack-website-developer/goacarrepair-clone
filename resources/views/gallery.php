<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galley</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>
<body>

    <?php view('layouts/header') ?>

    <section class="gallery-page-header-starter">
        <div class="header-starter-container">
            <div class="container text-center">
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

    <section class="gallery-section">
        <div class="container">
            <h2>Our Gallery</h2>
            <div class="images-container">
                <div class="image">
                    <img src="https://www.goacarrepair.com/assets/img/gallery/galery-1.jpg" alt="">
                </div>
                <div class="image">
                    <img src="https://www.goacarrepair.com/assets/img/gallery/galery-2.jpg" alt="">
                </div>
                <div class="image">
                    <img src="https://www.goacarrepair.com/assets/img/gallery/12rim-repair.png" alt="">
                </div>
                <div class="image">
                    <img src="https://www.goacarrepair.com/assets/img/gallery/tyre.jpg" alt="">
                </div>
                <div class="image">
                    <img src="https://www.goacarrepair.com/assets/img/gallery/galery-1.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <?php view('layouts/footer') ?>

</body>
</html>