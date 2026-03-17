<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Residential Vastu Expert - Home Harmony & Prosperity | Vastu Mitra Abhishek";
$meta_desc = "Create a harmonious and positive living space with Residential Vastu. Improve health, finances, and relationships under the expert guidance of Vastu Mitra Abhishek.";
$meta_keywords = "residential vastu, vastu for home, vastu shastra, home harmony, vastu mitra abhishek, positive living space";
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
    <section class="service-hero">
        <div class="container">
            <h1>Residential Vastu</h1>
            <p>Creating harmonious and positive living spaces for a life full of happiness and prosperity.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="section-title">
                <h2>Why is Residential Vastu Important?</h2>
                <p>Ensuring your home is in harmony with the natural elements to unlock a positive and prosperous life.</p>
            </div>
            
            <div class="intro-container">
                <div class="intro-content">
                    <p>Residential Vastu is an ancient Indian practice followed to create a harmonious and positive living space. The word 'vastu' comes from the Sanskrit word 'vastu', which means 'house'. Vastu shastra, or residential vastu, is a set of principles used to create a positive home that brings happiness and prosperity to the household.</p>
                    
                    <div class="intro-highlight">
                        <p>"It is important to ensure that our living spaces are in harmony with the elements to create a positive and prosperous life through the utilization of residential vastu principles."</p>
                    </div>
                </div>
            </div>

            <div class="benefits-section">
                <div class="benefits-grid">
                    <!-- Benefit 1 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-heartbeat"></i></div>
                        <h3>Health & Well-being</h3>
                        <p>One of the major benefits of residential Vastu Shastra is that it can help to improve your health and well-being. By ensuring that your home is in alignment with the five elements, you can create a positive and healthy environment.</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-coins"></i></div>
                        <h3>Improved Finances</h3>
                        <p>There is a lot of emphasis on the placement of doors and windows in Vastu Shastra. The right placement of these openings can help attract positive energy into your home, which can in turn lead to improved finances.</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-user-friends"></i></div>
                        <h3>Enhanced Relationships</h3>
                        <p>The right placement of furniture and other items in your home can help create a more harmonious environment, which can lead to improved relationships with your loved ones.</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-laptop-house"></i></div>
                        <h3>Increased Productivity</h3>
                        <p>When your home is in alignment with residential Vastu Shastra, you will be surrounded by positive energy, which can help increase your motivation and productivity throughout the day.</p>
                    </div>

                    <!-- Benefit 5 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-spa"></i></div>
                        <h3>Positive Atmosphere</h3>
                        <p>Following Vastu principles ensures a constant flow of positive energy, creating a serene and welcoming atmosphere for all residents.</p>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-sun"></i></div>
                        <h3>Universal Wisdom</h3>
                        <p>In recent years, there has been a growing interest in residential Vastu Shastra across the globe, proving its effectiveness and relevance in the modern world.</p>
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
                    <img src="<?= BASE_URL ?>/assets/images/expert-residential.jpg" alt="Vastu Mitra Abhishek - Residential Vastu Expert">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag">The Residential Vastu Expert</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>Despite being an ancient practice, residential vastu is still relevant in today's world. In India, Vastu shastra is a popular belief system followed by many. In recent years, interest has grown significantly in the Western world as well.</p>
                    <p>If you are looking to create a positive and harmonious environment in your home, you should consider following the principles of residential Vastu Shastra under my professional guidance.</p>
                    <p>As one of the best residential Vastu experts in India, I help people from all walks of life find solutions to their residential Vastu problems with decades of experience and a record of proven results.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary">
                            Book Your Session <i class="fas fa-calendar-alt"></i>
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
