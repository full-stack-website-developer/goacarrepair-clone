<?php

$conn = getConnection();

if (isset($_GET['slug'])) {
        $slug = $_GET['slug'];
}

$sql = "SELECT * FROM blog WHERE Slug = :slug";
$stmt = $conn->prepare($sql);
$stmt->execute([
        ":slug" => $slug,
]);
// echo "<pre>";
$blog = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($blog);
// die;

$commentId = $blog['id'];
// echo $id;
// die;
$decodedContent = json_decode($blog['content'], TRUE);
// echo "<pre>";
// print_r($decodedContent);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Single blog</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= assets('css/style.css') ?>">

        <!-- swiper -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
</head>

<body>
        <?php view('layouts/header') ?>


        <section class="blog-section">
                <div class="container">
                        <p class="date text-center mb-2"><?= date('F j, Y', strtotime($blog['created_at'])); ?> by luxliving</p>
                        <h1 class="main-heading text-center mb-4"><?= $blog['title']; ?></h1>
                        <div class="image">
                                <img src="<?= BASE_URL . $blog['banner']; ?>" alt="">
                        </div>
                        <?php $olKey = ""; ?>
                        <?php foreach ($decodedContent as $index => $data) { ?>
                                <?php if (isset($data['heading'])) { ?>
                                        <h2><?= $data['heading'] ?></h2>
                                <?php } elseif (isset($data['image'])){ ?>
                                        <div class="image">
                                                <img src="<?= BASE_URL . $data['image']; ?>" alt="">
                                         </div>
                                <?php } else if (isset($data['paragraphs'])) { ?>
                                        <p><?= $data['paragraphs'] ?></p>
                                <?php } elseif (isset($data['lists'])) { ?>
                                        <ul>
                                                <li><?= $data['lists']; ?></li>
                                        </ul>
                                <?php  } elseif (isset($data['olKey'])) {
                                        $olKey = $data['olKey'];
                                } elseif (isset($data['olVal'])) { ?>
                                        <ol>
                                                <?php
                                                echo "<ol><li><b>{$olKey}:</b> {$data['olVal']}</li></ol>";
                                                $olKey = ''; ?>
                                        </ol>
                        <?php
                                }
                        } ?>
                </div>
        </section>
        <!-- comment -->
        <?php $sql = "SELECT comment FROM blog WHERE id = :commentId";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
                ':commentId' => $commentId,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($row['comment']);
        //   echo "</pre>";
        // //   die;

        if(!$row['comment']){
                $row['comment'] = "";
        }
        $comment = json_decode($row['comment'], TRUE);

        ?>
        <section class="comment-section">
                <div class="container">
                        <?php if(isset($comment) && is_array($comment)) {
                           foreach ($comment as $data) { ?>
                                <div class="d-flex flex-start mb-5 mt-5">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                                src="<?= assets('images/user.png') ?>" alt="avatar" width="65"
                                                height="65" />
                                        <div class="flex-grow-1 flex-shrink-1">

                                                <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                        <?= $data['name'] ?> <span class="small">- <?= $data['time'] ?></span>
                                                                </p>
                                                                <!-- <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a> -->
                                                        </div>
                                                        <p class="small mb-0">
                                                                <?= $data['comment']; ?>.
                                                        </p>
                                                </div>

                                        </div>
                                </div>
                        <?php } }?>
                </div>
        </section>



        <section class="reply-section">
                <div class="container">
                        <h3>Leave a Reply</h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                        <form action="/admin/blog/store" class="comment-form" method="POST">
                                <input type="hidden" name="commentId" value="<?= $commentId ?>">
                                <input type="hidden" name="slug" value="<?= $slug ?>">
                                <div class="mb-3">
                                        <label for="comment" class="form-label">Comment *</label>
                                        <textarea class="form-control" id="comment" rows="2" name="comment"></textarea>
                                </div>
                                <div class="mb-3">
                                        <label for="name" class="form-label">Name *</label>
                                        <input type="text" class="form-control p-3" id="name" name="name">
                                </div>

                                <div class="mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="text" class="form-control p-3" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="url" class="form-control p-3" id="website" name="website">
                                </div>
                                <input type="checkbox" name="saveDetails">
                                <label for="saveDetails" class="ps-2">Save my name, email, and website in this browser for the next time I comment.</label>
                                <div class="btn-post mt-3 mb-5">
                                        <button type="submit" name="comment-btn">Post Comment</button>
                                </div>
                        </form>
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

</body>

</html>