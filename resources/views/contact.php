<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>

<body>
    <?php view('layouts/header') ?>

    <section class="contact-page-header-starter"
        style="background: url('<?php echo assets('images/contact/contact-banner.jpg') ?>');">
        <div class="header-starter-container">
            <div class="container pt-3rem pb-3rem text-center">
                <h2>Contact</h2>
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
    <section class="contact-form mt-5 mb-5">
        <div class="container">
            <h3 class="mb-4 text-center fw-bold">Contact For Any Query</h3>
            <div class="info mb-4 gap-4">
                <div class="address-info">
                    <h4>// ADDRESS //</h4>
                    <p><i class="fa-solid fa-location-dot pe-1"></i> M#6 Plot 56 Musaffah Industrial Area, Abu Dhabi,
                        UAE</p>
                </div>
                <div class="general-info">
                    <h4>// GENERAL //</h4>
                    <p><i class="fa-solid fa-envelope pe-1"></i> info@goacarrepair.com</p>
                </div>
                <div class="technical-info">
                    <h4>// TECHNICAL //</h4>
                    <p><i class="fa-solid fa-phone pe-1"></i> +971 50 262 6607</p>
                </div>
            </div>
            <div class="form-container">
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3634.2946287146046!2d54.5110596242805!3d24.37105201466847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e40d6ffdd0791%3A0xe9bbb8f72df6a4c9!2sMusaffah%20-%20M-6%20-%20Abu%20Dhabi%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2s!4v1684322791104!5m2!1sen!2s"
                        frameborder="0"></iframe>
                </div>
                <div class="form">
                    <form action="/thanks" method="POST">
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                            diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                            dolore erat amet</p>
                        <div class="mb-3 d-flex gap-3">
                            <input type="text" class="form-control p-3" name="name" id="" placeholder="Your Name">
                            <input type="text" class="form-control p-3" name="ph-number" id="" placeholder="Your Phone">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control p-3" name="email" id="" placeholder="Email">
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control p-3" rows="3" placeholder="Message"></textarea>
                        </div>
                        <button class="w-100">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php view('layouts/footer') ?>
</body>

</html>