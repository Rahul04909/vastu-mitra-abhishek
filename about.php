<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "About Vastu Mitra Abhishek - Best Vastu Consultant in India";
$meta_desc = "Learn about Vastu Mitra Abhishek, India's leading Vastu expert with 12+ years of experience in residential, commercial, industrial, and personal Vastu solutions.";
$meta_keywords = "best vastu consultant india, vastu mitra abhishek, vastu expertise, residential commercial industrial vastu expert";
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/about.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/services_section.css">
    
    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>About Us</h1>
            <p>Empowering lives through the ancient science of Vastu Shastra, combined with modern scientific expertise.</p>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="about-intro-section">
        <div class="container">
            <div class="about-intro-grid">
                <div class="about-image-wrapper">
                    <img src="<?= BASE_URL ?>/assets/images/expert-commercial.jpg" alt="Vastu Mitra Abhishek">
                    <div class="about-experience-badge">
                        <span>12+</span>
                        <small>Years Experience</small>
                    </div>
                </div>
                <div class="about-intro-content">
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>Vastu Mitra Abhishek is a once-in-a-generation as well as the <strong>best Vastu consultant in India</strong>. His 12 years of expertise in residential Vastu, commercial Vastu, industrial Vastu, personal Vastu, aura healing, and more have undoubtedly raised his expertise level and his humanistic appeal to make him the best Vastu consultant in India.</p>
                    <p>Vastu Mitra Abhishek has helped individuals, businesses, and top industrialists across India as well as the world to achieve peace, happiness, stability, success, profits, reputation, health, and results by correctly identifying the doshas and swiftly correcting these doshas through his highly-scientific Vastu Shastra methods based on the ancient science of Vastu Shastra.</p>
                    <p>Vastu Mitra Abhishek is a veteran in the world of Vastu shastra, with a robust clientele count crossing more than 700. He has delivered satisfactory results and changed many lives for the better with his extensive knowledge, making him the most coveted name in the field.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="about-vision-section">
        <div class="container">
            <div class="vision-vision-box">
                <h2>Our Vision</h2>
                <p>"Bringing change with the expertise of the best Vastu consultant in India."</p>
            </div>

            <div class="about-benefits-grid">
                <!-- Benefit 1 -->
                <div class="about-benefit-card">
                    <i class="fas fa-certificate"></i>
                    <h3>Full Satisfaction</h3>
                    <p>Get accurate and comprehensive reports and results examined by Vastu Mitra Abhishek and get the perfect Vastu solutions from the best Vastu consultant in India.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="about-benefit-card">
                    <i class="fas fa-microscope"></i>
                    <h3>Scientific Solutions</h3>
                    <p>Highly skilled and learned in solving personal, commercial, residential, and industrial Vastu problems with highly scientific methods based on ancient Vastu Shastra.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="about-benefit-card">
                    <i class="fas fa-users-viewfinder"></i>
                    <h3>Expertise & Record</h3>
                    <p>More than 12 years of Vastu Shastra experience with over 700 happy clients, helped in very meaningful and helpful ways, making him the best Choice in India.</p>
                </div>
            </div>

            <div class="about-cta-section">
                <a href="<?= BASE_URL ?>/shop.php" class="btn-shop">Shop Here <i class="fas fa-shopping-bag"></i></a>
            </div>
        </div>
    </section>

    <!-- Services Component -->
    <?php include __DIR__ . '/components/services_section.php'; ?>

    <!-- Map Section -->
    <section class="about-map-section">
        <div class="container">
            <div class="about-map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112313.16016666874!2d77.243555!3d28.420455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cd99f1933f38d%3A0x423986a455f560e1!2sVastu%20Mitra%20Abhishek!5e0!3m2!1sen!2sin!4v1710662400000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        // Reveal Animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.about-benefit-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>
