<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Commercial Vastu Expert - Business Success | Vastu Mitra Abhishek";
$meta_desc = "Boost your business productivity and prosperity with Commercial Vastu. Learn about the importance of Vastu for workplace harmony under the guidance of Vastu Mitra Abhishek.";
$meta_keywords = "commercial vastu, business vastu, vastu for office, vastu mitra abhishek, workplace harmony, industrial vastu";
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
            <h1>Commercial Vastu</h1>
            <p>Elevate your business prospects through the ancient wisdom of spatial harmony and elemental balance.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="section-title">
                <h2>Why is Commercial Vastu Important?</h2>
                <p>Aligning your business environment with the five elements for unparalleled success and harmony.</p>
            </div>
            
            <div class="intro-container">
                <div class="intro-content">
                    <p>In India, many businesses believe in the importance of commercial Vastu for business success. Commercial Vastu is the ancient Indian practice of aligning buildings and objects with the five elements of nature: earth, water, fire, air, and space. The goal of Commercial Vastu is to create balance and harmony in the workplace, which in turn leads to success in business.</p>
                    
                    <div class="intro-highlight">
                        <p>"Vastu Mitra Abhishek helps you create a balanced and harmonious workplace all over the world, ensuring prosperity for your business venture."</p>
                    </div>
                </div>
            </div>

            <div class="benefits-section">
                <div class="benefits-grid">
                    <!-- Benefit 1 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-chart-line"></i></div>
                        <h3>Improved Productivity</h3>
                        <p>A balanced and harmonious workplace is more conducive to productivity than a chaotic one, reinforcing the importance of Commercial Vastu even more.</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-smile-beam"></i></div>
                        <h3>Employee Morale</h3>
                        <p>Happy and content employees are more likely to be productive and stay with the company for longer.</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-users"></i></div>
                        <h3>Customer Satisfaction</h3>
                        <p>Satisfied customers are more likely to return and recommend the company to others.</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-rocket"></i></div>
                        <h3>Business Prospects</h3>
                        <p>A well-balanced business is more likely to attract investors and partners.</p>
                    </div>

                    <!-- Benefit 5 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-leaf"></i></div>
                        <h3>Reduced Stress</h3>
                        <p>A calm and peaceful work environment helps to reduce stress levels and promote a healthy lifestyle.</p>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper"><i class="fas fa-globe"></i></div>
                        <h3>Global Relevance</h3>
                        <p>Commercial Vastu is not only important for businesses in India but for businesses all over the world.</p>
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
                    <img src="<?= BASE_URL ?>/assets/images/expert-commercial.jpg" alt="Vastu Mitra Abhishek - Commercial Vastu Expert">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag">The Commercial Vastu Expert</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>Despite being thousands of years old, the importance of commercial Vastu is still relevant in today’s world. In India, commercial Vastu Shastra is a popular belief system followed by many business owners.</p>
                    <p>If you are looking to bring harmony and prosperity using commercial vastu, then you should consider following the principles of commercial vastu shastra under the able guidance of Vastu Mitra Abhishek, the leading commercial Vastu expert in India.</p>
                    <p>Vastu Mitra Abhishek helps business owners from every industry and sector find solutions to real-time commercial Vastu problems, with decades of experience and a successful record of accomplishment.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary">
                            Get Expert Consultation <i class="fas fa-arrow-right"></i>
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
        // Simple Scroll Reveal
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.benefit-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
            
            // IntersectionObserver doesn't add 'reveal' class itself here, we'll just use the entry check
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
