<?php
echo "<pre>";
$val = $_SESSION['temp_data'];
$oldTitle = $val['title'];
$oldSlug = $val['slug'];
die;
$conn = getConnection();
if (isset($_GET["editId"])) {
    $id = $_GET['editId'];
} else {
    die('id not found');
}

$sql = "SELECT * FROM blog WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $id,
]);

$blogData = $stmt->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($blogData);
$decodedContent = json_decode($blogData['content'], TRUE);
// print_r($decodedContent);
// echo "</pre>";
// // die;

$bannerError = $_SESSION['errors']['banner'] ?? "";
$titleError = $_SESSION['errors']['title'] ?? "";
$slugError = $_SESSION['errors']['slug'] ?? "";
$descriptionError = $_SESSION['errors']['description'] ?? "";

$successMessage = $_SESSION["success"] ?? '';
$errorMessage = $_SESSION["error"] ?? '';

unset(
    $_SESSION["success"],
    $_SESSION["error"],
    $_SESSION['errors']['banner'],
    $_SESSION['errors']['title'],
    $_SESSION['errors']['slug'],
    $_SESSION['errors']['description']
);
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
    <style>
        .input-wrapper {
            display: flex;
        }

        .display-hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <?php layouts('admin-sidebar') ?>
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 280px;">
            <?php layouts('admin-header') ?>
            <!-- Main Content Area -->
            <div class="p-4">
                <div class="container-fluid mt-5 px-3">
                    <div class="card shadow-sm p-4 p-md-5 border-0">
                        <div class="alert-area mb-4">
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $successMessage ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($errorMessage)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $errorMessage ?>
                                </div>
                            <?php } ?>
                        </div>
                        <form action="/admin/blog/update" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="editId" value="<?= $id ?>">
                            <input type="hidden" >
                            <div class="form-header">
                                <h1>Blog / Update</h1>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <!-- Buttons -->
                                <div class="d-flex justify-content-end gap-3">
                                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">Submit</button>
                                    <a href="/admin/blog" class="btn btn-outline-secondary rounded-3 px-4 py-2">Cancel</a>
                                </div>
                                <hr class="mb-2">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="banner" class="form-label fw-bold text-dark">Banner</label>
                                        <input class="form-control rounded-3" type="file" id="banner" name="banner" onchange="previewBanner(this)">
                                        <p class="text-danger"><?= $bannerError ?></p>
                                        <!-- Image Preview Area -->
                                        <div class="d-flex">
                                            <div class="previousImage">
                                                <p>Previous Image</p>
                                                <img id="previousImage" src="<?= BASE_URL . $blogData['banner']; ?>" alt="Image Preview" class="img-thumbnail mt-2 rounded-3" style="max-height: 200px;">
                                            </div>
                                            <div class="newImage display-hidden">
                                                <p>New Image</p>
                                                <img id="bannerPreview" src="<?php echo assets('images/dummy-image.jpg') ?>" alt="Image Preview" class="img-thumbnail mt-2 rounded-3" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="title" class="form-label fw-bold text-dark">Title</label>
                                        <input class="form-control rounded-3" type="text" id="title" name="title" placeholder="Enter Blog Title" value="<?= isset($oldTitle) ? $oldTitle : $blogData['title']; ?>">
                                        <p class="text-danger"><?= $titleError ?></p>
                                    </div>
                                </div>
                                <!-- slug -->
                                <div class="mb-4">
                                    <label for="slug" class="form-label fw-bold text-dark">Slug</label>
                                    <input type="text" class="form-control rounded-3" id="slug" name="slug" placeholder="e.g. Engine Slug" value="<?= isset($oldSlug) ?  $oldSlug : $blogData['slug'];  ?>">
                                    <p class="text-danger"><?= $slugError ?></p>
                                </div>
                                <!-- Other Imgs -->
                                <div class="col-md-6">
                                    <div class="d-flex mb-1 justify-content-between">
                                        <div>Other Imgs</div>
                                        <div class="btn btn-sm btn-primary" onclick="addMoreImageInput()">+</div>
                                    </div>

                                    <!-- Wrapper for all file inputs -->
                                    <div id="otherImagesWrapper">
                                        <?php foreach($decodedContent as $index => $data){ ?>
                                            <?php if (isset($data['image'])){ ?>
                                                <div class="mb-3 image-input-wrapper">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <input class="form-control rounded-3 me-2" type="file" name="otherImages[]" onchange="OtherNewPreview(this, <?php echo $index; ?>)">
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeInput(this)">❌</button>
                                                    </div>
                                                    <div class="otherPrevImg">
                                                        <p>Prev Img</p>
                                                        <img src="<?= BASE_URL . $data['image']; ?>" alt="othersAdditionalImgs" class="img-thumbnail" style="max-width: 150px;">
                                                    </div>
                                                    <div class="otherNewImage display-hidden" id="otherNewImage_<?php echo $index; ?>">
                                                        <p>New Image</p>
                                                        <img id="otherNewPreview_<?php echo $index; ?>" src="<?php echo assets('images/dummy-image.jpg') ?>" alt="Image Preview" class="img-thumbnail mt-2 rounded-3" style="max-height: 200px;">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>

                                <fieldset>
                                    <legend>Add</legend>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('heading')">Add Heading</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('paragraph')">Add Paragraph</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('image')">Add Image</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('list')">Add List</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('orderedlist')">Add Ordered List</button>
                                    <div id="dynamicFields">
                                        <?php foreach ($decodedContent as $index => $data) { ?>
                                            <div class="row mb-3 align-items-center field-wrapper">
                                                <?php if (isset($data['heading'])) {
                                                    $olKey = "";
                                                    $heading = $data['heading']; ?>
                                                    <div class="col">
                                                        <label class="form-label mb-1">Heading</label>
                                                        <input type="text" class="form-control rounded-3" name="additional[][heading]" placeholder="Enter heading text" value="<?= $heading ?>">
                                                    </div>
                                                    <div class="col-auto d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                                                    </div>

                                                <?php } elseif (isset($data['paragraphs'])) {
                                                    $paragraph = $data['paragraphs']; ?>
                                                    <div class="col">
                                                        <label class="form-label mb-1">Paragraph</label>
                                                        <textarea class="form-control rounded-3" name="additional[][paragraphs]" rows="4" placeholder="Enter paragraph text"><?= $data['paragraphs'] ?></textarea>
                                                    </div>
                                                    <div class="col-auto d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                                                    </div>

                                                <?php } elseif (isset($data['lists'])) {
                                                    $lists = $data['lists']; ?>
                                                    <div class="col">
                                                        <label class="form-label mb-1">List Item</label>
                                                        <input type="text" class="form-control rounded-3" name="additional[][lists]" placeholder="Enter list item" value="<?= $data['lists']; ?>">
                                                    </div>
                                                    <div class="col-auto d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                                                    </div>

                                                <?php } elseif (isset($data['olKey'])) {
                                                    $olKey = $data['olKey'];
                                                } elseif (isset($data['olVal'])) {
                                                    $olVal = $data['olVal']; ?>
                                                    <div class="col">
                                                        <label class="form-label mb-1">Ordered List Item</label>
                                                        <input type="text" class="form-control rounded-3 mb-2" name="additional[][olKey]" placeholder="Key" value="<?= $olKey ?>">
                                                        <input type="text" class="form-control rounded-3" name="additional[][olVal]" placeholder="Value" value="<?= $olVal ?>">
                                                    </div>
                                                    <div class="col-auto d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                                                    </div>
                                                <?php $olKey = "";
                                                }elseif(isset($data['image'])) { ?>
                                                    <div class="col">
                                                        <label class="form-label mb-1">Image Upload</label>
                                                        <input type="hidden" class="form-control rounded-3" name="additional[][image]" accept="image/*">
                                                    </div>
                                                    <div class="col-auto d-flex gap-2">
                                                        <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                                                    </div>
                                            <?php  } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= assets('js/single_service.js') ?>"></script>

    <script>
        // Initialize visibility of new image previews
        document.querySelectorAll('.newImage, .otherNewImage').forEach(img => {
            img.classList.add('display-hidden');
        });

        function previewBanner(input) {
            const newImage = document.querySelector('.newImage');
            const previousImage = document.querySelector('.previousImage');
            const preview = document.getElementById('bannerPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    newImage.classList.remove('display-hidden');
                    if (previousImage) {
                        previousImage.classList.add('display-hidden');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '<?php echo assets('images/dummy-image.jpg') ?>';
                newImage.classList.add('display-hidden');
                if (previousImage) {
                    previousImage.classList.remove('display-hidden');
                }
            }
        }

        function OtherNewPreview(input, index) {
            const newImage = document.getElementById(`otherNewImage_${index}`);
            const prevImage = input.closest('.image-input-wrapper').querySelector('.otherPrevImg');
            const preview = document.getElementById(`otherNewPreview_${index}`);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    newImage.classList.remove('display-hidden');
                    if (prevImage) {
                        prevImage.classList.add('display-hidden');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '<?php echo assets('images/dummy-image.jpg') ?>';
                newImage.classList.add('display-hidden');
                if (prevImage) {
                    prevImage.classList.remove('display-hidden');
                }
            }
        }

        function addField(type) {
            const fieldset = document.querySelector('#dynamicFields');
            const wrapper = document.createElement('div');
            wrapper.classList.add('row', 'mb-3', 'align-items-center', 'field-wrapper');

            let htmlContent = '';
            switch (type) {
                case 'heading':
                    htmlContent = `
                        <div class="col">
                            <label class="form-label mb-1">Heading</label>
                            <input type="text" class="form-control rounded-3" name="additional[][heading]" placeholder="Enter heading text">
                        </div>
                        <div class="col-auto d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                        </div>
                    `;
                    break;
                case 'paragraph':
                    htmlContent = `
                        <div class="col">
                            <label class="form-label mb-1">Paragraph</label>
                            <textarea class="form-control rounded-3" name="additional[][paragraphs]" rows="4" placeholder="Enter paragraph text"></textarea>
                        </div>
                        <div class="col-auto d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                        </div>
                    `;
                    break;
                case 'image':
                    htmlContent = `
                         <div class="col">
                            <label class="form-label mb-1">Image Upload</label>
                            <input type="hidden" class="form-control rounded-3" name="additional[][image]" accept="image/*">
                        </div>
                        <div class="col-auto d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                        </div>
                    `;
                    break;
                case 'list':
                    htmlContent = `
                        <div class="col">
                            <label class="form-label mb-1">List Item</label>
                            <input type="text" class="form-control rounded-3" name="additional[][lists]" placeholder="Enter list item">
                        </div>
                        <div class="col-auto d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                        </div>
                    `;
                    break;
                case 'orderedlist':
                    htmlContent = `
                        <div class="col">
                            <label class="form-label mb-1">Ordered List Item</label>
                            <input type="text" class="form-control rounded-3 mb-2" name="additional[][olKey]" placeholder="Key">
                            <input type="text" class="form-control rounded-3" name="additional[][olVal]" placeholder="Value">
                        </div>
                        <div class="col-auto d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm move-up" aria-label="Move up"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-primary btn-sm move-down" aria-label="Move down"><i class="fas fa-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                        </div>
                    `;
                    break;
                default:
                    return;
            }

            wrapper.innerHTML = htmlContent;
            fieldset.appendChild(wrapper);

            // Add event listeners for remove and move buttons
            attachFieldEventListeners(wrapper);
        }

        function addMoreImageInput() {
            const wrapper = document.getElementById("otherImagesWrapper");
            const index = document.querySelectorAll('.image-input-wrapper').length;
            wrapper.innerHTML += `
                <div class="mb-3 image-input-wrapper">
                    <div class="d-flex align-items-center mb-2">
                        <input class="form-control rounded-3 me-2" type="file" name="otherImages[]" onchange="OtherNewPreview(this, ${index})">
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeInput(this)">❌</button>
                    </div>
                    <div class="otherNewImage display-hidden" id="otherNewImage_${index}">
                        <p>New Image</p>
                        <img id="otherNewPreview_${index}" src="<?php echo assets('images/dummy-image.jpg') ?>" alt="Image Preview" class="img-thumbnail mt-2 rounded-3" style="max-height: 200px;">
                    </div>
                </div>
            `;
        }

        function removeInput(button) {
            button.closest('.image-input-wrapper').remove();
        }

        function attachFieldEventListeners(wrapper) {
            const removeBtn = wrapper.querySelector('.remove-btn');
            const moveUpBtn = wrapper.querySelector('.move-up');
            const moveDownBtn = wrapper.querySelector('.move-down');

            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    wrapper.remove();
                });
            }

            if (moveUpBtn) {
                moveUpBtn.addEventListener('click', () => {
                    const previous = wrapper.previousElementSibling;
                    if (previous && previous.classList.contains('field-wrapper')) {
                        wrapper.parentNode.insertBefore(wrapper, previous);
                    }
                });
            }

            if (moveDownBtn) {
                moveDownBtn.addEventListener('click', () => {
                    const next = wrapper.nextElementSibling;
                    if (next && next.classList.contains('field-wrapper')) {
                        wrapper.parentNode.insertBefore(next, wrapper);
                    }
                });
            }
        }

        // Attach event listeners to existing dynamic fields
        document.querySelectorAll('#dynamicFields .field-wrapper').forEach(wrapper => {
            attachFieldEventListeners(wrapper);
        });
    </script>
</body>

</html>