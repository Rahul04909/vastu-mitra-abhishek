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
                    </ul>
                </li>
                <li><a href="<?= BASE_URL ?>/shop.php" class="nav-link">Shop</a></li>
                <li><a href="<?= BASE_URL ?>/blog.php" class="nav-link">Blog</a></li>
                <li><a href="<?= BASE_URL ?>/about.php" class="nav-link">About</a></li>
                <li><a href="<?= BASE_URL ?>/contact.php" class="nav-link">Contact us</a></li>
            </ul>
        </nav>

        <button class="mobile-toggle" aria-label="Toggle Navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
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
            </ul>
        </li>
        <li><a href="<?= BASE_URL ?>/shop.php" class="sidebar-link">Shop</a></li>
        <li><a href="<?= BASE_URL ?>/about.php" class="sidebar-link">About us</a></li>
        <li><a href="<?= BASE_URL ?>/contact.php" class="sidebar-link">Contact us</a></li>
        <li><a href="<?= BASE_URL ?>/blog.php" class="sidebar-link">Blog</a></li>
    </ul>
    <div class="sidebar-footer">
        <p>&copy; 2024 Vastu Mitra Abhishek</p>
    </div>
</aside>
