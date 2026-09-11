<?php
if (!function_exists('get_cart_count')) {
    require_once __DIR__ . '/cart_functions.php';
}
$cart_badge_count = get_cart_count();
?>
<header>
    <div class="container">
        <div class="logo">
            <a href="<?= BASE_URL ?>/index.php">
                <img src="<?= BASE_URL ?>/assets/logo/logo.png" alt="Vastu Mitra Abhishek Logo">
            </a>
        </div>
        
        <nav class="nav-menu">
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php" class="nav-link">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link">Services <i class="fas fa-chevron-down small"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= BASE_URL ?>/pages/commercial-vastu.php">Commercial Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/residential-vastu.php">Residential Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/industrial-vastu.php">Industrial Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/personal-vastu.php">Personal Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/vastu-logo-design.php">Vastu Logo Design</a></li>
                
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link">Yantra <i class="fas fa-chevron-down small"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= BASE_URL ?>/maha-mrityunjaya-yantra.php">Yantra (Hindi)</a></li>
                        <li><a href="<?= BASE_URL ?>/maha-mrityunjaya-yantra-en.php">Yantra (English)</a></li>
                    </ul>
                </li>
                <li><a href="<?= BASE_URL ?>/shop.php" class="nav-link">Shop</a></li>
                <li><a href="<?= BASE_URL ?>/blog.php" class="nav-link">Blog</a></li>
                <li><a href="<?= BASE_URL ?>/about.php" class="nav-link">About</a></li>
                <li><a href="<?= BASE_URL ?>/contact.php" class="nav-link">Contact us</a></li>
                <li><a href="<?= BASE_URL ?>/pages/rudhraabhishek.php" class="nav-link">Rudraabhishek</a></li>
            </ul>
        </nav>

        <div class="header-actions" style="display: flex; align-items: center; gap: 18px;">
            <a href="<?= BASE_URL ?>/cart.php" class="header-cart-link" title="View Cart" style="position: relative; color: var(--text-dark); font-size: 1.3rem; text-decoration: none; display: flex; align-items: center;">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" style="position: absolute; top: -8px; right: -10px; background: #28a745; color: #fff; font-size: 0.72rem; font-weight: 700; border-radius: 50%; width: 20px; height: 20px; display: <?= $cart_badge_count > 0 ? 'inline-flex' : 'none' ?>; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(40, 167, 69, 0.4);"><?= $cart_badge_count ?></span>
            </a>

            <button class="mobile-toggle" aria-label="Toggle Navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Sidebar for Mobile -->
<div class="overlay"></div>
<aside class="sidebar">
    <button class="sidebar-close">&times;</button>
    <div class="sidebar-logo">
        <img src="<?= BASE_URL ?>/assets/logo/logo.png" alt="Logo" style="height: 50px;">
    </div>
    <ul class="sidebar-menu">
        <li><a href="<?= BASE_URL ?>/index.php" class="sidebar-link">Home</a></li>
        <li>
            <a href="#" class="sidebar-link" onclick="toggleSubmenu(event, 'submenu-services')">Vastu Services <i class="fas fa-chevron-down float-right mt-1"></i></a>
            <ul id="submenu-services" class="list-unstyled pl-3" style="display: none;">
                <li><a href="<?= BASE_URL ?>/pages/commercial-vastu.php" class="sidebar-link border-0">Commercial Vastu</a></li>
                <li><a href="<?= BASE_URL ?>/pages/residential-vastu.php" class="sidebar-link border-0">Residential Vastu</a></li>
                <li><a href="<?= BASE_URL ?>/pages/industrial-vastu.php" class="sidebar-link border-0">Industrial Vastu</a></li>
                <li><a href="<?= BASE_URL ?>/pages/personal-vastu.php" class="sidebar-link border-0">Personal Vastu</a></li>
                <li><a href="<?= BASE_URL ?>/pages/vastu-logo-design.php" class="sidebar-link border-0">Vastu Logo Design</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sidebar-link" onclick="toggleSubmenu(event, 'submenu-yantras')">Yantras <i class="fas fa-chevron-down float-right mt-1"></i></a>
            <ul id="submenu-yantras" class="list-unstyled pl-3" style="display: none;">
                <li><a href="<?= BASE_URL ?>/maha-mrityunjaya-yantra.php" class="sidebar-link border-0">Yantra (Hindi)</a></li>
                <li><a href="<?= BASE_URL ?>/maha-mrityunjaya-yantra-en.php" class="sidebar-link border-0">Yantra (English)</a></li>
            </ul>
        </li>
        <li><a href="<?= BASE_URL ?>/shop.php" class="sidebar-link">Shop</a></li>
        <li>
            <a href="<?= BASE_URL ?>/cart.php" class="sidebar-link" style="display:flex; justify-content:space-between; align-items:center;">
                <span><i class="fas fa-shopping-bag mr-2"></i> Cart</span>
                <span class="badge cart-badge" style="background:#28a745; color:#fff; border-radius:12px; padding:2px 8px; font-size:0.75rem; display:<?= $cart_badge_count > 0 ? 'inline-block' : 'none' ?>;"><?= $cart_badge_count ?></span>
            </a>
        </li>
        <li><a href="<?= BASE_URL ?>/about.php" class="sidebar-link">About us</a></li>
        <li><a href="<?= BASE_URL ?>/contact.php" class="sidebar-link">Contact us</a></li>
        <li><a href="<?= BASE_URL ?>/blog.php" class="sidebar-link">Blog</a></li>
    </ul>
    <div class="sidebar-footer">
        <p>&copy; 2024 Vastu Mitra Abhishek</p>
    </div>
</aside>
