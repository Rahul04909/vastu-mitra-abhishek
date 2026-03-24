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
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Service</th>
                            <th>Mode</th>
                            <th>Attachment</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enquiries)): ?>
                            <tr>
                                <td colspan="9" class="text-center">No enquiries found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($enquiries as $e): ?>
                                <tr>
                                    <td><?= $e['id'] ?></td>
                                    <td><?= date('d M Y, H:i', strtotime($e['created_at'])) ?></td>
                                    <td><strong><?= htmlspecialchars($e['name']) ?></strong></td>
                                    <td><?= htmlspecialchars($e['email']) ?></td>
                                    <td><?= htmlspecialchars($e['mobile']) ?></td>
                                    <td><span class="badge badge-info"><?= htmlspecialchars($e['service_type']) ?></span></td>
                                    <td>
                                        <span class="badge <?= $e['service_mode'] == 'Online' ? 'badge-primary' : 'badge-warning' ?>">
                                            <?= htmlspecialchars($e['service_mode']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($e['attachment']): ?>
                                            <a href="<?= BASE_URL ?>/<?= htmlspecialchars($e['attachment']) ?>" target="_blank" class="btn btn-xs btn-outline-info">
                                                <i class="fas fa-paperclip"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">None</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex" style="gap: 5px;">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-view-<?= $e['id'] ?>">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <a href="index.php?delete=<?= $e['id'] ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Delete this enquiry?')">
                                               <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- View Modal -->
                                        <div class="modal fade" id="modal-view-<?= $e['id'] ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Enquiry Details #<?= $e['id'] ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Name:</strong> <?= htmlspecialchars($e['name']) ?></p>
                                                                <p><strong>Email:</strong> <?= htmlspecialchars($e['email']) ?></p>
                                                                <p><strong>Mobile:</strong> <?= htmlspecialchars($e['mobile']) ?></p>
                                                                <p><strong>Country:</strong> <?= htmlspecialchars($e['country']) ?></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><strong>Service Type:</strong> <?= htmlspecialchars($e['service_type']) ?></p>
                                                                <p><strong>Service Mode:</strong> <?= htmlspecialchars($e['service_mode']) ?></p>
                                                                <p><strong>Received At:</strong> <?= date('d M Y, H:i', strtotime($e['created_at'])) ?></p>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <h6><strong>Message:</strong></h6>
                                                                <div class="p-3 bg-light border rounded">
                                                                    <?= nl2br(htmlspecialchars($e['message'])) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <?php if ($e['attachment']): ?>
                                                            <a href="<?= BASE_URL ?>/<?= htmlspecialchars($e['attachment']) ?>" target="_blank" class="btn btn-primary">
                                                                Download Attachment
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
