<?php
// print_r($_SESSION);
// die;

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
                        <form action="/admin/blog/store" method="POST" enctype="multipart/form-data">
                            <div class="form-header">
                                <h1>Blog / Create</h1>
                            </div>
                            <!-- Service Main Info -->
                            <div class="servive-main-info mb-4 p-4 border rounded-3 bg-light">
                                <!-- Buttons -->
                                <div class="d-flex justify-content-end gap-3">
                                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">Save Service</button>
                                    <a href="/admin/blog" class="btn btn-outline-secondary rounded-3 px-4 py-2">Cancel</a>
                                </div>
                                <hr class="mb-2">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="banner" class="form-label fw-bold text-dark">Banner</label>
                                        <input class="form-control rounded-3" type="file" id="banner" name="banner"  onchange="previewBanner(this)">
                                        <p class="text-danger"><?= $bannerError ?></p>
                                        <!-- Image Preview Area -->
                                        <img id="bannerPreview" src="<?php echo assets('images/dummy-image.jpg') ?>" alt="Image Preview" class="img-fluid mt-2 rounded-3" style="max-height: 200px;">
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <label for="title" class="form-label fw-bold text-dark">Title</label>
                                        <input class="form-control rounded-3" type="text" id="title" name="title" placeholder="Enter Blog Title">
                                        <p class="text-danger"><?= $titleError ?></p>
                                    </div>
                                </div>
                                <!-- slug -->
                                <div class="mb-4">
                                    <label for="slug" class="form-label fw-bold text-dark">Slug</label>
                                    <input type="text" class="form-control rounded-3" id="slug" name="slug" placeholder="e.g. Engine Slug" value="">
                                    <p class="text-danger"><?= $slugError ?></p>
                                </div>
                                 <!-- Other Imgs  -->
                                  <div class="col-md-6">
                                    <div class="d-flex mb-1 justify-content-between">
                                        <div class="">Other Imgs</div>
                                        <div class="btn btn-sm btn-primary" onclick="addMoreImageInput()">+</div>
                                    </div>

                                    <!-- Wrapper for all file inputs -->
                                    <div id="otherImagesWrapper">
                                        <div class="d-flex mb-2">
                                            <input class="form-control rounded-3 me-2" type="file" name="otherImages[]">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeInput(this)">❌</button>
                                        </div>
                                    </div>
                                </div>
                                <fieldset>
                                    <legend>Add</legend>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('heading')">Add Heading</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('paragraph')">Add Paragraph</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('image')">Add Image</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('list')">Add List</button>
                                    <button type="button" class="btn btn-primary mb-4" onclick="addField('orderedlist')">Add Ordered List</button>
                                    <div id="dynamicFields"></div>
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
        function previewBanner(input) {
            const preview = document.getElementById('bannerPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '<?php echo assets('images/dummy-image.jpg') ?>';
            }
        }

        // let num = 0;
        function addField(type) {
            // num++;
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
                            <label class="form-label mb-1">Ordered List Item</label>
                            <input type="text" class="form-control rounded-3" name="additional[][lists]" placeholder="Enter list item" >
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
                            <input type="text" class="form-control rounded-3 mb-2" name="additional[][olKey]" placeholder="Key" >
                            <input type="text" class="form-control rounded-3" name="additional[][olVal]" placeholder=" Value" >
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
            wrapper.querySelector('.remove-btn').addEventListener('click', () => {
                wrapper.remove();
            });
            
            wrapper.querySelector('.move-up').addEventListener('click', () => {
                const previous = wrapper.previousElementSibling;
                if (previous && previous.classList.contains('field-wrapper')) {
                    fieldset.insertBefore(wrapper, previous);
                }
            });
            
            wrapper.querySelector('.move-down').addEventListener('click', () => {
                const next = wrapper.nextElementSibling;
                if (next && next.classList.contains('field-wrapper')) {
                    fieldset.insertBefore(next, wrapper);
                }
            });
        }
    </script>
<script>
    function addMoreImageInput() {
        const wrapper = document.getElementById("otherImagesWrapper");

        wrapper.innerHTML += `
            <div class="d-flex mb-2">
                <input class="form-control rounded-3 me-2" type="file" name="otherImages[]">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeInput(this)">x</button>
            </div>
        `;
    }

    function removeInput(button) {
        // Remove the parent div containing the input + button
        button.parentElement.remove();
    }
</script>
</body>

</html>