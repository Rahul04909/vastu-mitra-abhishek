<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Industrial Vastu Expert - Success & Harmony in Industry | Vastu Mitra Abhishek";
$meta_desc = "Achieve immense success and harmony in your industrial workplace with Industrial Vastu. Boost productivity and reduce accidents under the expert guidance of Vastu Mitra Abhishek.";
$meta_keywords = "industrial vastu, factory vastu, industrial vastu shastra, vastu mitra abhishek, workplace harmony, industrial success";
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
        /* Specific Grid Adjustments for Industrial Page to make it "Different" */
        .industrial-grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            margin-top: 60px;
        }

        .industrial-intro-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 100px;
        }

        .benefit-card-industrial {
            background: #fff;
            padding: 50px;
            border-radius: 0; /* Sharp, industrial look */
            border: 1px solid #eee;
            border-left: 5px solid var(--service-primary);
            transition: var(--service-transition);
        }

        .benefit-card-industrial:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            border-left-color: var(--service-secondary);
        }

        .benefit-card-industrial h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: var(--service-primary);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .benefit-card-industrial i {
            color: var(--service-secondary);
            font-size: 1.4rem;
        }

        @media (max-width: 991px) {
            .industrial-grid-container, .industrial-intro-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="service-hero">
        <div class="container">
            <h1>Industrial Vastu</h1>
            <p>Ancient science of architectural alignment for industrial safety, productivity, and immense success.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="industrial-intro-grid">
                <div class="intro-content">
                    <div class="section-title" style="text-align: left; margin-bottom: 30px;">
                        <h2 style="font-size: 2.8rem;">Why is Industrial Vastu Important?</h2>
                    </div>
                    <p>Industrial Vastu is an ancient Indian science of architecture and construction based on directional alignments. It is said that by following the rules of industrial Vastu, one can achieve success and harmony in their life and business.</p>
                    <p>For the past few decades, interest in industrial Vastu for workplace harmony has seen a meteoric rise in usage as well as popularity among businesses and industrial workplaces alike.</p>
                </div>
                <div class="intro-visual">
                    <div class="intro-highlight" style="border-radius: 0; border-left-width: 10px;">
                        <p style="font-size: 1.3rem; line-height: 1.6;">"Industrial Vastu India has led thousands of industrial workplaces to immense success."</p>
                    </div>
                </div>
            </div>
            
            <div class="section-title">
                <h2>Key Benefits of Implementation</h2>
                <p>Implementing Industrial Vastu Shastra creates a positive impact on your bottom line and workplace safety.</p>
            </div>

            <div class="industrial-grid-container">
                <!-- Benefit 1 -->
                <div class="benefit-card-industrial">
                    <h3><i class="fas fa-industry"></i> Better Productivity</h3>
                    <p>Right placement of machinery, equipment, and materials leads to smooth energy flow, boosting worker efficiency and overall organization productivity.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="benefit-card-industrial">
                    <h3><i class="fas fa-users-cog"></i> Improved Morale</h3>
                    <p>A harmonious and positive environment leads to higher morale. Following industrial Vastu creates happier and more content workers.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="benefit-card-industrial">
                    <h3><i class="fas fa-hand-holding-usd"></i> Greater Profits</h3>
                    <p>Improved productivity and morale often lead to greater profits. Businesses following industrial Vastu see a positive impact on their bottom line.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="benefit-card-industrial">
                    <h3><i class="fas fa-shield-alt"></i> Fewer Accidents</h3>
                    <p>One of the most important benefits is reducing the occurrence of accidents through strategic elemental balance and directional alignment.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Expert Section -->
    <section class="expert-section">
        <div class="container">
            <div class="expert-card" style="border-radius: 0;">
                <div class="expert-img-side">
                    <img src="<?= BASE_URL ?>/assets/images/expert-industrial.jpg" alt="Vastu Mitra Abhishek - Industrial Vastu Expert">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag" style="border-radius: 0;">The Industrial Vastu Expert</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>If your business is seeking to bring safety and prosperity using industrial vastu, then you should implement industrial vastu shastra under the expertise of Vastu Mitra Abhishek, the leading industrial Vastu expert in India.</p>
                    <p>As the best industrial Vastu expert in India, I help businesses from every industry and sector find solutions to pressing as well as long-term industrial Vastu woes.</p>
                    <p>With decades of experience and a successful record of accomplishment, I am dedicated to leading your industrial workplace to immense success through proven Vastu principles.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary" style="border-radius: 0;">
                            Consult the Expert <i class="fas fa-arrow-right"></i>
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
        document.querySelectorAll('.benefit-card-industrial').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `all 0.6s ease-out ${index * 0.15}s`;
            
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
