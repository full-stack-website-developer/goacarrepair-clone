<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>
<body>
    <?php view('layouts/header') ?>

    <section class="carousel-section">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.goacarrepair.com/assets/img/hb-4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block top-0 text-start align-self-center w-45">
                        <h6>// Expert Technician //</h6>
                        <p>Auto Body Repair (Denting) Services in Abu Dhabi</p>
                        <div class="btn-group">
                            <a href="tel:+923089375935">
                                <button class="p-3">
                                    <i class="fa-solid fa-phone"></i> 
                                    +92 3089375935
                                </button>
                            </a>
                            <a href="mailto:info@nexgensoft.com">
                                <button class="p-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    info@nexgensoft.com
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.goacarrepair.com/assets/img/hb-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block top-0 text-start align-self-center w-45">
                        <h6>// Expert Technician //</h6>
                        <p>Auto Body Painting Services in Abu Dhabi</p>
                        <div class="btn-group">
                            <a href="tel:+923089375935">
                                <button class="p-3">
                                    <i class="fa-solid fa-phone"></i> 
                                    +92 3089375935
                                </button>
                            </a>
                            <a href="mailto:info@nexgensoft.com">
                                <button class="p-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    info@nexgensoft.com
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.goacarrepair.com/assets/img/hb-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block top-0 text-start align-self-center w-45">
                        <h6>// Expert Technician //</h6>
                        <p>Mechanical Repair Services in Abu Dhabi</p>
                        <div class="btn-group">
                            <a href="tel:+923089375935">
                                <button class="p-3">
                                    <i class="fa-solid fa-phone"></i> 
                                    +92 3089375935
                                </button>
                            </a>
                            <a href="mailto:info@nexgensoft.com">
                                <button class="p-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    info@nexgensoft.com
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.goacarrepair.com/assets/img/hb-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block top-0 text-start align-self-center w-45">
                        <h6>// Expert Technician //</h6>
                        <p>Auto Electric & A/C Repair Services in Abu Dhabi</p>
                        <div class="btn-group">
                            <a href="tel:+923089375935">
                                <button class="p-3">
                                    <i class="fa-solid fa-phone"></i> 
                                    +92 3089375935
                                </button>
                            </a>
                            <a href="mailto:info@nexgensoft.com">
                                <button class="p-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    info@nexgensoft.com
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.goacarrepair.com/assets/img/hb-5.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block top-0 text-start align-self-center w-45">
                        <h6>// Expert Technician //</h6>
                        <p>Free Recovery Service for Goa Refitz Customers in Abu Dhabi</p>
                        <div class="btn-group">
                            <a href="tel:+923089375935">
                                <button class="p-3">
                                    <i class="fa-solid fa-phone"></i> 
                                    +92 3089375935
                                </button>
                            </a>
                            <a href="mailto:info@nexgensoft.com">
                                <button class="p-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    info@nexgensoft.com
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="bg-dark p-3 rounded-circle d-flex">
                    <span class="carousel-control-prev-icon carousel-icon" aria-hidden="true"></span>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="bg-dark p-3 rounded-circle d-flex">
                    <span class="carousel-control-next-icon carousel-icon" aria-hidden="true"></span>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="service-form-section">
        <div class="container form-container">
            <h2 class="mb-4">Book For A Service</h2>
            <form action="#" method="POST" class="quote-form">
                <div class="mb-3 d-flex gap-3">
                    <input type="text" class="form-control p-3" name="name" id="" placeholder="Your Name">
                    <input type="text" class="form-control p-3" name="ph-number" id="" placeholder="Your phone number">
                </div>
                <div class="mb-3 d-flex gap-3">
                    <input type="text" class="form-control  p-3" name="email" id="" placeholder="Your Email">
                    <select class="form-select  p-3" aria-label="Default select example">
                        <option selected="">Select a Service</option>
                        <option value=" Auto Denting Services in Abu Dhabi"> Auto Denting Services in Abu Dhabi</option>
                        <option value=" Auto Painting Services in Abu Dhabi"> Auto Painting Services in Abu Dhabi</option>
                        <option value=" Engine Servicing in Abu Dhabi"> Engine Servicing in Abu Dhabi</option>
                        <option value="Auto Electric &amp; A/ C Repair Service in Abu Dhabi">Auto Electric &amp; A/ C Repair Service in Abu Dhabi</option>
                        <option value=" Engine Repair in Abu Dhabi"> Engine Repair in Abu Dhabi</option>
                        <option value=" Oil Changing in Abu Dhabi"> Oil Changing in Abu Dhabi</option>
                        <option value=" Rim Repair Services in Abu Dhabi"> Rim Repair Services in Abu Dhabi</option>
                        <option value="Car Accident Repair Services in Abu Dhabi">Car Accident Repair Services in Abu Dhabi</option>
                        <option value="Gearbox Repairs in Abu Dhabi">Gearbox Repairs in Abu Dhabi</option>
                        <option value="Chassis Alignment Services in Abu Dhabi">Chassis Alignment Services in Abu Dhabi</option>
                        <option value=" Comprehensive Engine Overhauls in Abu Dhabi"> Comprehensive Engine Overhauls in Abu Dhabi</option>
                        <option value="Suspension Repairs Services  in Abu Dhabi">Suspension Repairs Services  in Abu Dhabi</option>
                        <option value=" Transmission Overhauls and Repairs  in Abu Dhabi"> Transmission Overhauls and Repairs  in Abu Dhabi</option>
                        <option value=" Brake Replacements in Abu Dhabi"> Brake Replacements in Abu Dhabi</option>
                        <option value=" Steering Wheel Repairs in Abu Dhabi"> Steering Wheel Repairs in Abu Dhabi</option>
                        <option value=" Diagnostic Test in Abu Dhabi"> Diagnostic Test in Abu Dhabi</option>
                        <option value=" Tire Replacement in Abu Dhabi"> Tire Replacement in Abu Dhabi</option>
                        <option>Other Service</option>
                    </select>
                </div>
                <div class="btn-quote">
                    <button>GET A FREE QUOTE <i class="fa-solid fa-arrow-right-long"></i></button>
                </div>
            </form>
        </div>
    </section>
    <section class="offer-service-section">
        <div class="container  pt-5 pb-5">
            <div class="header">
                <h2 class="fw-bold">Repair & Mechanical services we offer In Abu Dhabi</h2>
                <p class="text-justify">Maintaining your car's mechanical performance is crucial for ensuring a pleasant driving experience. You can prevent major difficulties if mechanical problems are promptly identified and fixed. It is essential to preserve your vehicle's excellent health by entrusting it to the best auto repair and mechanical shop in Abu Dhabi in order to avoid unanticipated failures on the road. To meet your demands, our workshop provides a wide range of mechanical services, such as:</p>
            </div>
            <div class="services-container">
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-1.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Auto Denting Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-2.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Auto Painting Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-3.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Engine Servicing in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-4.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Auto Electric & A/ C Repair Service in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-5.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Engine Repair in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-6.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Oil Changing in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-7.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title"> Rim Repair Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-8.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Car Accident Repair Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-9.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Gearbox Repairs in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-10.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Chassis Alignment Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-11.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Comprehensive Engine Overhauls in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-12.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title"> Suspension Repairs Services in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-13.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Transmission Overhauls and Repairs  in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-14.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Brake Replacements in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-15.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Steering Wheel Repairs in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-16.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Diagnostic Test in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
                <div class="service">
                    <div class="image">
                        <img src="<?= assets('images/home-services/service-17.svg') ?>" alt="">
                    </div>
                    <div class="about">
                        <p class="title">Tire Replacement in Abu Dhabi</p>
                        <button class="btn p-0">Read More</button>
                    </div>
                </div>
            </div>
            <p class="text-justify">At Goa Refitz Car Repair Services in Abu Dhabi, UAE, we prioritize the well-being of your vehicle and strive to deliver exceptional mechanical services. Our skilled technicians employ their expertise and advanced tools to provide reliable and efficient repairs. By relying on our workshop, you can trust that any mechanical issues will be swiftly identified and effectively resolved, saving you from potential troubles in the future. We take great satisfaction in being a recognized auto repair and mechanical business in Abu Dhabi, dedicated to providing all the services necessary to keep your automobile in top condition. You can trust Goa Refitz automobile Repair Services to take excellent care of your automobile because to our persistent commitment to quality. Do not let mechanical problems ruin your driving experience. Come see us at Goa Refitz Car Repair Services, the top auto repair shop in Abu Dhabi, and discover for yourself our first-rate mechanical services. We place a high priority on your car's performance and are committed to providing the best quality of service to provide you peace of mind while driving.</p>
        </div>
    </section>
    <section class="special-client-offers-section">
        <div class="container special-client-offers pt-5 pb-5">
            <h2 class="mb-5">ENJOY SOME OF OUR SPECIAL CLIENT OFFERINGS WHILE YOU WAIT</h2>
            <div class="offers">
                <div class="offer">
                    <img src="https://www.goacarrepair.com/upload/complementary%20refreshments.svg" alt="">
                    <h4>COMPLEMENTARY REFRESHMENTS</h4>
                </div>
                <div class="offer">
                    <img src="https://www.goacarrepair.com/upload/Reading%20material.svg" alt="">
                    <h4>READING MATERIAL</h4>
                </div>
                <div class="offer">
                    <img src="https://www.goacarrepair.com/upload/free%20wifi.svg" alt="">
                    <h4>FREE WI-FI</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="statistics-section">
        <div class="container statistics pt-5 pb-5">
            <div class="statistic">
                <i class="fa-solid fa-check"></i>
                <span>12</span>
                <p>Year Experience</p>
            </div>
            <div class="statistic">
                <i class="fa-solid fa-users-gear"></i>
                <span>10</span>
                <p>Expert Technicians</p>
            </div>
            <div class="statistic">
                <i class="fa-solid fa-users"></i>
                <span>1234</span>
                <p>Satisfied Clients</p>
            </div>
            <div class="statistic">
                <i class="fa-solid fa-car"></i>
                <span>1234</span>
                <p>Projects Completed</p>
            </div>
        </div>
    </section>
    <section class="brands-section">
        <div class="container brands pt-5 pb-5">
            <h2 class="text-center mb-4">POPULAR MAKES THAT WE SERVICE</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="Volvo" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="Aston Martin" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="Audi" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="Bentley" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                    <div class="swiper-slide"><img src="https://www.goacarrepair.com/upload/logo/volvo.jpg" alt="BMW" /></div>
                </div>
                <!-- Arrows -->
                <div class="arrows">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="explore-services">
        <div class="container pt-5 pb-5">
            <h3>Explore Our Services</h3>
            <div class="services">
                <div class="services-list">
                    <ul>
                        <li class="list-item active cursor-pointer" onclick="toggleService(event, 'denting')"><i class="fa fa-car-side me-3"></i>Denting & painting Services</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'engine')"><i class="fa fa-car me-3"></i>Engine Servicing</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'diagnostic')"><i class="fa fa-cog me-3"></i>Diagnostic Test</li>
                        <li class="list-item cursor-pointer" onclick="toggleService(event, 'oil')"><i class="fa fa-oil-can me-3"></i>Oil Changing</li>
                    </ul>
                </div>
                <div id="all-services">
                    <div class="service-detail" id="denting">
                        <div class="image">
                            <img src="https://www.goacarrepair.com/assets/img/service-1.jpg" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>Welcome to Goa Refitz Car Repair Services, the top location in Abu Dhabi for superior auto denting services. We realize how frustrating it is to discover dents</p>
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
                            <img src="https://www.goacarrepair.com/assets/img/service-2.jpg" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>At Goa Refitz Car Repair Services, we understand the value of an engine that is kept in good condition for the entire functionality and durability of your car.</p>
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
                            <img src="https://www.goacarrepair.com/assets/img/service-1.jpg" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>We specialize in diagnostic services for automobiles of all makes and models at Goa Refitz. Our specialists get ongoing training to keep current on the newest improvements in automotive technology.</p>
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
                            <img src="https://www.goacarrepair.com/assets/img/service-4.jpg" alt="">
                        </div>
                        <div class="details">
                            <h3>12 Years Of Experience In Auto Servicing</h3>
                            <p>At Goa Refitz Car Repair Services, we are aware of the critical part that routine oil changes play in preserving the health and functionality of the engine in your car.</p>
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
    <section class="abu-dhabi-workshop">
        <div class="container">
            <h1>Car Repair & Mechanic Workshop in Abu Dhabi</h1>
            <div class="text-container">
                <p>Look no farther than Goa Refitz Car Services for dependable vehicle repair and maintenance services in
                    Abu Dhabi, UAE.
                    We recognize the significance of maintaining your car and assuring its peak performance on the road. We
                    have a good
                    reputation for quality in the automotive business as a trustworthy automobile service company.</p>
                <p>As an authorized car service center, we have established a strong partnership with leading automotive
                    brands. This
                    allows us to provide comprehensive auto repair and mechanic services for a wide range of vehicles,
                    including European,
                    Japanese, and American models. Whether you require mechanical repairs, engine diagnostics, brake
                    service, suspension
                    repairs, or any other auto repair service, our skilled technicians have the expertise to handle it.</p>
                <p>Beyond repairs and upkeep, we are committed to providing excellent customer service. We also provide a
                    number of other
                    services, including tire rotation and balance, battery replacement, oil changes, and wheel alignment. We
                    at Goa Refitz
                    Car Services are your one-stop shop for all of your mechanic and vehicle repair requirements.</p>
                <p>We are aware that mechanic and auto repair costs can occasionally be high, particularly if you rely just
                    on the
                    manufacturer of your car. We make an effort to offer affordable solutions without sacrificing quality
                    because of this.
                    We strive to make auto repairs and maintenance more cheap and available to all automobile owners in Abu
                    Dhabi with our
                    clear pricing and effective services.</p>
                <p>When it comes to finding a trusted car garage in Abu Dhabi for auto repair and mechanic services, Goa
                    Refitz Car
                    Services stands out as a reliable and reputable choice. Experience our exceptional service and let us
                    take care of all
                    your auto repair and mechanic needs, ensuring the longevity and peak performance of your vehicle on the
                    roads of Abu
                    Dhabi.</p>
            </div>
        </div>
    </section>
    <section class="choose-us">
        <div class="container pb-5">
            <h2>Why Choose Us</h2>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">Our workshop provides easy access for our cherished clients because it is situated in a
                    renowned neighborhood of Abu
                    Dhabi.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">We have plenty of parking available right on the workshop property,making trips simple.
                </p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">Our long history in the automotive sector, dating back to our founding in 1980, says
                    eloquently about our knowledge and
                    dedication.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">At our facilities, we have put together a group of top-notch engineers and technicians
                    that are experts in their fields.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">We have the ability to quickly diagnose and fix any vehicle problem thanks to our
                    state-of-the-art servicing and
                    diagnostic tools, as well as our skilled staff.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">We adhere to strict guidelines and provide top-notch service as a BOSCH approvedauto
                    servicing shop.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">From modest automobiles to large commercial trucks, we service a wide variety of
                    vehicles as an all-inclusive automotive
                    workshop in Abu Dhabi.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">We provide a variety of handy services under one roof, including regular maintenance,
                    advanced maintenance work,
                    automobile AC repair and servicing, and much more.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">Our staff members are friendly and professional in addition to being knowledgeable and
                    skilled, delivering a positive
                    client experience.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">We work hard to go above and beyond your expectations with our fantastic service.</p>
            </div>
            <div class="list">
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <p class="text">Despite the fierce competition in our costs, we never skimp on the caliber of our
                    services. Rest assured that we offer
                    pricing that are not only reasonable but also competitive with the finest in the business.</p>
            </div>
        </div>
    </section>

    <?php view('layouts/footer') ?>

    <script src="<?= assets('js/common.js') ?>"></script>
    <script src="<?= assets('js/swiper.js') ?>"></script>
</body>
</html>