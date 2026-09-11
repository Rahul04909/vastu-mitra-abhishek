<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Personal Vastu Expert - Harmonize Your Life | Vastu Mitra Abhishek";
$meta_desc = "Enhance your physical and psychological well-being with Personal Vastu. Align your personal space with cosmic energies for balance, prosperity, and mental peace.";
$meta_keywords = "personal vastu, vastu for well-being, vastu mitra abhishek, personal growth, mental peace, harmonious life";
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
</head>
<body>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="service-hero" style="background: linear-gradient(135deg, #1a1a40 0%, #3a3a80 100%);">
        <div class="container">
            <h1>Personal Vastu</h1>
            <p>Harmonizing your environment with individual well-being for balance, prosperity, and mental peace.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="section-title">
                <h2>Why is Personal Vastu Important?</h2>
                <p>Aligning your personal space with cosmic energies to promote a more fulfilling and prosperous life.</p>
            </div>
            
            <div class="intro-container">
                <div class="intro-content">
                    <p>Personal Vastu, an ancient Indian architectural and design concept, holds significance in one’s life as it seeks to harmonize the environment with individual well-being. It emphasizes the alignment of spaces with the cosmic energies to promote balance, prosperity, and mental peace. By adhering to Personal Vastu principles, individuals can experience improved health, relationships, and overall quality of life.</p>
                    <p>It encourages mindful placement of elements like furniture and colors in homes or workplaces, aiming to create a positive atmosphere that fosters personal growth and happiness. Incorporating Personal Vastu can enhance the physical and psychological aspects of daily living, contributing to a more fulfilling life.</p>
                    
                    <div class="intro-highlight" style="background: rgba(26, 26, 64, 0.05); border-left: 6px solid #1a1a40;">
                        <p style="color: #1a1a40;">"Vastu Mitra Abhishek unlocks a harmonious and prosperous life through ancient Vastu Shastra, aligning your environment with cosmic energies to enhance your overall well-being."</p>
                    </div>
                </div>
            </div>

            <div class="benefits-section">
                <div class="benefits-grid">
                    <!-- Benefit 1 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-spa"></i></div>
                        <h3>Enhanced Well-being</h3>
                        <p>Promotes the alignment of your living space with natural energies, leading to improved physical and mental health. A balanced environment helps reduce stress and anxiety.</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-hands-helping"></i></div>
                        <h3>Harmonious Relationships</h3>
                        <p>Positively impacts interpersonal relationships. Balanced energies lead to smoother interactions and better communication among family members.</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-gem"></i></div>
                        <h3>Financial Prosperity</h3>
                        <p>Facilitates financial growth by ensuring your space is conducive to success. It encourages the flow of positive energy, influencing career advancement and stability.</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-bullseye"></i></div>
                        <h3>Improved Focus</h3>
                        <p>Enhances concentration and productivity. In a professional setting, a balanced environment leads to significantly better work outcomes and personal growth.</p>
                    </div>

                    <!-- Benefit 5 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-peace"></i></div>
                        <h3>Mental Peace</h3>
                        <p>Mindful placement of elements creates a positive atmosphere that fosters happiness and internal serenity, essential for psychological health.</p>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-mountain"></i></div>
                        <h3>Personal Growth</h3>
                        <p>The transformative influence of Personal Vastu empowers emotional stability and spiritual growth, leading to a more fulfilling daily life.</p>
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
                    <img src="<?= BASE_URL ?>/assets/images/expert-personal.jpg" alt="Vastu Mitra Abhishek - Personal Vastu Expert">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag">The Personal Vastu Expert</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>Despite being thousands of years old, the importance of Personal Vastu is still relevant in today's world. For the past few decades, the interest in utilizing Personal Vastu for life harmony has skyrocketed.</p>
                    <p>If you are looking to bring harmony and prosperity using Personal Vastu, then you should consider following the principles of Vastu Shastra under my professional guidance.</p>
                    <p>As the leading Personal Vastu expert in India, I help individuals from all walks of life find solutions to real-time problems, with decades of experience and a successful record of accomplishment.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary">
                            Get Your Session <i class="fas fa-arrow-right"></i>
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
