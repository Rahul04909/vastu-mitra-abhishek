<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        // Fetch enquiry to see if it has an attachment to delete
        $stmt = $dbh->prepare("SELECT attachment FROM footer_enquiries WHERE id = ?");
        $stmt->execute([$id]);
        $enquiry = $stmt->fetch();

        if ($enquiry) {
            if ($enquiry['attachment'] && file_exists(__DIR__ . '/../../' . $enquiry['attachment'])) {
                unlink(__DIR__ . '/../../' . $enquiry['attachment']);
            }

            $stmt = $dbh->prepare("DELETE FROM footer_enquiries WHERE id = ?");
            if ($stmt->execute([$id])) {
                $successMsg = "Enquiry deleted successfully.";
            }
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
if (!empty($_GET['service_type'])) {
    $whereClauses[] = "service_type = ?";
    $params[] = $_GET['service_type'];
}
if (!empty($_GET['country'])) {
    $whereClauses[] = "country = ?";
    $params[] = $_GET['country'];
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

// Fetch Enquiries
try {
    $sql = "SELECT * FROM footer_enquiries 
            $whereSql 
            ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $enquiries = $stmt->fetchAll();

    // Get total for pagination
    $stmtTotal = $dbh->prepare("SELECT COUNT(*) FROM footer_enquiries $whereSql");
    $stmtTotal->execute($params);
    $totalEnquiries = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalEnquiries / $limit);
} catch (PDOException $e) {
    $enquiries = [];
    $errorMsg = "Error fetching enquiries: " . $e->getMessage();
}

// Fetch unique service types and countries for filters
$service_types = $dbh->query("SELECT DISTINCT service_type FROM footer_enquiries WHERE service_type IS NOT NULL AND service_type != ''")->fetchAll(PDO::FETCH_COLUMN);
$countries = $dbh->query("SELECT DISTINCT country FROM footer_enquiries WHERE country IS NOT NULL AND country != ''")->fetchAll(PDO::FETCH_COLUMN);

include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Enquiries</h1>
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
            <div class="card-header">
                <h3 class="card-title">Filter Enquiries</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="index.php" class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Search by name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Type</label>
                            <select name="service_type" class="form-control">
                                <option value="">All Services</option>
                                <?php foreach ($service_types as $st): ?>
                                    <option value="<?= htmlspecialchars($st) ?>" <?= (isset($_GET['service_type']) && $_GET['service_type'] == $st) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($st) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" class="form-control">
                                <option value="">All Countries</option>
                                <?php foreach ($countries as $c): ?>
                                    <option value="<?= htmlspecialchars($c) ?>" <?= (isset($_GET['country']) && $_GET['country'] == $c) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group mt-auto w-100">
                            <button type="submit" class="btn btn-info mr-2">Apply</button>
                            <a href="index.php" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enquiry List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Enquiries List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px" class="text-center">ID</th>
                            <th>Client Details</th>
                            <th>Requirement</th>
                            <th style="width: 120px">Date</th>
                            <th style="width: 100px" class="text-center">Attach</th>
                            <th style="width: 80px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enquiries)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No enquiries found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($enquiries as $e): ?>
                                <tr>
                                    <td class="text-center text-muted small"><?= $e['id'] ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#modal-view-<?= $e['id'] ?>">
                                                <?= htmlspecialchars($e['name']) ?>
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($e['email']) ?>
                                                <?php if ($e['mobile']): ?>
                                                    <span class="mx-1">|</span> <i class="fas fa-phone mr-1"></i> <?= htmlspecialchars($e['mobile']) ?>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="badge badge-info shadow-sm py-1 mb-1" style="width: fit-content;"><?= htmlspecialchars($e['service_type']) ?></span>
                                            <small class="text-uppercase font-weight-bold" style="font-size: 0.65rem; color: <?= $e['service_mode'] == 'Online' ? '#007bff' : '#fd7e14' ?>;">
                                                <i class="fas <?= $e['service_mode'] == 'Online' ? 'fa-globe' : 'fa-building' ?> mr-1"></i> <?= htmlspecialchars($e['service_mode']) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="font-weight-bold d-block"><?= date('d M Y', strtotime($e['created_at'])) ?></small>
                                        <small class="text-muted"><?= date('H:i', strtotime($e['created_at'])) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($e['attachment']): ?>
                                            <a href="<?= BASE_URL ?>/<?= htmlspecialchars($e['attachment']) ?>" target="_blank" class="btn btn-xs btn-outline-info rounded-pill px-2" title="View Attachment">
                                                <i class="fas fa-paperclip"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?delete=<?= $e['id'] ?>" 
                                           class="btn btn-xs btn-outline-danger rounded-circle" 
                                           onclick="return confirm('Permanently delete this enquiry?')"
                                           title="Delete Enquiry">
                                           <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- View Modal maintained for detailed view -->
                                <div class="modal fade shadow" id="modal-view-<?= $e['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open-text mr-2"></i> Enquiry Detail #<?= $e['id'] ?></h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row mb-4 bg-light p-3 rounded mx-0">
                                                    <div class="col-md-6 border-right">
                                                        <label class="text-muted text-uppercase small font-weight-bold mb-1 d-block">Client Information</label>
                                                        <p class="mb-1"><strong><i class="fas fa-user-circle mr-1"></i> Name:</strong> <?= htmlspecialchars($e['name']) ?></p>
                                                        <p class="mb-1"><strong><i class="fas fa-envelope mr-1"></i> Email:</strong> <a href="mailto:<?= htmlspecialchars($e['email']) ?>"><?= htmlspecialchars($e['email']) ?></a></p>
                                                        <p class="mb-1"><strong><i class="fas fa-phone-alt mr-1"></i> Mobile:</strong> <?= htmlspecialchars($e['mobile']) ?></p>
                                                        <p class="mb-0"><strong><i class="fas fa-map-marker-alt mr-1"></i> Country:</strong> <?= htmlspecialchars($e['country']) ?></p>
                                                    </div>
                                                    <div class="col-md-6 pl-md-4">
                                                        <label class="text-muted text-uppercase small font-weight-bold mb-1 d-block">Service Requested</label>
                                                        <p class="mb-1"><strong><i class="fas fa-th-large mr-1"></i> Category:</strong> <?= htmlspecialchars($e['service_type']) ?></p>
                                                        <p class="mb-1"><strong><i class="fas fa-concierge-bell mr-1"></i> Mode:</strong> <span class="badge <?= $e['service_mode'] == 'Online' ? 'badge-primary' : 'badge-warning' ?>"><?= htmlspecialchars($e['service_mode']) ?></span></p>
                                                        <p class="mb-0"><strong><i class="fas fa-clock mr-1"></i> Received:</strong> <?= date('d M Y, H:i A', strtotime($e['created_at'])) ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block">Client Message</label>
                                                    <div class="p-3 border rounded font-italic text-secondary" style="background-color: #fafafa; line-height: 1.6;">
                                                        "<?= nl2br(htmlspecialchars($e['message'] ?: 'No message provided.')) ?>"
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal">Close</button>
                                                <?php if ($e['attachment']): ?>
                                                    <a href="<?= BASE_URL ?>/<?= htmlspecialchars($e['attachment']) ?>" target="_blank" class="btn btn-info btn-sm px-3 shadow-sm">
                                                        <i class="fas fa-download mr-1"></i> Download Attachment
                                                    </a>
                                                <?php endif; ?>
                                                <a href="mailto:<?= htmlspecialchars($e['email']) ?>?subject=Re: Vastu Enquiry" class="btn btn-success btn-sm px-3 shadow-sm">
                                                    <i class="fas fa-reply mr-1"></i> Reply via Email
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
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&service_type=<?= urlencode($_GET['service_type'] ?? '') ?>&country=<?= urlencode($_GET['country'] ?? '') ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&service_type=<?= urlencode($_GET['service_type'] ?? '') ?>&country=<?= urlencode($_GET['country'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&service_type=<?= urlencode($_GET['service_type'] ?? '') ?>&country=<?= urlencode($_GET['country'] ?? '') ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
