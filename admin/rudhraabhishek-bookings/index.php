<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("DELETE FROM rudhraabhishek_bookings WHERE id = ?");
        if ($stmt->execute([$id])) {
            $successMsg = "Booking deleted successfully.";
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting booking: " . $e->getMessage();
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
if (!empty($_GET['package_name'])) {
    $whereClauses[] = "package_name = ?";
    $params[] = $_GET['package_name'];
}
if (!empty($_GET['payment_status'])) {
    $whereClauses[] = "payment_status = ?";
    $params[] = $_GET['payment_status'];
}
if (!empty($_GET['booking_status'])) {
    $whereClauses[] = "booking_status = ?";
    $params[] = $_GET['booking_status'];
}
if (!empty($_GET['date_from'])) {
    $whereClauses[] = "puja_date >= ?";
    $params[] = $_GET['date_from'];
}
if (!empty($_GET['date_to'])) {
    $whereClauses[] = "puja_date <= ?";
    $params[] = $_GET['date_to'];
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

try {
    $sql = "SELECT * FROM rudhraabhishek_bookings 
            $whereSql 
            ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $bookings = $stmt->fetchAll();

    $stmtTotal = $dbh->prepare("SELECT COUNT(*) FROM rudhraabhishek_bookings $whereSql");
    $stmtTotal->execute($params);
    $totalBookings = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalBookings / $limit);
} catch (PDOException $e) {
    $bookings = [];
    $errorMsg = "Error fetching bookings: " . $e->getMessage();
}

$packages = $dbh->query("SELECT DISTINCT package_name FROM rudhraabhishek_bookings WHERE package_name IS NOT NULL AND package_name != ''")->fetchAll(PDO::FETCH_COLUMN);
$paymentStatuses = $dbh->query("SELECT DISTINCT payment_status FROM rudhraabhishek_bookings")->fetchAll(PDO::FETCH_COLUMN);
$bookingStatuses = $dbh->query("SELECT DISTINCT booking_status FROM rudhraabhishek_bookings")->fetchAll(PDO::FETCH_COLUMN);

include __DIR__ . '/../header.php';
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Rudra Abhishek Bookings</h1>
            </div>
        </div>
    </div>
</section>

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
                <h3 class="card-title">Filter Bookings</h3>
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
                            <label>Package</label>
                            <select name="package_name" class="form-control">
                                <option value="">All Packages</option>
                                <?php foreach ($packages as $p): ?>
                                    <option value="<?= htmlspecialchars($p) ?>" <?= (isset($_GET['package_name']) && $_GET['package_name'] == $p) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($p) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Payment</label>
                            <select name="payment_status" class="form-control">
                                <option value="">All</option>
                                <?php foreach ($paymentStatuses as $s): ?>
                                    <option value="<?= htmlspecialchars($s) ?>" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == $s) ? 'selected' : '' ?>>
                                        <?= ucfirst(htmlspecialchars($s)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Booking Status</label>
                            <select name="booking_status" class="form-control">
                                <option value="">All</option>
                                <?php foreach ($bookingStatuses as $s): ?>
                                    <option value="<?= htmlspecialchars($s) ?>" <?= (isset($_GET['booking_status']) && $_GET['booking_status'] == $s) ? 'selected' : '' ?>>
                                        <?= ucfirst(htmlspecialchars($s)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Puja Date From</label>
                            <input type="date" name="date_from" class="form-control" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Puja Date To</label>
                            <input type="date" name="date_to" class="form-control" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-group mt-auto w-100">
                            <button type="submit" class="btn btn-info mr-2">Apply</button>
                            <a href="index.php" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bookings List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bookings List</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">Total: <?= $totalBookings ?></span>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 40px" class="text-center">ID</th>
                            <th>Client Details</th>
                            <th>Package</th>
                            <th>Puja Date</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Status</th>
                            <th style="width: 80px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($bookings)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No bookings found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($bookings as $b): ?>
                                <?php
                                    $payBadge = match($b['payment_status']) {
                                        'paid' => 'badge-success',
                                        'failed' => 'badge-danger',
                                        default => 'badge-warning'
                                    };
                                    $bookBadge = match($b['booking_status']) {
                                        'confirmed' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        default => 'badge-secondary'
                                    };
                                ?>
                                <tr>
                                    <td class="text-center text-muted small"><?= $b['id'] ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#modal-view-<?= $b['id'] ?>">
                                                <?= htmlspecialchars($b['name']) ?>
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($b['email']) ?>
                                                <?php if ($b['mobile']): ?>
                                                    <span class="mx-1">|</span> <i class="fas fa-phone mr-1"></i> <?= htmlspecialchars($b['mobile']) ?>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold"><?= htmlspecialchars($b['package_name']) ?></span>
                                        <small class="d-block text-muted">₹<?= number_format($b['package_price']) ?></small>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold d-block"><?= date('d M Y', strtotime($b['puja_date'])) ?></span>
                                        <?php if ($b['is_monday']): ?>
                                            <small class="badge badge-warning">🌙 Monday</small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $payBadge ?>"><?= ucfirst($b['payment_status']) ?></span>
                                        <?php if ($b['amount_paid'] > 0): ?>
                                            <small class="d-block text-muted">₹<?= number_format($b['amount_paid']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $bookBadge ?>"><?= ucfirst($b['booking_status']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="?delete=<?= $b['id'] ?>" 
                                           class="btn btn-xs btn-outline-danger rounded-circle" 
                                           onclick="return confirm('Permanently delete this booking?')"
                                           title="Delete Booking">
                                           <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade shadow" id="modal-view-<?= $b['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title font-weight-bold"><i class="fas fa-receipt mr-2"></i> Booking #<?= $b['id'] ?></h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block">Client Information</label>
                                                            <p class="mb-1"><strong><i class="fas fa-user-circle mr-1"></i> Name:</strong> <?= htmlspecialchars($b['name']) ?></p>
                                                            <?php if ($b['dob']): ?>
                                                                <p class="mb-1"><strong><i class="fas fa-calendar-alt mr-1"></i> DOB:</strong> <?= date('d M Y', strtotime($b['dob'])) ?></p>
                                                            <?php endif; ?>
                                                            <?php if ($b['gotra']): ?>
                                                                <p class="mb-1"><strong><i class="fas fa-pray mr-1"></i> Gotra:</strong> <?= htmlspecialchars($b['gotra']) ?></p>
                                                            <?php endif; ?>
                                                            <p class="mb-1"><strong><i class="fas fa-envelope mr-1"></i> Email:</strong> <a href="mailto:<?= htmlspecialchars($b['email']) ?>"><?= htmlspecialchars($b['email']) ?></a></p>
                                                            <p class="mb-0"><strong><i class="fas fa-phone-alt mr-1"></i> Mobile:</strong> <?= htmlspecialchars($b['mobile']) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block">Booking Details</label>
                                                            <p class="mb-1"><strong><i class="fas fa-gift mr-1"></i> Package:</strong> <?= htmlspecialchars($b['package_name']) ?></p>
                                                            <p class="mb-1"><strong><i class="fas fa-rupee-sign mr-1"></i> Amount:</strong> ₹<?= number_format($b['package_price']) ?></p>
                                                            <p class="mb-1"><strong><i class="fas fa-calendar-check mr-1"></i> Puja Date:</strong> <?= date('d M Y', strtotime($b['puja_date'])) ?> <?= $b['is_monday'] ? '<span class="badge badge-warning">🌙 Monday</span>' : '' ?></p>
                                                            <p class="mb-1">
                                                                <strong><i class="fas fa-credit-card mr-1"></i> Payment:</strong> 
                                                                <span class="badge <?= $payBadge ?>"><?= ucfirst($b['payment_status']) ?></span>
                                                                <?php if ($b['amount_paid'] > 0): ?> ₹<?= number_format($b['amount_paid']) ?><?php endif; ?>
                                                            </p>
                                                            <p class="mb-0">
                                                                <strong><i class="fas fa-check-circle mr-1"></i> Booking:</strong> 
                                                                <span class="badge <?= $bookBadge ?>"><?= ucfirst($b['booking_status']) ?></span>
                                                            </p>
                                                            <p class="mb-0 mt-1"><strong><i class="fas fa-clock mr-1"></i> Booked:</strong> <?= date('d M Y, H:i A', strtotime($b['created_at'])) ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($b['address'] || $b['state'] || $b['city'] || $b['pincode']): ?>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <div class="p-3 border rounded">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block"><i class="fas fa-map-marker-alt mr-1"></i> Address</label>
                                                            <p class="mb-1">
                                                                <?= htmlspecialchars($b['address']) ?><br>
                                                                <?= htmlspecialchars($b['city']) ?><?= ($b['city'] && $b['state']) ? ', ' : '' ?><?= htmlspecialchars($b['state']) ?> <?= htmlspecialchars($b['pincode']) ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if ($b['razorpay_order_id']): ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block"><i class="fas fa-fingerprint mr-1"></i> Payment Reference</label>
                                                            <p class="mb-1 small"><strong>Order ID:</strong> <?= htmlspecialchars($b['razorpay_order_id']) ?></p>
                                                            <?php if ($b['razorpay_payment_id']): ?>
                                                                <p class="mb-0 small"><strong>Payment ID:</strong> <?= htmlspecialchars($b['razorpay_payment_id']) ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal">Close</button>
                                                <a href="mailto:<?= htmlspecialchars($b['email']) ?>?subject=Re: Rudra Abhishek Booking #<?= $b['id'] ?>" class="btn btn-success btn-sm px-3 shadow-sm">
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
            
            <?php if ($totalPages > 1): ?>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&package_name=<?= urlencode($_GET['package_name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&booking_status=<?= urlencode($_GET['booking_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&package_name=<?= urlencode($_GET['package_name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&booking_status=<?= urlencode($_GET['booking_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&package_name=<?= urlencode($_GET['package_name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&booking_status=<?= urlencode($_GET['booking_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
