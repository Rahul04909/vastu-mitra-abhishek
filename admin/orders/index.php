<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Order Status Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_order_status') {
    $order_id = (int)($_POST['order_id'] ?? 0);
    $new_status = $_POST['order_status'] ?? '';
    $admin_notes = trim($_POST['admin_notes'] ?? '');

    $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
    if ($order_id > 0 && in_array($new_status, $allowedStatuses)) {
        try {
            if (!empty($admin_notes)) {
                $stmt = $dbh->prepare("UPDATE shop_orders SET order_status = ?, notes = CONCAT(COALESCE(notes, ''), '\n[Admin Update: ', ?, ']') WHERE id = ?");
                $stmt->execute([$new_status, $admin_notes, $order_id]);
            } else {
                $stmt = $dbh->prepare("UPDATE shop_orders SET order_status = ? WHERE id = ?");
                $stmt->execute([$new_status, $order_id]);
            }
            $successMsg = "Order #" . $order_id . " status updated to " . ucfirst($new_status) . ".";
        } catch (PDOException $e) {
            $errorMsg = "Error updating order: " . $e->getMessage();
        }
    }
}

// Handle Order Deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("DELETE FROM shop_orders WHERE id = ?");
        if ($stmt->execute([$id])) {
            $successMsg = "Order deleted successfully.";
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting order: " . $e->getMessage();
    }
}

// Statistics
try {
    $totalOrdersCount = (int)$dbh->query("SELECT COUNT(*) FROM shop_orders")->fetchColumn();
    $totalRevenue     = (float)$dbh->query("SELECT SUM(total_amount) FROM shop_orders WHERE payment_status = 'paid'")->fetchColumn();
    $paidOrdersCount  = (int)$dbh->query("SELECT COUNT(*) FROM shop_orders WHERE payment_status = 'paid'")->fetchColumn();
    $pendingOrdersCount = (int)$dbh->query("SELECT COUNT(*) FROM shop_orders WHERE order_status IN ('pending', 'processing')")->fetchColumn();
} catch (Exception $e) {
    $totalOrdersCount = 0;
    $totalRevenue = 0.00;
    $paidOrdersCount = 0;
    $pendingOrdersCount = 0;
}

// Pagination & Filtering
$limit = 12;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$whereClauses = [];
$params = [];

if (!empty($_GET['search'])) {
    $s = "%" . trim($_GET['search']) . "%";
    $whereClauses[] = "(order_number LIKE ? OR customer_name LIKE ? OR mobile LIKE ? OR email LIKE ?)";
    $params[] = $s;
    $params[] = $s;
    $params[] = $s;
    $params[] = $s;
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
    $params[] = $_GET['date_from'] . ' 00:00:00';
}

if (!empty($_GET['date_to'])) {
    $whereClauses[] = "created_at <= ?";
    $params[] = $_GET['date_to'] . ' 23:59:59';
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

try {
    $stmtCount = $dbh->prepare("SELECT COUNT(*) FROM shop_orders $whereSql");
    $stmtCount->execute($params);
    $totalOrders = (int)$stmtCount->fetchColumn();
    $totalPages = max(1, ceil($totalOrders / $limit));

    $sql = "SELECT * FROM shop_orders $whereSql ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch items for current page orders
    $orderIds = array_column($orders, 'id');
    $orderItemsMap = [];
    if (!empty($orderIds)) {
        $inClause = implode(',', array_fill(0, count($orderIds), '?'));
        $stmtItems = $dbh->prepare("SELECT * FROM shop_order_items WHERE order_id IN ($inClause)");
        $stmtItems->execute($orderIds);
        while ($row = $stmtItems->fetch(PDO::FETCH_ASSOC)) {
            $orderItemsMap[$row['order_id']][] = $row;
        }
    }
} catch (PDOException $e) {
    $orders = [];
    $totalOrders = 0;
    $totalPages = 1;
    $errorMsg = "Error fetching orders: " . $e->getMessage();
}

$page_title = "Manage Shop Orders";
include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-shopping-cart mr-2"></i> Shop Orders Management</h1>
            </div>
            <div class="col-sm-6 text-sm-right">
                <a href="<?= BASE_URL ?>/shop.php" target="_blank" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-external-link-alt mr-1"></i> Visit Shop
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php if ($successMsg): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-1"></i> <?= htmlspecialchars($successMsg) ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle mr-1"></i> <?= htmlspecialchars($errorMsg) ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= number_format($totalOrdersCount) ?></h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>₹<?= number_format($totalRevenue, 2) ?></h3>
                        <p>Paid Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= number_format($paidOrdersCount) ?></h3>
                        <p>Paid Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= number_format($pendingOrdersCount) ?></h3>
                        <p>Pending Processing</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Box -->
        <div class="card card-default card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Search &amp; Filter Orders</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="index.php" class="row">
                    <div class="col-md-3 mb-2">
                        <label class="small font-weight-bold">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Order #, Name, Mobile, Email" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold">Payment Status</label>
                        <select name="payment_status" class="form-control form-control-sm">
                            <option value="">All Payments</option>
                            <option value="paid" <?= (($_GET['payment_status'] ?? '') === 'paid') ? 'selected' : '' ?>>Paid</option>
                            <option value="pending" <?= (($_GET['payment_status'] ?? '') === 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="failed" <?= (($_GET['payment_status'] ?? '') === 'failed') ? 'selected' : '' ?>>Failed</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold">Order Status</label>
                        <select name="order_status" class="form-control form-control-sm">
                            <option value="">All Statuses</option>
                            <option value="pending" <?= (($_GET['order_status'] ?? '') === 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="processing" <?= (($_GET['order_status'] ?? '') === 'processing') ? 'selected' : '' ?>>Processing</option>
                            <option value="shipped" <?= (($_GET['order_status'] ?? '') === 'shipped') ? 'selected' : '' ?>>Shipped</option>
                            <option value="delivered" <?= (($_GET['order_status'] ?? '') === 'delivered') ? 'selected' : '' ?>>Delivered</option>
                            <option value="cancelled" <?= (($_GET['order_status'] ?? '') === 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold">From Date</label>
                        <input type="date" name="date_from" class="form-control form-control-sm" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold">To Date</label>
                        <input type="date" name="date_to" class="form-control form-control-sm" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
                    </div>
                    <div class="col-md-1 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-info btn-sm btn-block mr-1">Filter</button>
                        <a href="index.php" class="btn btn-secondary btn-sm" title="Reset Filters"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-list mr-1"></i> Orders List (<?= $totalOrders ?> total)
                </h3>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px;" class="text-center">#</th>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th class="text-right">Amount</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Order Status</th>
                            <th>Date</th>
                            <th style="width: 130px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 text-secondary d-block"></i>
                                    No shop orders found matching your query.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $o): ?>
                                <?php
                                    $payBadge = match($o['payment_status']) {
                                        'paid' => 'badge-success',
                                        'failed' => 'badge-danger',
                                        'refunded' => 'badge-dark',
                                        default => 'badge-warning'
                                    };

                                    $ordBadge = match($o['order_status']) {
                                        'delivered' => 'badge-success',
                                        'shipped' => 'badge-info',
                                        'processing' => 'badge-primary',
                                        'cancelled' => 'badge-danger',
                                        default => 'badge-secondary'
                                    };

                                    $itemsForOrder = $orderItemsMap[$o['id']] ?? [];
                                ?>
                                <tr>
                                    <td class="text-center text-muted small"><?= $o['id'] ?></td>
                                    <td>
                                        <strong>
                                            <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#orderModal-<?= $o['id'] ?>">
                                                <?= htmlspecialchars($o['order_number']) ?>
                                            </a>
                                        </strong>
                                        <small class="d-block text-muted"><?= count($itemsForOrder) ?> <?= count($itemsForOrder) === 1 ? 'item' : 'items' ?></small>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($o['customer_name']) ?></strong>
                                        <small class="d-block text-muted"><?= htmlspecialchars($o['city']) ?>, <?= htmlspecialchars($o['state']) ?></small>
                                    </td>
                                    <td>
                                        <div><i class="fas fa-phone mr-1 text-muted small"></i> <?= htmlspecialchars($o['mobile']) ?></div>
                                        <div><i class="fas fa-envelope mr-1 text-muted small"></i> <?= htmlspecialchars($o['email']) ?></div>
                                    </td>
                                    <td class="text-right">
                                        <strong class="text-dark">₹<?= number_format((float)$o['total_amount'], 2) ?></strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $payBadge ?> px-2 py-1"><?= ucfirst($o['payment_status']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $ordBadge ?> px-2 py-1"><?= ucfirst($o['order_status']) ?></span>
                                    </td>
                                    <td>
                                        <span class="small"><?= date('d M Y, h:i A', strtotime($o['created_at'])) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#orderModal-<?= $o['id'] ?>" title="View & Manage Order">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="index.php?delete=<?= $o['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Permanently delete Order #<?= $o['order_number'] ?>?')" title="Delete Order">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- View & Manage Order Modal -->
                                <div class="modal fade" id="orderModal-<?= $o['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title font-weight-bold">
                                                    <i class="fas fa-receipt mr-2"></i> Order #<?= htmlspecialchars($o['order_number']) ?>
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <!-- Top Summary Row -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <h6 class="font-weight-bold text-uppercase small text-muted mb-2">Customer &amp; Shipping Details</h6>
                                                            <p class="mb-1"><strong>Name:</strong> <?= htmlspecialchars($o['customer_name']) ?></p>
                                                            <p class="mb-1"><strong>Phone:</strong> <a href="tel:<?= htmlspecialchars($o['mobile']) ?>"><?= htmlspecialchars($o['mobile']) ?></a></p>
                                                            <p class="mb-1"><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($o['email']) ?>"><?= htmlspecialchars($o['email']) ?></a></p>
                                                            <p class="mb-1"><strong>Address:</strong><br><?= nl2br(htmlspecialchars($o['address'])) ?></p>
                                                            <p class="mb-0"><?= htmlspecialchars($o['city']) ?>, <?= htmlspecialchars($o['state']) ?> - <?= htmlspecialchars($o['pincode']) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded h-100">
                                                            <h6 class="font-weight-bold text-uppercase small text-muted mb-2">Payment &amp; Gateway Info</h6>
                                                            <p class="mb-1"><strong>Order Date:</strong> <?= date('d M Y, h:i A', strtotime($o['created_at'])) ?></p>
                                                            <p class="mb-1">
                                                                <strong>Payment Status:</strong> 
                                                                <span class="badge <?= $payBadge ?>"><?= ucfirst($o['payment_status']) ?></span>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Order Status:</strong> 
                                                                <span class="badge <?= $ordBadge ?>"><?= ucfirst($o['order_status']) ?></span>
                                                            </p>
                                                            <p class="mb-1 small"><strong>Razorpay Order ID:</strong> <?= htmlspecialchars($o['razorpay_order_id'] ?: 'N/A') ?></p>
                                                            <p class="mb-1 small"><strong>Razorpay Payment ID:</strong> <?= htmlspecialchars($o['razorpay_payment_id'] ?: 'N/A') ?></p>
                                                            <?php if (!empty($o['notes'])): ?>
                                                                <p class="mb-0 small mt-2"><strong>Notes:</strong><br><?= nl2br(htmlspecialchars($o['notes'])) ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Ordered Items Table -->
                                                <h6 class="font-weight-bold text-uppercase small text-muted mb-2">Items Purchased</h6>
                                                <div class="table-responsive mb-3">
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Item</th>
                                                                <th class="text-right">Price</th>
                                                                <th class="text-center">Qty</th>
                                                                <th class="text-right">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($itemsForOrder as $itm): ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="<?= !empty($itm['product_image']) ? BASE_URL . '/admin/uploads/products/' . htmlspecialchars($itm['product_image']) : BASE_URL . '/assets/logo/logo.png' ?>" 
                                                                                 class="img-thumbnail mr-2" style="width: 42px; height: 42px; object-fit: cover;"
                                                                                 onerror="this.src='<?= BASE_URL ?>/assets/logo/logo.png'">
                                                                            <span><?= htmlspecialchars($itm['product_name']) ?></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-right">₹<?= number_format((float)$itm['price'], 2) ?></td>
                                                                    <td class="text-center"><?= (int)$itm['quantity'] ?></td>
                                                                    <td class="text-right font-weight-bold">₹<?= number_format((float)$itm['total'], 2) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr class="bg-light">
                                                                <td colspan="3" class="text-right font-weight-bold">Subtotal:</td>
                                                                <td class="text-right font-weight-bold">₹<?= number_format((float)$o['subtotal'], 2) ?></td>
                                                            </tr>
                                                            <tr class="bg-light">
                                                                <td colspan="3" class="text-right font-weight-bold">Delivery Fee:</td>
                                                                <td class="text-right text-success font-weight-bold">FREE</td>
                                                            </tr>
                                                            <tr class="bg-light text-primary font-weight-bold" style="font-size: 1.1rem;">
                                                                <td colspan="3" class="text-right">Grand Total:</td>
                                                                <td class="text-right">₹<?= number_format((float)$o['total_amount'], 2) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- Status Update Form -->
                                                <div class="card card-outline card-secondary mb-0">
                                                    <div class="card-header py-2">
                                                        <h6 class="card-title font-weight-bold mb-0">Update Order Status</h6>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <form method="POST" action="index.php">
                                                            <input type="hidden" name="action" value="update_order_status">
                                                            <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label class="small font-weight-bold">Status</label>
                                                                        <select name="order_status" class="form-control form-control-sm">
                                                                            <option value="pending" <?= $o['order_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                                            <option value="processing" <?= $o['order_status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                                                            <option value="shipped" <?= $o['order_status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                                                            <option value="delivered" <?= $o['order_status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                                                            <option value="cancelled" <?= $o['order_status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                        <label class="small font-weight-bold">Tracking / Admin Note</label>
                                                                        <input type="text" name="admin_notes" class="form-control form-control-sm" placeholder="e.g. Dispatched via Bluedart tracking #12345678">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 d-flex align-items-end">
                                                                    <button type="submit" class="btn btn-primary btn-sm btn-block mb-2">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <a href="<?= BASE_URL ?>/order-success.php?order_id=<?= $o['id'] ?>&token=<?= md5($o['order_number'] . RAZORPAY_KEY_SECRET) ?>" target="_blank" class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-print mr-1"></i> Print Invoice
                                                </a>
                                                <a href="https://wa.me/<?= preg_replace('/\D/', '', $o['mobile']) ?>?text=<?= urlencode('Namaste ' . $o['customer_name'] . ', this is regarding your Vastu Mitra Abhishek order #' . $o['order_number'] . '.') ?>" target="_blank" class="btn btn-success btn-sm">
                                                    <i class="fab fa-whatsapp mr-1"></i> WhatsApp Customer
                                                </a>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
                            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($_GET['search'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($_GET['search'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($_GET['search'] ?? '') ?>&payment_status=<?= urlencode($_GET['payment_status'] ?? '') ?>&order_status=<?= urlencode($_GET['order_status'] ?? '') ?>&date_from=<?= urlencode($_GET['date_from'] ?? '') ?>&date_to=<?= urlencode($_GET['date_to'] ?? '') ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
