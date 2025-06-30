<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
</head>
<body>
    <?php view('layouts/header') ?>

    <section class="about-page-header-starter">
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
    <section>
        <div class="container mt-5 mb-5">
            <h2 class="fw-bold pb-3">Repair & Mechanical services we offer In Abu Dhabi</h2>
            <p class="text-justify t-primary">At Goa Refitz, we take pride in being one of Abu Dhabi's leading garage companies, providing exceptional car repair and maintenance services to customers throughout the UAE. With over 12 years of experience in the industry, we have built a reputation for our commitment to excellence and customer satisfaction.</p>
            <p class="text-justify t-primary">Our state-of-the-art facility is equipped with the latest diagnostic tools and advanced equipment to ensure accurate and efficient repairs. We have a team of highly skilled and experienced technicians who are continuously trained in the latest automotive technologies and repair techniques. They are dedicated to delivering outstanding results and ensuring that every vehicle that comes through our doors receives the highest level of care.</p>
            <p class="text-justify t-primary">At Goa Refitz, we understand that our customers rely on their vehicles for their daily lives and businesses. That's why we prioritize quick turnaround times without compromising on the quality of our work. We strive to minimize any inconvenience caused by vehicle repairs by providing timely updates, transparent communication, and efficient service.</p>
            <p class="text-justify t-primary">We are committed to forming enduring bonds with our clients via honesty, ethics, and top-notch service. We listen to our clients' demands and concerns as part of our customer-centric approach, and we then customize our services to match their unique needs. We treat every vehicle with the same amount of care and attention, whether it only needs a small repair or a complete overhaul.</p>
            <p class="text-justify t-primary">As an ecologically conscious business, we also make an effort to reduce our environmental effect. We use suitable trash disposal techniques and eco-friendly methods throughout our operations. As we uphold our high standards of service, we hope to contribute to a sustainable future.</p>
            <p class="text-justify t-primary">We take pleasure in our affordable prices in addition to our dedication to client satisfaction. We ensure that our clients get value for their money by providing upfront and reasonable pricing for all of our services. Our objective is to offer solutions that are affordable without sacrificing the caliber of our work.</p>
            <p class="text-justify t-primary">At Goa Refitz, we are not just a garage, but a trusted partner in maintaining the performance, reliability, and safety of your vehicle. Whether you need routine maintenance, complex repairs, or expert advice, we are here to assist you every step of the way. We strive to exceed your expectations and provide you with a positive and memorable experience.</p>
            <h2 class="fw-bold pb-3">Our Vision:</h2>
            <p class="text-justify t-primary">Our vision at Goa Refitz is to be the preferred choice for car repair and maintenance services in Abu Dhabi and the UAE. We aim to continually enhance our expertise, expand our service offerings, and exceed customer expectations to become a trusted partner for all automotive needs.</p>
            <h2 class="fw-bold pb-3">Our Mission:</h2>
            <p class="text-justify t-primary">Our mission is to deliver high-quality car repair and maintenance services that ensure the safety, performance, and longevity of our customers' vehicles. We strive to provide comprehensive solutions, advanced technologies, and personalized attention to meet the diverse needs of our valued clients.</p>
            <h2 class="fw-bold pb-3">12 Years of Excellence:</h2>
            <p class="text-justify t-primary">For over a decade, we have been serving the UAE community with our expertise in fixing cars. Our team of skilled technicians has undergone extensive training and possesses in-depth knowledge of various car models and makes. This enables us to diagnose and repair a wide range of automotive issues efficiently and effectively.</p>
            <h2 class="fw-bold pb-3">Customer Satisfaction:</h2>
            <p class="text-justify t-primary">Customer satisfaction is our first goal at Goa Refitz. We recognize the value of a dependable and trustworthy vehicle repair shop. To guarantee that our clients receive the best possible service, transparency, and professionalism, we go above and above. We pay attention to their issues, provide sincere suggestions, and try to go above and beyond their expectations throughout every engagement.</p>
            <h2 class="fw-bold pb-3">Wide Range of Services:</h2>
            <p class="text-justify t-primary">We offer a comprehensive range of car repair and maintenance services to address all your automotive needs. Our services include:</p>

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

            <p class="text-justify t-primary mt-5">With our state-of-the-art facilities, advanced diagnostic equipment, and genuine parts, we ensure that your vehicle receives the highest quality of care and attention.</p>

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

    <section>
        <div class="container mt-5 mb-5">
            <h2 class="fw-bold pb-3">Choose Goa Refitz:</h2>
            <p class="text-justify t-primary">When you choose Goa Refitz, you can have peace of mind knowing that your vehicle is in the hands of experienced professionals who are dedicated to providing exceptional service. We are committed to delivering reliable, efficient, and cost-effective solutions, all while upholding the highest standards of quality and customer satisfaction. Visit us at Goa Refitz and experience our unparalleled service that keeps your car running at its best. Your satisfaction is our driving force.</p>
        </div>
    </section>

    <?php view('layouts/footer') ?>
</body>
</html>