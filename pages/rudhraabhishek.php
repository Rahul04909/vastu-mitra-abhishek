<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Rudrabhishek - Divine Blessings & Inner Peace | Vastu Mitra Abhishek";
$meta_desc = "Experience the divine blessings of Lord Shiva with Rudrabhishek. Remove obstacles, invite prosperity, and achieve spiritual growth under expert guidance.";
$meta_keywords = "rudrabhishek, rudrabhishek pooja, lord shiva worship, vastu mitra abhishek, spiritual growth, divine blessings, remove obstacles";
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
            <h1>Rudrabhishek</h1>
            <p>Invoke the divine grace of Lord Shiva to eliminate negativity, overcome obstacles, and bring ultimate peace and prosperity into your life.</p>
        </div>
    </section>

    <!-- Content Section -->
    <main class="service-content-section">
        <div class="container">
            <div class="section-title">
                <h2>Why is Rudrabhishek Important?</h2>
                <p>A sacred ritual to align yourself with divine energies, bringing harmony and fulfilling your desires.</p>
            </div>
            
            <div class="intro-container">
                <div class="intro-content">
                    <p>Rudrabhishek is one of the most powerful and sacred rituals in Hinduism, dedicated to Lord Shiva. The word 'Rudra' refers to a fierce manifestation of Lord Shiva, and 'Abhishek' means a holy bath. During this pooja, the Shiva Linga is bathed with various sacred offerings like milk, ghee, honey, curd, and sugarcane juice while chanting powerful Vedic mantras.</p>
                    <p>This divine practice is believed to wash away negative karma, protect against evil forces, and bring profound peace and prosperity. It is highly recommended for overcoming life's hurdles, achieving spiritual growth, and inviting divine blessings into your personal and professional life.</p>
                    
                    <div class="intro-highlight" style="background: rgba(26, 26, 64, 0.05); border-left: 6px solid #1a1a40;">
                        <p style="color: #1a1a40;">"Vastu Mitra Abhishek guides you in performing Rudrabhishek with absolute devotion and accuracy, ensuring maximum spiritual and material benefits for you and your family."</p>
                    </div>
                </div>
            </div>

            <div class="benefits-section">
                <div class="benefits-grid">
                    <!-- Benefit 1 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-om"></i></div>
                        <h3>Spiritual Upliftment</h3>
                        <p>Enhances your spiritual connection with the divine, clearing the mind of worldly clutter and promoting inner peace and clarity.</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-shield-alt"></i></div>
                        <h3>Removes Obstacles</h3>
                        <p>Helps in removing hurdles in career, business, and personal life, paving the way for success and uninterrupted growth.</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-heartbeat"></i></div>
                        <h3>Health & Longevity</h3>
                        <p>Invokes Lord Shiva's blessings for good health, curing prolonged illnesses, and granting longevity and vitality to the devotees.</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-coins"></i></div>
                        <h3>Wealth & Prosperity</h3>
                        <p>Attracts financial stability and abundance, ensuring that your efforts yield fruitful results in all endeavors.</p>
                    </div>

                    <!-- Benefit 5 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-home"></i></div>
                        <h3>Family Harmony</h3>
                        <p>Promotes love, understanding, and peace among family members, resolving disputes and fostering a harmonious domestic environment.</p>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="benefit-card">
                        <div class="benefit-icon-wrapper" style="background: rgba(26, 26, 64, 0.1); color: #1a1a40;"><i class="fas fa-sun"></i></div>
                        <h3>Eliminates Negativity</h3>
                        <p>Cleanses your aura and surroundings from negative energies, evil eyes, and planetary doshas, surrounding you with a protective shield.</p>
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
                    <img src="<?= BASE_URL ?>/assets/images/newsletter.png" alt="Vastu Mitra Abhishek - Rudrabhishek Guidance">
                </div>
                <div class="expert-content-side">
                    <span class="expert-tag">Divine Guidance & Rituals</span>
                    <h2>Vastu Mitra Abhishek</h2>
                    <p>Performing Rudrabhishek requires precise adherence to Vedic rituals, correct pronunciation of mantras, and the right sequence of offerings to reap its full benefits.</p>
                    <p>Vastu Mitra Abhishek brings years of expertise in guiding devotees through this sacred ritual, ensuring that every aspect aligns perfectly with the ancient scriptures. His profound knowledge helps customize the pooja to address your specific life challenges and aspirations.</p>
                    <p>Whether you seek relief from distress, desire tremendous success, or simply wish to express gratitude to the Almighty, Vastu Mitra Abhishek provides the perfect spiritual guidance for a transformative experience.</p>
                    
                    <div class="expert-cta">
                        <a href="<?= BASE_URL ?>/contact.php" class="btn-primary">
                            Book Your Pooja <i class="fas fa-arrow-right"></i>
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
