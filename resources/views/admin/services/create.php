<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= assets('css/style.css')?>">
    <title>create service</title>
</head>
<body>
    <?php layouts('admin-header') ?>
    <?php layouts('admin-sidebar') ?>
    <section>
        <h1 class="fw-bold text-center mt-2">Create New Service</h1>
        <div class="mb-5 p-3 admin-service-create">
            <form action="your-backend-endpoint.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Service Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Engine Repair" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Service Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the service in detail..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Service Image</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Save Service</button>
                    <a href="service-list.php" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
