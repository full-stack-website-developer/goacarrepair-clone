<?php 
    $success = $_SESSION["success"] ?? '';
    
    unset(
        $_SESSION["success"],
        $_SESSION["error"]
    );

    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, $currentPage); 
    $offset = ($currentPage - 1) * $itemsPerPage;

    $conn = getConnection();
    $totalSql = "SELECT COUNT(*) as total FROM contacts";
    $totalStmt = $conn->prepare($totalSql);
    $totalStmt->execute();
    $totalContacts = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalContacts / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoaCarRepair | Admin | Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= assets('css/style.css') ?>">
    <style>
        /* .table-responsive { max-height: 800px; overflow-y: auto;  } */
        .table th, .table td { vertical-align: middle; }
        .table img { max-width: 50px; max-height: 50px; object-fit: cover; border-radius: 4px; }
        .disabled {cursor: not-allowed !important;}
    </style>

    
</head>
<body>

   <?php if (!empty($success)) { ?>
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= htmlspecialchars($success) ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } ?>

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
                                <h2>Contacts</h3>
                                
                            </div>
                        <table class="table table-striped table-bordered">
                            
                            <thead style="font-size: 14px; font-weight: 500; color: #333;">
                                <tr>
                            
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Page</th>
                                    <th scope="col" style="width: 20px;">Service</th>
                                    <th scope="col">Message</th>
                                    <th scope="col" style="width: 30px;">Date</th>

                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px; color: #444;">
                                <?php 
                                    $sql = "SELECT * FROM contacts LIMIT :limit OFFSET :offset";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($contacts as $index => $contact){
                                ?>
                                 <tr>
                                        <td><?= htmlspecialchars($contact['name'] ?? '') ?></td>

                                        <td><?= htmlspecialchars($contact['email'] ?? '') ?></td>

                                        <td><?= htmlspecialchars($contact['phone'] ?? '') ?></td>

                                        <td><?= htmlspecialchars($contact['page'] ?? '') ?></td>
                                        
                                        <td><?= htmlspecialchars($contact['service'] ?? '') ?></td>


                                        <td>
                                                <textarea disabled="disabled" id="" class="p-1" style="height: 100px; width: 300px; cursor:not-allowed"><?= htmlspecialchars($contact['message'] ?? '') ?></textarea>
                                            </td>
                                   
                            
                                    <td><?= htmlspecialchars($contact['created_at'] ?? '') ?></td>
                                    <td>
                                   
                                        <a href="/admin/contacts/delete?id=<?= $contact['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this service?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                     
                                      <button type="button" 
                                            class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#exampleModal"
                                            data-contact-id="<?= htmlspecialchars($contact['id']) ?>"
                                            data-contact-email="<?= htmlspecialchars($contact['email']) ?>">
                                           <i class="fa-solid fa-reply"></i>
                                    </button>
                                    </td>
                                </tr>
                                <?php 
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



                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/contacts/reply" method="POST">
                                    <div class="mb-3">
                                        <label for="recipient-email" class="col-form-label">Recipient:</label>
                                        <input type="email" class="form-control" name="recipientEmail" id="recipientEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" name="reply"></textarea>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send message</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

                     <!-- modal ends-->
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= assets('js/single_service.js') ?>"></script>
    <script>    
        var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'New message  ';
    //  + recipient
    // modalBodyInput.value = recipient
})
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var exampleModal = document.getElementById('exampleModal');
            exampleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var contactEmail = button.getAttribute('data-contact-email');
            var contactId = button.getAttribute('data-contact-id');

            // Fill email in modal input
            var emailInput = exampleModal.querySelector('#recipientEmail');
            emailInput.value = contactEmail;

            // Optional: If you want to send the ID too with the form
            let hiddenInput = document.getElementById('contactIdHidden');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'contact_id';
                hiddenInput.id = 'contactIdHidden';
                exampleModal.querySelector('form').appendChild(hiddenInput);
            }
            hiddenInput.value = contactId;
            });
        });
</script>
<!-- Bootstrap JS (before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>