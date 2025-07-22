<?php
$conn = getConnection();
$successMessage = $_SESSION["success"] ?? '';
$errorMessage = $_SESSION["error"] ?? '';
$galleryImageError = $_SESSION["galleryError"] ?? '';
$sortOrder = $_SESSION["orderError"] ?? "";

unset(
    $_SESSION["success"],
    $_SESSION["error"], 
    $_SESSION["galleryError"],
    $_SESSION["orderError"]
);

if(isset($_GET['editId'])){
    $editId = $_GET['editId'];
}

$sql = "SELECT * FROM galleries WHERE id = :editId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':editId', $editId, PDO::PARAM_INT);
$stmt->execute();
$galleries = $stmt->fetchAll(PDO::FETCH_ASSOC);
$galleries = $galleries[0];

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
        <?php layouts('admin-sidebar')?>
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 280px;">
            <?php layouts('admin-header')?>
            <div class="p-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach($data['breadcrumbs'] as $breadcrumb) { ?>
                        <li class="breadcrumb-item" aria-current="page">
                            <?php if(isset($breadcrumb['href'])) { ?>      
                            <a href="<?= $breadcrumb['href'] ?>"><?= $breadcrumb['title']?></a>
                            <?php } else { ?>
                                <?= $breadcrumb['title']?>
                            <?php } ?> 
                        </li>
                        <?php } ?>
                    </ol>
                </nav>

                <div class="container-fluid mt-5 px-3">
                    <div class="card shadow-sm p-4 p-md-5 border-0">
                        <form action="/admin/gallery/update" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="editId" value="<?= $editId ?>">
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
                                <h1>Gallery / Edit</h1>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/admin/gallery" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <div class="mb-4">
                                    <label for="gallery" class="form-label fw-bold text-dark">Add Gallery Image</label>
                                    <input class="form-control rounded-3" type="file" id="gallery" name="gallery_image" accept="image/*" id="galleryImageInput">
                                    <!-- Existing Image -->
                                    <div id="existingImage" class="mt-2" style="<?php echo !empty($galleries['gallery_image']) ? '' : 'display: none;'; ?>">
                                        <?php if (!empty($galleries['gallery_image'])) { ?>
                                            <img src="<?= BASE_URL . $galleries['gallery_image'] ?>" alt="Existing Image" class="img-fluid" style="max-height: 100px;">
                                        <?php } ?>
                                    </div>
                                    <p class="text-danger" id="galleryErrorMsg"><?= $galleryImageError ?></p>
                                    <!-- Image Preview Area -->
                                    <div class="mt-3">
                                        <img id="imagePreview" src="<?= !empty($galleries['gallery_image']) ? BASE_URL . $galleries['gallery_image'] : assets('images/dummy-image.jpg') ?>" alt="Image Preview" style="max-width: 200px; max-height: 200px; object-fit: contain;" class="rounded">
                                    </div>
                                     <!-- sort order -->
                                       <label for="sort-order" class="form-label fw-bold text-dark">Sort Order</label>
                                        <input class="form-control rounded-3" type="text" id="sort-order" value="<?= $galleries['sort_order'] ?>" name="sort_order" placeholder="Enter Sort Order Number">
                                         <p class="text-danger"><?= $sortOrder ?></p>
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
        document.addEventListener('DOMContentLoaded', () => {
        const fileInput   = document.getElementById('galleryImageInput');
        const errorPara   = document.getElementById('galleryErrorMsg');

        // 1️⃣ On every change (user selects or clears a file)…
        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files.length > 0) {
            // A file is selected → hide the error
            errorPara.classList.add('d-none'); 
            errorPara.innerHTML = "";  // Bootstrap utility
            } else {
            // No file selected → show the error again (optional)
            errorPara.classList.remove('d-none');
            }
        });
        });
    </script>

    <script>
        // Get the file input, image preview, and existing image elements
        const galleryInput = document.getElementById('gallery');
        const imagePreview = document.getElementById('imagePreview');
        const existingImage = document.getElementById('existingImage');

        // Listen for changes in the file input
        galleryInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the first selected file

            if (file) {
                // Hide the existing image
                existingImage.style.display = 'none';
                // Create a URL for the selected file and set it as the image source
                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    imagePreview.src = e.target.result; // Set the preview image
                };
                fileReader.readAsDataURL(file); // Read the file as a data URL
            } else {
                // If no file is selected, show the existing image (if available) or fallback to placeholder
                existingImage.style.display = '<?php echo !empty($galleries['gallery_image']) ? "block" : "none"; ?>';
                imagePreview.src = '<?php echo !empty($galleries['gallery_image']) ? BASE_URL . $galleries['gallery_image'] : assets('images/dummy-image.jpg'); ?>';
            }
        });
    </script>
    <script src="<?= assets('js/single_service.js') ?>"></script>
</body>
</html>