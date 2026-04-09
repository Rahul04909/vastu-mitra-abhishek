<?php
require_once __DIR__ . '/../database/db_config.php';

$page_title = "Scientific Vastu Logo Design | Vastu Mitra Abhishek";
$meta_desc = "Unlock business prosperity with a scientifically designed Vastu Logo. Expert consultancy by Vastu Mitra Abhishek focusing on 50+ parameters, Numerology, and Sacred Geometry.";
$meta_keywords = "vastu logo design, business logo vastu, brand identity vastu, vastu mitra abhishek, logo numerology expert, scientific logo design";
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --vastu-deep: #1a1a40;
            --vastu-gold: #ff9933;
            --vastu-light: #f8faff;
        }

        /* Unique Hero Enhancement */
        .unique-hero {
            padding: 180px 0 120px;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            color: white;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .unique-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTUwIDUgTDUgNTAgTDUwIDk1IEw5NSA1MCBaIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMC41Ii8+PC9zdmc+');
            opacity: 0.3;
            z-index: -1;
        }

        .unique-hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 25px;
            text-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .unique-hero p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
            line-height: 1.8;
        }

        /* Deep Content Sections */
        .deep-content-wrap {
            padding: 100px 0;
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
        }

        .content-section {
            margin-bottom: 80px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .content-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .content-section h2 {
            font-size: 2.2rem;
            color: var(--vastu-deep);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .content-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--vastu-gold);
        }

        .interactive-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }

        .interactive-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.05);
            border-bottom: 5px solid transparent;
            transition: all 0.4s ease;
        }

        .interactive-card:hover {
            transform: translateY(-10px);
            border-color: var(--vastu-gold);
            box-shadow: 0 25px 60px rgba(0,0,0,0.1);
        }

        .interactive-card i {
            font-size: 2.5rem;
            color: var(--vastu-gold);
            margin-bottom: 25px;
        }

        .accent-box {
            background: var(--vastu-light);
            border-radius: 30px;
            padding: 60px;
            margin: 60px 0;
            border: 1px solid #e1e7f0;
            position: relative;
        }

        .process-steps {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .step-item {
            display: flex;
            gap: 30px;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--vastu-deep);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Content Text Formatting */
        .text- эксперт {
            font-weight: 600;
            color: var(--vastu-gold);
        }

        .sticky-cta {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .accent-box { padding: 30px; }
            .step-item { flex-direction: column; gap: 15px; }
            .unique-hero { padding: 150px 0 80px; }
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Hero Section -->
    <header class="unique-hero">
        <div class="container animate-up">
            <span class="expert-tag" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); margin-bottom: 20px;">Premium Branding & Energy Sync</span>
            <h1>Sacred Branding: Vastu Logo Design Expert</h1>
            <p>Transform your business identity into a powerful energy instrument. At Vastu Mitra Abhishek, we don't just design logos—we align your brand's face with the cosmic vibrations of success, growth, and prosperity.</p>
        </div>
    </header>

    <main class="deep-content-wrap">
        <div class="container">
            
            <!-- Section 1: Introduction -->
            <div class="content-section">
                <h2>The Silent Architect: Why Your Logo Matters</h2>
                <p>In the high-stakes world of global commerce, a logo is far more than a decorative symbol. It is the <span class="text-эксперт">first point of energetic contact</span> between your business and the world. From a Vastu perspective, every line, curve, and shade in your brand's identity emits a specific frequency that interacts with the subconscious mind of your audience. When this frequency is misaligned with the nature of your business or your personal energy (Numerology), it creates an invisible barrier to success. Conversely, a Vastu-aligned logo acts as a perpetual energy generator, continuously pulling in opportunities and stabilizing the core foundations of your enterprise.</p>
                <p>At Vastu Mitra Abhishek, we approach logo design as a spiritual and scientific alchemy. We understand that your business is a living entity, and its identity must be rooted in the five eternal elements—Earth, Water, Fire, Air, and Space. Our mission is to ensure your brand stands as a beacon of balanced energy in a crowded marketplace.</p>
            </div>

            <!-- Section 2: Sacred Geometry -->
            <div class="content-section">
                <h2>Sacred Geometry: The Pulse of Visual Prosperity</h2>
                <div class="intro-container" style="flex-direction: row-reverse;">
                    <div class="intro-content">
                        <p>Geometry is the language of God. In Vastu Shastra, shapes are not accidental; they are containers for specific types of energy. A square logo, for instance, represents the Earth element—providing stability, trust, and permanence. It is ideal for banks, insurance companies, and real estate developers. A circular logo, on the other hand, mimics the cycles of the sun and the moon, symbolizing continuity, flow, and perfection, making it perfect for service-oriented or global tech brands.</p>
                        <p>When we design a logo, we analyze the <span class="text-эксперт">golden ratio</span> and directional flow. Is the logo leaning towards the Northeast (Ishanya), which invites creative wisdom? Or is it grounded in the Southwest (Nairutya), which ensures leadership dominance? Every geometric choice is made to ensure that your brand doesn't just look good—it feels right.</p>
                    </div>
                </div>
                
                <div class="interactive-grid">
                    <div class="interactive-card">
                        <i class="fas fa-square"></i>
                        <h3>The Stabilizing Square</h3>
                        <p>Represents the Earth element. Best for businesses requiring high trust, such as construction, heavy industry, and financial services.</p>
                    </div>
                    <div class="interactive-card">
                        <i class="fas fa-circle"></i>
                        <h3>The Infinite Circle</h3>
                        <p>Symbolizes the Air/Space element. Ideal for global connectivity, logistics, and hospitality businesses focusing on expansion.</p>
                    </div>
                    <div class="interactive-card">
                        <i class="fas fa-play" style="transform: rotate(-90deg);"></i>
                        <h3>The Rising Triangle</h3>
                        <p>Connected to the Fire element. Perfect for sports, news media, and competitive industries that need to pierce through the market.</p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Color Alchemy -->
            <div class="content-section">
                <h2>Color Alchemy: Harmonizing the Five Elements</h2>
                <div class="accent-box">
                    <p>Colors are frequencies. Each hue in the visible spectrum corresponds to an element in Vastu Shastra. Choosing the wrong color for your industry can lead to "Energy Conflict." For example, using deep fiery reds for a hospital (which needs the cooling, healing energy of water/air) might create an environment of tension rather than recovery.</p>
                    <ul style="margin-top: 20px; columns: 2; list-style: none;">
                        <li style="margin-bottom:15px;"><i class="fas fa-check-circle" style="color:var(--vastu-gold);"></i> <strong>Yellow/Gold:</strong> Wisdom & Financial Stability</li>
                        <li style="margin-bottom:15px;"><i class="fas fa-check-circle" style="color:var(--vastu-gold);"></i> <strong>Indigo/Blue:</strong> Trust & Depth of Knowledge</li>
                        <li style="margin-bottom:15px;"><i class="fas fa-check-circle" style="color:var(--vastu-gold);"></i> <strong>Emerald Green:</strong> Health & Continuous Growth</li>
                        <li style="margin-bottom:15px;"><i class="fas fa-check-circle" style="color:var(--vastu-gold);"></i> <strong>Saffron:</strong> Spiritual Energy & High Success</li>
                    </ul>
                </div>
            </div>

            <!-- Section 4: Numerology Integration -->
            <div class="content-section">
                <h2>The Numerology Matrix: Personalizing Your Brand</h2>
                <p>No logo design is complete without a deep dive into the <span class="text-эксперт">Date of Birth (DOB)</span> of the owner or the key partners. Your birth number dictates your "Lucky Numbers" and "Antagonistic Numbers." A logo that is visually perfect but numerologically hostile will always produce friction in your business operations. </p>
                <p>We analyze your life path number and your business name number (Chaldean and Pythagorean systems). If your business name doesn't harmonize with your DOB, we suggest subtle phonetic tweaks. The logo then becomes the visual anchor for this balanced numeric frequency, ensuring that every time your brand is displayed, it sends out a message that is in perfect 'sync' with your destiny.</p>
            </div>

            <!-- Section 5: The 50-Parameter Methodology -->
            <div class="content-section">
                <h2>Our Blueprint for Success: The 50-Point Audit</h2>
                <p>Most designers use 2-3 parameters (Font, Icon, Color). At Vastu Mitra Abhishek, we use up to 50 specific parameters to audit and create your logo. This is what makes us unique in the industry. Our audit includes:</p>
                <div class="benefits-section">
                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon-wrapper"><i class="fas fa-microscope"></i></div>
                            <h3>Phonetic Vibration</h3>
                            <p>Analyzing how the name sounds and if it generates "Auspicious" air ripples when spoken by customers.</p>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon-wrapper"><i class="fas fa-vector-square"></i></div>
                            <h3>Stroke Analysis</h3>
                            <p>Ensuring the flow of strokes in the text represents an "Upward Progression" rather than a downward spiral.</p>
                        </div>
                        <div class="benefit-card">
                            <div class="benefit-icon-wrapper"><i class="fas fa-layer-group"></i></div>
                            <h3>Industry Mapping</h3>
                            <p>Aligning elements with industry archetypes (e.g., Tech needs the speed of Air; Finance needs the weight of Earth).</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 6: Logo Lifecycle -->
            <div class="content-section">
                <h2>The Vastu Logo Lifecycle: 8-Year Review</h2>
                <div class="intro-container">
                    <div class="intro-content">
                        <p>The energy of the world is not static. Just as a building requires renovation, a brand identity requires a "Vastu Alignment Refresh" approximately every 7 to 8 years. This transition period often matches major Saturn cycles or Jupiter transits in astrology. A logo that worked during your startup phase might become a source of stagnation during your expansion phase.</p>
                        <p>We help businesses evolve their logos subtly, maintaining brand recognition while upgrading the energetic blueprint to match new revenue targets and larger organizational structures.</p>
                    </div>
                    <div class="intro-highlight" style="flex: 0 0 300px; text-align: center;">
                        <i class="fas fa-sync-alt" style="font-size: 4rem; color: var(--vastu-gold); margin-bottom: 20px;"></i>
                        <p>Is your brand feeling stagnant? It might be time for a Vastu Re-alignment.</p>
                    </div>
                </div>
            </div>

            <!-- Section 7: Final Expert CTA -->
            <div class="content-section" style="text-align: center; background: var(--vastu-deep); color: white; padding: 80px; border-radius: 40px;">
                <h2 style="color: white; border: none;">Begin Your Journey to Prosperity</h2>
                <p style="margin-bottom: 40px; font-size: 1.3rem;">Don't leave your brand's destiny to chance. Get a scientifically audited Vastu Logo today.</p>
                <a href="<?= BASE_URL ?>/contact.php" class="btn-primary" style="background: var(--vastu-gold); font-size: 1.2rem; padding: 20px 50px;">
                    Get My Logo Audit Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </main>

    <!-- Expert Bio Small Section -->
    <section class="expert-section" style="padding-top: 0;">
        <div class="container">
            <div class="expert-card" style="box-shadow: none; border: 1px solid #eee;">
                <div class="expert-img-side" style="flex: 0 0 250px;">
                    <img src="<?= BASE_URL ?>/assets/images/service-logo-design.jpg" alt="Vastu Mitra Abhishek">
                </div>
                <div class="expert-content-side" style="padding: 40px;">
                    <h3>Consult with Abhishek</h3>
                    <p style="font-size: 1rem;">With over a decade of experience in Vastu Shastra and Branding, Abhishek combines ancient wisdom with modern design sensibilities to deliver results that manifest in real-world success.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <div class="sticky-cta">
        <a href="https://wa.me/919971799858" target="_blank" class="btn-primary" style="background: #25D366; border-radius: 50%; width: 60px; height: 60px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        // Scroll Animation Logic
        const observerOptions = {
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.content-section, .benefit-card, .interactive-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
tml>
