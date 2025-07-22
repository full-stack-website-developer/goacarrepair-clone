<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>

<body>
    <?php view('layouts/header') ?>

    <section class="service-page-header-starter"
        style="background: url('<?= assets('images/services/services-banner.webp') ?>');">
        <div class="header-starter-container">
            <div class="container pt-3rem pb-3rem text-center">
                <h2>Services</h2>
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
    <section class="services-section">
        <div class="container pt-5 pb-5">
            <div class="header">
                <h2 class="fw-bold">Our Expertise</h2>
            </div>
            <div class="services-container">
                <?php
                $conn = getConnection();
                $sql = "SELECT * FROM services";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($services as $service) { ?>
                    <a href="/services/<?= htmlspecialchars($service['slug'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="service">
                            <div class="image">
                                <img src="<?= BASE_URL . htmlspecialchars($service['service_icon'], ENT_QUOTES, 'UTF-8') ?>" alt="">
                            </div>
                            <div class="about">
                                <p class="title mb-2"><?= htmlspecialchars($service['service_title'], ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="description"><?= substr($service['service_main_description'], 0, 40) ?></p>
                                <button class="btn p-0">Read More</button>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
    </section>
    <section class="explore-services">
        <div class="container pt-5 pb-5">
            <h3 class="text-center mb-5">Explore Our Services</h3>
            <div class="services">
                <div class="services-list">
                    <ul>
                        <li class="list-item active cursor-pointer" onclick="toggleService(event, 'denting')"><i
                                class="fa fa-car-side me-3"></i>Denting & painting Services</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'engine')"><i
                                class="fa fa-car me-3"></i>Engine Servicing</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'diagnostic')"><i
                                class="fa fa-cog me-3"></i>Diagnostic Test</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'oil')"><i
                                class="fa fa-oil-can me-3"></i>Oil Changing</li>
                    </ul>
                </div>
                <div id="all-services">
                    <div class="service-detail" id="denting">
                        <div class="image">
                            <img src="<?= assets('images/home/explore-service-1.jpg'); ?>" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>Welcome to Goa Refitz Car Repair Services, the top location in Abu Dhabi for superior
                                auto denting services. We realize how frustrating it is to discover dents</p>
                            <div class="features">
                                <p><i class="fa-solid fa-check"></i>Quality Servicing</p>
                                <p><i class="fa-solid fa-check"></i>Expert Workers</p>
                                <p><i class="fa-solid fa-check"></i>Modern Equipment</p>
                            </div>
                            <button>GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                    <div class="service-detail engine d-none" id="engine">
                        <div class="image">
                            <img src="<?= assets('images/home/explore-service-2.jpg'); ?>" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>At Goa Refitz Car Repair Services, we understand the value of an engine that is kept in
                                good condition for the entire functionality and durability of your car.</p>
                            <div class="features">
                                <p><i class="fa-solid fa-check"></i>Quality Servicing</p>
                                <p><i class="fa-solid fa-check"></i>Expert Workers</p>
                                <p><i class="fa-solid fa-check"></i>Modern Equipment</p>
                            </div>
                            <button>GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                    <div class="service-detail diagnostic d-none" id="diagnostic">
                        <div class="image">
                            <img src="<?= assets('images/home/explore-service-1.jpg'); ?>" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>We specialize in diagnostic services for automobiles of all makes and models at Goa
                                Refitz. Our specialists get ongoing training to keep current on the newest improvements
                                in automotive technology.</p>
                            <div class="features">
                                <p><i class="fa-solid fa-check"></i>Quality Servicing</p>
                                <p><i class="fa-solid fa-check"></i>Expert Workers</p>
                                <p><i class="fa-solid fa-check"></i>Modern Equipment</p>
                            </div>
                            <button>GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                    <div class="service-detail oil d-none" id="oil">
                        <div class="image">
                            <img src="<?= assets('images/home/explore-service-4.jpg'); ?>" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>At Goa Refitz Car Repair Services, we are aware of the critical part that routine oil
                                changes play in preserving the health and functionality of the engine in your car.</p>
                            <div class="features">
                                <p><i class="fa-solid fa-check"></i>Quality Servicing</p>
                                <p><i class="fa-solid fa-check"></i>Expert Workers</p>
                                <p><i class="fa-solid fa-check"></i>Modern Equipment</p>
                            </div>
                            <button>GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= assets('js/common.js') ?>"></script>
    <?php view('layouts/footer') ?>
</body>

</html>