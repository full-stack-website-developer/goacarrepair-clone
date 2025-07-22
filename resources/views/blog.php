<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap JS (Required for offcanvas) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- jQuery (Required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
    
</head>
<body>
    <?php view('layouts/header') ?>

    <section class="blogs-section">
        <div class="container">
            <h2 class="main-heading text-center mt-5">Latest News In Dubai</h2>
            <div class="blogs-container">

            <?php 
                $sql = "SELECT * FROM blog";
                $conn = getConnection();
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // echo "<pre>";
                // print_r($blogs);
                // die;
                    if(!empty($blogs) && is_array($blogs)){
                        foreach($blogs as $blog){ ?>
                        <div class="blog">
                           <a href="/blog/<?= $blog['slug'] ?>">
                                <div class="image mb-3">
                                    <img src="<?= BASE_URL . $blog['banner']; ?>" alt="">
                                </div>
                                <h3 class="title"><?= $blog['title']; ?></h3>
                                <div class="details-group">
                                    <div class="logo">
                                        <img src="<?= assets('/images/blog-logo.png')  ?>" alt="lux-living logo">
                                    </div>
                                    <div class="detail">
                                        <p>luxliving</p>
                                        <div>
                                            <i class="fa-regular fa-clock"></i>
                                            <p>   <?= date('F j, Y', strtotime($blog['created_at']));  ?>  </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                 <?php  
                    }
                    }
                  ?>
                </div>
            </div>
        </div>
    </section>
    <section class="review-section py-5 bg-dark text-white">
        <div class="container text-center">
            <h2>Happy Customers</h2>
            <p class="mb-2">
            <span class="fw-bold">4.8</span>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star-half-alt text-warning"></i>
            <a href="#" class="text-white text-decoration-underline ms-2">184 Google Reviews</a>
            </p>

            <div class="owl-carousel owl-theme mt-4">
                <!-- Slide 1 -->
                <div class="review-card p-4 bg-secondary rounded text-white">
                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">
                    <strong>J</strong>
                    </div>
                    <h5>James Bicknell</h5>
                    <div class="text-warning mb-2">★★★★★</div>
                    <p class="review-text">
                    Dealing with Maya has been an absolute pleasure. She has been the consummate professional from day one...
                    </p>
                </div>

                <!-- Repeat similar cards -->
                <div class="review-card p-4 bg-secondary rounded text-white">
                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">
                    <strong>G</strong>
                    </div>
                    <h5>Gorkem Yetim</h5>
                    <div class="text-warning mb-2">★★★★★</div>
                    <p class="review-text">
                    Emre is more than just a real estate agent; he is a trustworthy friend. He has always been our eyes and ears...
                    </p>
                </div>

                <!-- Add more cards as needed -->
            </div>

            <button class="btn btn-outline-light mt-4" data-bs-toggle="offcanvas" data-bs-target="#allReviewsCanvas">
                <i class="fas fa-th-large me-2"></i>VIEW ALL
            </button>
            <!-- All Reviews Section (initially hidden) -->

            <!-- Offcanvas Panel -->
            <div class="offcanvas offcanvas-bottom text-bg-dark h-100" tabindex="-1" id="allReviewsCanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">All Reviews</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body overflow-auto">
                    <div class="container">
                        <div class="row g-4">
                            <!-- Repeat review cards -->
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="review-card p-4 bg-secondary rounded text-white h-100">
                                    <div class="review-icon bg-light text-dark rounded-circle mx-auto mb-3">A</div>
                                    <h5 class="text-center">Ali Khan</h5>
                                    <div class="text-warning text-center mb-2">★★★★★</div>
                                    <p>Very helpful and responsive! I got my dream apartment thanks to their amazing team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="brands-section">
        <div class="container brands pt-5 pb-5">
            <h2 class="text-center mb-4">POPULAR MAKES THAT WE SERVICE</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider1.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider2.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider3.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider4.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider5.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider6.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider7.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider8.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider9.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider10.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider11.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider12.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider13.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider14.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider15.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider16.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider17.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider18.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider19.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider20.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider21.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider22.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider23.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider24.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider25.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider26.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider27.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider28.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider29.jpg') ?>"
                            alt="service image" /></div>
                    <div class="swiper-slide"><img src="<?php echo assets('images/home/slider30.jpg') ?>"
                            alt="service image" /></div>

                </div>
            </div>
            <!-- Arrows -->

            <div class="arrows">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        </div>
    </section>

    <?php view('layouts/footer') ?>
    <script src="<?= assets('js/common.js') ?>"></script>
    <script src="<?= assets('js/swiper.js') ?>"></script>
    <script src="<?= assets('js/owlCarousel.js') ?>"></script>
</body>
</html>