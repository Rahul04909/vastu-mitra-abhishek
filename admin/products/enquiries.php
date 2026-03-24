<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("DELETE FROM product_enquiries WHERE id = ?");
        if ($stmt->execute([$id])) {
            $successMsg = "Product enquiry deleted successfully.";
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting enquiry: " . $e->getMessage();
    }
}

// Pagination & Filtering
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$whereClauses = [];
$params = [];

if (!empty($_GET['name'])) {
    $whereClauses[] = "name LIKE ?";
    $params[] = "%" . $_GET['name'] . "%";
}
if (!empty($_GET['product'])) {
    $whereClauses[] = "product_name LIKE ?";
    $params[] = "%" . $_GET['product'] . "%";
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

// Fetch Enquiries
try {
    $sql = "SELECT * FROM product_enquiries 
            $whereSql 
            ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $enquiries = $stmt->fetchAll();

    // Get total for pagination
    $stmtTotal = $dbh->prepare("SELECT COUNT(*) FROM product_enquiries $whereSql");
    $stmtTotal->execute($params);
    $totalEnquiries = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalEnquiries / $limit);
} catch (PDOException $e) {
    $enquiries = [];
    $errorMsg = "Error fetching enquiries: " . $e->getMessage();
}

include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Enquiries</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= $successMsg ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="card card-default">
            <div class="card-header border-0">
                <h3 class="card-title text-muted shadow-none">Filter Enquiries</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="enquiries.php" class="row">
                    <div class="col-md-5">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold">Client Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Search by client name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold">Product Name</label>
                            <input type="text" name="product" class="form-control" placeholder="Search by product name" value="<?= htmlspecialchars($_GET['product'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group mb-0 w-100">
                            <button type="submit" class="btn btn-primary btn-block px-4">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enquiry List -->
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Detailed Leads</h3>
                <div class="card-tools">
                   <a href="enquiries.php" class="btn btn-tool text-primary"><i class="fas fa-sync"></i> Refresh</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px" class="text-center">ID</th>
                            <th>Client Details</th>
                            <th>Product Interest</th>
                            <th style="width: 130px">Received</th>
                            <th style="width: 80px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enquiries)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x d-block mb-3 opacity-25"></i>
                                    No product enquiries found matching your criteria.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($enquiries as $e): ?>
                                <tr>
                                    <td class="text-center text-muted small py-3"><?= $e['id'] ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#modal-prod-view-<?= $e['id'] ?>">
                                                <?= htmlspecialchars($e['name']) ?>
                                            </a>
                                            <small class="text-muted d-block mt-1">
                                                <i class="fas fa-envelope mr-1 opacity-50"></i> <?= htmlspecialchars($e['email']) ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-phone mr-1 opacity-50"></i> <?= htmlspecialchars($e['phone']) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark font-weight-bold" style="font-size: 0.95rem;"><?= htmlspecialchars($e['product_name']) ?></span>
                                            <small class="text-muted mt-1 text-truncate" style="max-width: 300px;">
                                                <i class="fas fa-comment-alt mr-1 opacity-50"></i> 
                                                <?= htmlspecialchars(mb_strimwidth($e['message'], 0, 80, "...")) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="font-weight-bold d-block"><?= date('d M Y', strtotime($e['created_at'])) ?></small>
                                        <small class="text-muted"><?= date('H:i A', strtotime($e['created_at'])) ?></small>
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="enquiries.php?delete=<?= $e['id'] ?>" 
                                           class="btn btn-xs btn-outline-danger rounded-circle p-2" 
                                           onclick="return confirm('Permanently remove this enquiry?')"
                                           title="Delete Enquiry">
                                           <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- Product Enquiry Details Modal -->
                                <div class="modal fade shadow" id="modal-prod-view-<?= $e['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title font-weight-bold"><i class="fas fa-box-open mr-2"></i> Product Enquiry #<?= $e['id'] ?></h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row mb-4 bg-light p-3 rounded mx-0 border-left border-primary" style="border-left-width: 4px !important;">
                                                    <div class="col-md-6">
                                                        <label class="text-muted text-uppercase small font-weight-bold mb-1 d-block">Client Contact</label>
                                                        <p class="mb-1"><strong><i class="fas fa-user mr-1 text-primary"></i> Name:</strong> <?= htmlspecialchars($e['name']) ?></p>
                                                        <p class="mb-1"><strong><i class="fas fa-envelope mr-1 text-primary"></i> Email:</strong> <a href="mailto:<?= htmlspecialchars($e['email']) ?>"><?= htmlspecialchars($e['email']) ?></a></p>
                                                        <p class="mb-0"><strong><i class="fas fa-phone mr-1 text-primary"></i> Phone:</strong> <?= htmlspecialchars($e['phone']) ?></p>
                                                    </div>
                                                    <div class="col-md-6 pl-md-4 border-left">
                                                        <label class="text-muted text-uppercase small font-weight-bold mb-1 d-block">Enquiry Context</label>
                                                        <p class="mb-1 text-primary font-weight-bold"><strong><i class="fas fa-shopping-cart mr-1"></i> Product:</strong> <?= htmlspecialchars($e['product_name']) ?></p>
                                                        <p class="mb-0 text-muted"><strong><i class="fas fa-calendar-check mr-1"></i> Date:</strong> <?= date('d M Y, H:i A', strtotime($e['created_at'])) ?></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 p-0">
                                                    <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block text-center border-bottom pb-2">User Message</label>
                                                    <div class="p-4 bg-white border rounded shadow-sm text-secondary" style="line-height: 1.8; font-size: 1.05rem;">
                                                        <i class="fas fa-quote-left mr-2 opacity-25"></i>
                                                        <?= nl2br(htmlspecialchars($e['message'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">Close</button>
                                                <a href="mailto:<?= htmlspecialchars($e['email']) ?>?subject=Inquiry regarding: <?= htmlspecialchars($e['product_name']) ?>" class="btn btn-primary btn-sm px-4 shadow-sm">
                                                    <i class="fas fa-reply mr-2"></i> Professional Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="card-footer clearfix bg-white">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&product=<?= urlencode($_GET['product'] ?? '') ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&product=<?= urlencode($_GET['product'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&product=<?= urlencode($_GET['product'] ?? '') ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
