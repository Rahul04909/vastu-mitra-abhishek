<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Vastu Logo Design for Business Success | Vastu Mitra Abhishek";
$meta_desc = "Align your brand identity with positive vibrations. Get a professionally designed logo based on Vastu Shastra and Numerology for growth, recognition, and long-term success.";
$meta_keywords = "vastu logo design, business logo vastu, logo numerology, brand identity vastu, vastu mitra abhishek, business success logo";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <meta name="description" content="<?= $meta_desc ?>">
    <meta name="keywords" content="<?= $meta_keywords ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="<?= BASE_URL ?>/favicon.png" type="image/x-icon">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/service-page.css">
    
    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .logo-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 40px 0;
            text-align: center;
        }
        .stat-item {
            padding: 30px;
            background: var(--service-muted);
            border-radius: 15px;
        }
        .stat-item i {
            font-size: 2rem;
            color: var(--service-secondary);
            margin-bottom: 15px;
        }
        .stat-item h4 {
            font-size: 1.1rem;
            color: var(--service-primary);
        }
        @media (max-width: 768px) {
            .logo-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="service-hero" style="background: linear-gradient(135deg, #1a1a40 0%, #2a2a60 100%);">
        <div class="container">
            <h1>Logo Design as per Vastu & Numerology</h1>
            <p>Combine the power of geometry, energy, and vibrations to create a powerful identity for your brand.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="section-title">
                <h2>Why Logo Design is Important for Business</h2>
                <p>Aligning your brand's face with your cosmic energy for growth and recognition.</p>
            </div>
            
            <div class="intro-container">
                <div class="intro-content">
                    <p>In today’s competitive business world, a logo is not just a graphic symbol — it is the identity, energy and face of your brand. A professionally designed logo represents the vision, credibility and energy of your business. When created using Vastu principles and numerology, it can align your business with positive vibrations that support long-term success.</p>
                    
                    <div class="intro-highlight" style="border-radius: 20px; border-left: 8px solid var(--service-secondary);">
                        <p>"At Vastu Mitra, we provide Vastu-based logo design consultation that combines Vastu Shastra, numerology and energy science to create powerful business identities."</p>
                    </div>
                </div>
            </div>

            <div class="logo-stats">
                <div class="stat-item">
                    <i class="fas fa-signature"></i>
                    <h4>Name Energy</h4>
                </div>
                <div class="stat-item">
                    <i class="fas fa-calendar-day"></i>
                    <h4>DOB Numerology</h4>
                </div>
                <div class="stat-item">
                    <i class="fas fa-wave-square"></i>
                    <h4>Color Vibration</h4>
                </div>
                <div class="stat-item">
                    <i class="fas fa-compass"></i>
                    <h4>Directional Balance</h4>
                </div>
            </div>

            <div class="section-title" style="margin-top: 80px;">
                <h2>Scientific Parameters of Vastu Logo Design</h2>
                <p>We analyze 30 to 50 different parameters to ensure your logo works as a powerful energy instrument.</p>
            </div>

            <div class="benefits-section">
                <div class="benefits-grid">
                    <!-- Benefit 1 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-bullseye"></i></div>
                        <h3>Brand Recognition</h3>
                        <p>A unique and meaningful logo helps build strong brand recognition and increase customer trust and credibility.</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-balance-scale"></i></div>
                        <h3>Energetic Balance</h3>
                        <p>Harmonize your name energy and date of birth numerology with your business vibration for a stronger brand impact.</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-users-cog"></i></div>
                        <h3>Partner Alignment</h3>
                        <p>Special consideration for businesses with multiple partners to ensure the logo works positively for everyone involved.</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-bolt"></i></div>
                        <h3>Energy Instrument</h3>
                        <p>A well-designed Vastu logo works like an energy instrument, continuously communicating your business identity to the world.</p>
                    </div>

                    <!-- Benefit 5 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-chart-line"></i></div>
                        <h3>Market Positioning</h3>
                        <p>A scientifically designed logo strengthens your business identity and improves your market positioning significantly.</p>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-sync-alt"></i></div>
                        <h3>Periodic Review</h3>
                        <p>Expert recommendation for logo review every 7-8 years to maintain relevance and adapt to changing market conditions.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Expert Section -->
    <section class="expert-section">
        <div class="container">
            <div class="expert-card">
                <div class="expert-img-side">
                    <img src="<?= BASE_URL ?>/assets/images/service-logo-design.jpg" alt="Vastu Mitra Abhishek - Vastu Logo Design Expert">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag">The Vastu Logo Expert</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>At Vastu Mitra, logo design is approached as a scientific and energetic process, not just graphic design. Our experts analyze multiple factors including Name numerology, Date of birth analysis, and Industry relevance.</p>
                    <p>If you want a powerful and meaningful logo designed using Vastu and numerology principles, our experts are here to help. A scientifically designed logo can become the foundation of your brand success.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary">
                            Consult for Logo Design <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        document.querySelectorAll('.benefit-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
            
            const obs = new IntersectionObserver((entries) => {
                if(entries[0].isIntersecting) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            }, {threshold: 0.1});
            obs.observe(card);
        });
    </script>
</body>
</html>
