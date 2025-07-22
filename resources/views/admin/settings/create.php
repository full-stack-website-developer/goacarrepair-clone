<?php

$successMessage = $_SESSION["success"] ?? '';
$errorMessage = $_SESSION["error"] ?? '';

$logoError  = $_SESSION['errors']["logoError"] ?? '';
$phoneError = $_SESSION['errors']["phoneError"] ?? "";
$emailError = $_SESSION['errors']['emailError'] ?? '';

unset(
    $_SESSION["success"],
    $_SESSION["error"], 

    $_SESSION["logoError"],
    $_SESSION["phoneError"],
    $_SESSION["emailError"]
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoaCarRepair Admin Settings</title>
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
            <div class="p-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach($data['breadcrumbs'] as $breadcrumb) { 
                            ?>
                        <li class="breadcrumb-item " aria-current="page">
                          <?php if(isset($breadcrumb['href'])) { ?>      
                        <a href="<?= $breadcrumb['href'] ?>"><?= $breadcrumb['title']?></a>
                            <?php }else { ?>
                                <?= $breadcrumb['title']?>
                              <?php } ?> 
                    </li>
                        <?php } ?>
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
                        <form action="/admin/settings/store" method="POST" enctype="multipart/form-data">
                            <div class="form-header">
                                <h1>Settings / Create</h1>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/admin/settings" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <div class="mb-4">
                                    <label for="logo" class="form-label fw-bold text-dark">Add  Logo</label>
                                    <input class="form-control rounded-3" type="file" id="logo" name="logo">
                                    <p class="text-danger"><?= $logoError ?></p>
                                    <!-- Image Preview Area -->
                                    <div class="mt-3">
                                        <img id="imagePreview" src="<?= assets('images/dummy-image.jpg') ?>" alt="Image Preview"
                                         style="max-width: 200px; max-height: 200px; object-fit: contain;" class="rounded">
                                    </div>
                                    <!-- sort order -->
                                     <div class="mt-3">
                                         <label for="email" class="form-label fw-bold text-dark">Email</label>
                                         <input class="form-control rounded-3" type="email" id="email" name="email" placeholder="Enter Email">
                                         <p class="text-danger"><?= $emailError ?></p>
                                    </div>
                                    <div class="mt-3">
                                         <label for="text" class="form-label fw-bold text-dark">Phone</label>
                                         <input class="form-control rounded-3" type="text" id="phone" name="phone" placeholder="Enter phone">
                                         <p class="text-danger"><?= $phoneError ?></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
        // Get the file input and image preview elements
        const galleryInput = document.getElementById('logo');
        const imagePreview = document.getElementById('imagePreview');

        // Listen for changes in the file input
        galleryInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the first selected file

            if (file) {
                // Create a URL for the selected file and set it as the image source
                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    imagePreview.src = e.target.result; // Set the preview image
                };
                fileReader.readAsDataURL(file); // Read the file as a data URL
            } else {
                // If no file is selected, show the placeholder image
                imagePreview.src = '<?= assets('images/dummy-image.jpg') ?>';
            }
        });
    </script>
    <script src="<?= assets('js/single_service.js')  ?>"></script>
    
</body>
</html>