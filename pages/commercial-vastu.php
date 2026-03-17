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
            </div>
            
            <div class="content-info-box">
                <p>In India, many businesses believe in the importance of commercial Vastu for business success. Commercial Vastu is the ancient Indian practice of aligning buildings and objects with the five elements of nature: earth, water, fire, air, and space. The goal of Commercial Vastu is to create balance and harmony in the workplace, which in turn leads to success in business.</p>
            </div>

            <div class="benefits-grid">
                <!-- Benefit 1 -->
                <div class="benefit-card">
                    <div class="benefit-number">01</div>
                    <h3>Improved Productivity</h3>
                    <p>A balanced and harmonious workplace is more conducive to productivity than a chaotic one, reinforcing the importance of Commercial Vastu even more.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="benefit-card">
                    <div class="benefit-number">02</div>
                    <h3>Improved Employee Morale</h3>
                    <p>Happy and content employees are more likely to be productive and stay with the company for longer.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="benefit-card">
                    <div class="benefit-number">03</div>
                    <h3>Enhanced Customer Satisfaction</h3>
                    <p>Satisfied customers are more likely to return and recommend the company to others.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="benefit-card">
                    <div class="benefit-number">04</div>
                    <h3>Improved Business Prospects</h3>
                    <p>A well-balanced business is more likely to attract investors and partners.</p>
                </div>

                <!-- Benefit 5 -->
                <div class="benefit-card">
                    <div class="benefit-number">05</div>
                    <h3>Reduced Stress Levels</h3>
                    <p>A calm and peaceful work environment helps to reduce stress levels and promote a healthy lifestyle.</p>
                </div>
            </div>

            <div class="content-info-box mt-5" style="border-left: 0; border-right: 5px solid var(--service-secondary); text-align: right; margin-top: 50px;">
                <p>Commercial Vastu is not only important for businesses in India but for businesses all over the world. If you want to create a successful and prosperous business, it is important to create a balanced and harmonious workplace using Vastu Mitra Abhishek and his expertise in commercial Vastu.</p>
            </div>
        </div>
    </main>

    <!-- Expert Section -->
    <section class="expert-section">
        <div class="container">
            <div class="expert-container">
                <div class="expert-image">
                    <img src="<?= BASE_URL ?>/assets/images/expert-commercial.jpg" alt="Vastu Mitra Abhishek - Commercial Vastu Expert" onerror="this.src='https://via.placeholder.com/400x500?text=Commercial+Vastu+Expert'">
                </div>
                <div class="expert-info">
                    <h2>Vastu Mitra Abhishek- The Commercial Vastu expert</h2>
                    <p>Despite being thousands of years old, the importance of commercial Vastu is still relevant in today’s world. In India, commercial Vastu Shastra is a popular belief system that is followed by many business owners. For the past few decades, interest in utilizing commercial Vastu for workplace harmony has skyrocketed.</p>
                    <p>If you are looking to bring harmony and prosperity using commercial vastu, then you should consider following the principles of commercial vastu shastra under the able guidance of Vastu Mitra Abhishek, the leading commercial Vastu expert in India.</p>
                    <p>Vastu Mitra Abhishek is the best commercial Vastu expert in India, helping businesses and business owners from every industry and sector find solutions to real-time commercial Vastu problems. Vastu Mitra Abhishek, the best commercial Vastu expert in India, is coveted in the field of commercial Vastu with decades of experience as well as a successful record of solving commercial Vastu problems.</p>
                    
                    <a href="<?= BASE_URL ?>/contact.php" class="btn" style="background: var(--service-secondary); color: white; padding: 15px 35px; border-radius: 30px; text-decoration: none; display: inline-block; font-weight: 600; margin-top: 20px; transition: 0.3s; box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);">
                        Get Expert Consultation <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        // Scroll Animation for Benefit Cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.benefit-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>
