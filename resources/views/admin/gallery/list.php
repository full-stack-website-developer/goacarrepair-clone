<?php 
    $successMessage = $_SESSION["success"] ?? '';
    $errorMessage = $_SESSION["error"] ?? '';

    unset(
        $_SESSION["success"],
        $_SESSION["error"]
    );

    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, $currentPage); 
    $offset = ($currentPage - 1) * $itemsPerPage;

    $conn = getConnection();
    $totalSql = "SELECT COUNT(*) as total FROM galleries";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->execute();
    $totalGalleries = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalGalleries / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoaCarRepair | Admin | Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
    <style>
        .table-responsive { max-height: 800px; overflow-y: auto;  }
        .table th, .table td { vertical-align: middle; }
        .table img { max-width: 50px; max-height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php layouts('admin-sidebar')?>
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 280px;">
            <!-- Header -->
            <?php layouts('admin-header')?>
            <!-- Main Content Area -->
            <div class="p-4">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php foreach ($data['breadcrumbs'] as $breadcrumbs) { ?>
                    <li class="breadcrumb-item">
                        <?php if (isset($breadcrumbs['href'])) { ?>
                            <a href="<?= $breadcrumbs['href'] ?>"><?= $breadcrumbs['title'] ?></a>
                        <?php } else { ?>
                            <?= $breadcrumbs['title'] ?>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ol>
                </nav>
                
                <div class="container-fluid mt-5">
                  <div class="card shadow-sm p-3" style="border-radius: 12px; border: none; background: #fff;">
                    <div class="table-responsive show-table">
                        <div class="list-header">
                                <h2>Gallery</h3>
                                <a href="/admin/gallery/create" class="btn btn-primary">
                                    <i class="fa fa-plus me-1"></i> 
                                </a>
                            </div>
                        <table class="table table-striped table-bordered">
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
                            
                            <thead style="font-size: 14px; font-weight: 500; color: #333;">
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Gallery Image</th>
                                    <th scope="col">Sort Order</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px; color: #444;">
                                <?php 
                                    $sql = "SELECT * FROM galleries LIMIT :limit OFFSET :offset";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $galleries = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($galleries as $index => $gallery){
                                        if($gallery['id'] > 0){
                                ?>
                                 <tr>
                                    <td><?= htmlspecialchars($gallery['id']) ?></td>
                                    
                                    <td><img src="<?= BASE_URL . htmlspecialchars($gallery['gallery_image']) ?>" alt="Banner" style="height: 100px; width=100px;"></td>
                                      <td><?= htmlspecialchars($gallery['sort_order']) ?></td>
                                    <td><?= htmlspecialchars($gallery['created_at']) ?></td>
                                    <td>
                                        <a href="/admin/galleries/edit?editId=<?= $gallery['id'] ?>" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/galleries/delete?id=<?= $gallery['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this service?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                }else{ ?>
                                    <tr>
                                        <td>No Data Found</td>
                                    </tr>
                                    <?php
                                }
                             }
                            
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation" class="d-flex justify-content-end mt-4">
                            <ul class="pagination">
                                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++){ ?>
                                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php } ?>
                                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= assets('js/single_service.js') ?>"></script>
</body>
</html>