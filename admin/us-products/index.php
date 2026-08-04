<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Ensure table exists
try {
    $dbh->exec("CREATE TABLE IF NOT EXISTS `us_product` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_name` varchar(255) NOT NULL DEFAULT 'Maha Mrityunjaya Yantra',
        `amount` decimal(10,2) NOT NULL DEFAULT 5100.00,
        `customer_name` varchar(255) NOT NULL,
        `mobile` varchar(20) NOT NULL,
        `email` varchar(255) NOT NULL,
        `gotra` varchar(255) DEFAULT NULL,
        `sankalp` text DEFAULT NULL,
        `address` text DEFAULT NULL,
        `city` varchar(100) DEFAULT NULL,
        `state` varchar(100) DEFAULT NULL,
        `pincode` varchar(10) DEFAULT NULL,
        `razorpay_order_id` varchar(255) DEFAULT NULL,
        `razorpay_payment_id` varchar(255) DEFAULT NULL,
        `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
        `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
        `order_status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `razorpay_order_id` (`razorpay_order_id`),
        KEY `payment_status` (`payment_status`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
} catch (PDOException $e) {
    // Table creation error handled gracefully if exists
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("DELETE FROM us_product WHERE id = ?");
        if ($stmt->execute([$id])) {
            $successMsg = "Order deleted successfully.";
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting order: " . $e->getMessage();
    }
}

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$whereClauses = [];
$params = [];

if (!empty($_GET['name'])) {
    $whereClauses[] = "customer_name LIKE ?";
    $params[] = "%" . $_GET['name'] . "%";
}
if (!empty($_GET['payment_status'])) {
    $whereClauses[] = "payment_status = ?";
    $params[] = $_GET['payment_status'];
}
if (!empty($_GET['order_status'])) {
    $whereClauses[] = "order_status = ?";
    $params[] = $_GET['order_status'];
}
if (!empty($_GET['date_from'])) {
    $whereClauses[] = "created_at >= ?";
    $params[] = $_GET['date_from'];
}
if (!empty($_GET['date_to'])) {
    $whereClauses[] = "created_at <= ?";
    $params[] = $_GET['date_to'];
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

try {
    $sql = "SELECT * FROM us_product 
            $whereSql 
            ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll();

    $stmtTotal = $dbh->prepare("SELECT COUNT(*) FROM us_product $whereSql");
    $stmtTotal->execute($params);
    $totalOrders = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalOrders / $limit);
} catch (PDOException $e) {
    $orders = [];
    $errorMsg = "Error fetching orders: " . $e->getMessage();
}

$paymentStatuses = ['pending', 'paid', 'failed'];
$orderStatuses = ['pending', 'confirmed', 'cancelled'];

include __DIR__ . '/../header.php';
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>US Product Orders (Maha Mrityunjaya Yantra)</h1>
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
                <h3 class="card-title">Filter Orders</h3>
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
                            <label>Order Status</label>
                            <select name="order_status" class="form-control">
                                <option value="">All</option>
                                <?php foreach ($orderStatuses as $s): ?>
                                    <option value="<?= htmlspecialchars($s) ?>" <?= (isset($_GET['order_status']) && $_GET['order_status'] == $s) ? 'selected' : '' ?>>
                                        <?= ucfirst(htmlspecialchars($s)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date From</label>
                            <input type="date" name="date_from" class="form-control" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date To</label>
                            <input type="date" name="date_to" class="form-control" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-9 d-flex align-items-end">
                        <div class="form-group mt-auto w-100">
                            <button type="submit" class="btn btn-info mr-2">Apply Filters</button>
                            <a href="index.php" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders List</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">Total: <?= $totalOrders ?></span>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 40px" class="text-center">ID</th>
                            <th>Client Details</th>
                            <th>Product Name</th>
                            <th class="text-right">Amount</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Status</th>
                            <th>Date</th>
                            <th style="width: 80px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No orders found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $o): ?>
                                <?php
                                    $payBadge = match($o['payment_status']) {
                                        'paid' => 'badge-success',
                                        'failed' => 'badge-danger',
                                        default => 'badge-warning'
                                    };
                                    $ordBadge = match($o['order_status']) {
                                        'confirmed' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        default => 'badge-secondary'
                                    };
                                ?>
                                <tr>
                                    <td class="text-center text-muted small"><?= $o['id'] ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#modal-view-<?= $o['id'] ?>">
                                                <?= htmlspecialchars($o['customer_name']) ?>
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-phone mr-1"></i> <?= htmlspecialchars($o['mobile']) ?>
                                                <?php if ($o['email']): ?>
                                                    <span class="mx-1">|</span> <i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($o['email']) ?>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold"><?= htmlspecialchars($o['product_name']) ?></span>
                                    </td>
                                    <td class="text-right">
                                        <span class="font-weight-bold">₹<?= number_format($o['amount']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $payBadge ?>"><?= ucfirst($o['payment_status']) ?></span>
                                        <?php if ($o['amount_paid'] > 0): ?>
                                            <small class="d-block text-muted">₹<?= number_format($o['amount_paid']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $ordBadge ?>"><?= ucfirst($o['order_status']) ?></span>
                                    </td>
                                    <td>
                                        <span class="small"><?= date('d M Y', strtotime($o['created_at'])) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="?delete=<?= $o['id'] ?>" 
                                           class="btn btn-xs btn-outline-danger rounded-circle" 
                                           onclick="return confirm('Permanently delete this order?')"
                                           title="Delete Order">
                                           <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade shadow" id="modal-view-<?= $o['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title font-weight-bold"><i class="fas fa-receipt mr-2"></i> US Order #<?= $o['id'] ?></h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block">Client Information</label>
                                                            <p class="mb-1"><strong><i class="fas fa-user-circle mr-1"></i> Name:</strong> <?= htmlspecialchars($o['customer_name']) ?></p>
                                                            <?php if ($o['gotra']): ?>
                                                                <p class="mb-1"><strong><i class="fas fa-pray mr-1"></i> Gotra:</strong> <?= htmlspecialchars($o['gotra']) ?></p>
                                                            <?php endif; ?>
                                                            <p class="mb-1"><strong><i class="fas fa-envelope mr-1"></i> Email:</strong> <a href="mailto:<?= htmlspecialchars($o['email']) ?>"><?= htmlspecialchars($o['email']) ?></a></p>
                                                            <p class="mb-0"><strong><i class="fas fa-phone-alt mr-1"></i> Mobile:</strong> <?= htmlspecialchars($o['mobile']) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block">Order Details</label>
                                                            <p class="mb-1"><strong><i class="fas fa-cube mr-1"></i> Product:</strong> <?= htmlspecialchars($o['product_name']) ?></p>
                                                            <p class="mb-1"><strong><i class="fas fa-rupee-sign mr-1"></i> Amount:</strong> ₹<?= number_format($o['amount']) ?></p>
                                                            <?php if ($o['sankalp']): ?>
                                                                <p class="mb-1"><strong><i class="fas fa-hand-paper mr-1"></i> Sankalp:</strong> <?= htmlspecialchars($o['sankalp']) ?></p>
                                                            <?php endif; ?>
                                                            <p class="mb-1">
                                                                <strong><i class="fas fa-credit-card mr-1"></i> Payment:</strong> 
                                                                <span class="badge <?= $payBadge ?>"><?= ucfirst($o['payment_status']) ?></span>
                                                                <?php if ($o['amount_paid'] > 0): ?> ₹<?= number_format($o['amount_paid']) ?><?php endif; ?>
                                                            </p>
                                                            <p class="mb-0">
                                                                <strong><i class="fas fa-check-circle mr-1"></i> Status:</strong> 
                                                                <span class="badge <?= $ordBadge ?>"><?= ucfirst($o['order_status']) ?></span>
                                                            </p>
                                                            <p class="mb-0 mt-1"><strong><i class="fas fa-clock mr-1"></i> Ordered:</strong> <?= date('d M Y, H:i A', strtotime($o['created_at'])) ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($o['address'] || $o['city'] || $o['state'] || $o['pincode']): ?>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <div class="p-3 border rounded">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block"><i class="fas fa-map-marker-alt mr-1"></i> Shipping Address</label>
                                                            <p class="mb-1">
                                                                <?= htmlspecialchars($o['address']) ?><br>
                                                                <?= htmlspecialchars($o['city']) ?><?= ($o['city'] && $o['state']) ? ', ' : '' ?><?= htmlspecialchars($o['state']) ?> <?= htmlspecialchars($o['pincode']) ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if ($o['razorpay_order_id']): ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="text-muted text-uppercase small font-weight-bold mb-2 d-block"><i class="fas fa-fingerprint mr-1"></i> Payment Reference</label>
                                                            <p class="mb-1 small"><strong>Razorpay Order ID:</strong> <?= htmlspecialchars($o['razorpay_order_id']) ?></p>
                                                            <?php if ($o['razorpay_payment_id']): ?>
                                                                <p class="mb-0 small"><strong>Razorpay Payment ID:</strong> <?= htmlspecialchars($o['razorpay_payment_id']) ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal">Close</button>
                                                <a href="mailto:<?= htmlspecialchars($o['email']) ?>?subject=Re: Maha Mrityunjaya Yantra Order #<?= $o['id'] ?>" class="btn btn-success btn-sm px-3 shadow-sm">
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
                            <a class="page-link" href="?page=<?= $page - 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
