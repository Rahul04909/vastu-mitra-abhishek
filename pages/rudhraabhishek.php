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
    <section class="service-hero" style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #0b0c21 0%, #1a1b41 100%); position: relative; padding: 0;">
        
        <div class="container" style="position: relative; z-index: 2; padding: 100px 0 80px; width: 100%;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
                
                <!-- Left Side: Content Card -->
                <div class="hero-content-card" style="background: rgba(26, 26, 53, 0.65); backdrop-filter: blur(15px); border: 1px solid rgba(190, 190, 193, 0.34); padding: 50px; border-radius: 24px; box-shadow: 0 30px 60px rgba(0,0,0,0.4); text-align: left;">
                    <h1 style="color: #ffffff; font-size: 3.2rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">Rudrabhishek</h1>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.15rem; line-height: 1.6; margin-bottom: 35px;">Invoke the divine grace of Lord Shiva to eliminate negativity, overcome obstacles, and bring ultimate peace and prosperity into your life.</p>
                    
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 35px;">
                        <h2 style="color: #ffb450; font-size: 1.8rem; font-weight: 700; margin-bottom: 15px;">Why is Rudrabhishek Important?</h2>
                        <p style="color: #ffffff; font-size: 1.1rem; line-height: 1.6;">A sacred ritual to align yourself with divine energies, bringing harmony and fulfilling your desires.</p>
                    </div>
                </div>





                <!-- Right Side: Animation/Video -->
                <div class="hero-animation-side" style="display: flex; justify-content: center; align-items: center;">
                    <!-- Placeholder for Pandit Video. You can replace the src with your actual mp4 file -->
                    <div style="width: 100%; max-width: 600px; aspect-ratio: 1; border-radius: 24px; background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(5px); border: 2px dashed rgba(255, 180, 80, 0.4); display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 30px; box-shadow: 0 0 60px rgba(255, 180, 80, 0.15) inset; position: relative; overflow: hidden;">
                        
                        <!-- This video tag will play your pandit video once you upload 'pandit_video.gif.mp4' to the assets/images folder -->
                        <video src="<?= BASE_URL ?>/assets/images/pandit_video.gif.mp4" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover; border-radius: 24px; position: relative; z-index: 2; display: none;" oncanplay="this.style.display='block'; this.nextElementSibling.style.display='none';"></video>
                        
                        <!-- Fallback looping animation shown until the custom video is uploaded -->
                        <div class="fallback-animation-text" style="color: rgba(255,255,255,0.8); z-index: 1;">
                            <i class="fas fa-om fa-6x" style="color: #ffb450; margin-bottom: 30px; animation: omPulse 2s ease-in-out infinite;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 500; margin-bottom: 10px;">Pandit Video Placeholder</h3>
                            <p style="font-size: 1rem; color: rgba(255,255,255,0.5); padding: 0 30px;">Upload <strong>pandit_video.mp4</strong> to the <code>assets/images</code> folder to replace this placeholder with a looping video.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <style>
            @keyframes omPulse {
                0% { transform: scale(1); filter: drop-shadow(0 0 5px rgba(255, 180, 80, 0.4)); }
                50% { transform: scale(1.15); filter: drop-shadow(0 0 25px rgba(255, 180, 80, 1)); }
                100% { transform: scale(1); filter: drop-shadow(0 0 5px rgba(255, 180, 80, 0.4)); }
            }
            @media (max-width: 991px) {
                .hero-content-card { padding: 35px !important; }
                .hero-content-card h1 { font-size: 2.5rem !important; }
                .hero-content-card h2 { font-size: 1.5rem !important; }
                .service-hero .container > div { grid-template-columns: 1fr !important; gap: 40px !important; }
                .hero-animation-side { margin-top: 20px; }
            }
        </style>
    </section>

    <!-- Content Section -->
    <main class="service-content-section" style="padding-top: 0;">
        <style>
            /* Remove the gap between hero and this section */
            .service-hero::after { display: none; }
            
            /* Background wrapper with blur and reduced brightness */
            .cards-bg-wrapper {
                position: relative;
                padding: 60px 0;
                margin-top: 40px;
                overflow: hidden;
            }
            .cards-bg-wrapper::before {
                content: "";
                position: absolute;
                top: -15px; left: -15px; right: -15px; bottom: -15px; /* Extend past edges to hide blur artifacts */
                background: url('<?= BASE_URL ?>/assets/images/rudraabhishek\'s_banner.png') fixed no-repeat center center / cover;
                filter: blur(8px) brightness(0.65); /* Blur and darken to soften the bright image */
                z-index: 0;
            }
            .cards-bg-wrapper::after {
                content: "";
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                /* Lighten the colours via a soft gradient overlay */
                background: radial-gradient(circle at center, rgba(255, 180, 80, 0.2) 0%, rgba(21, 21, 53, 0.6) 100%);
                z-index: 1;
            }
            .cards-bg-wrapper .content-front {
                position: relative;
                z-index: 2;
            }
            
            /* Make benefit cards slightly glassmorphic to show background */
            .cards-bg-wrapper .benefit-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(5px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
        
        <div class="container" style="padding-top: 60px;">
            <div class="intro-container">
                <div class="intro-content">
                    <p>Rudrabhishek is one of the most powerful and sacred rituals in Hinduism, dedicated to Lord Shiva. The word 'Rudra' refers to a fierce manifestation of Lord Shiva, and 'Abhishek' means a holy bath. During this pooja, the Shiva Linga is bathed with various sacred offerings like milk, ghee, honey, curd, and sugarcane juice while chanting powerful Vedic mantras.</p>
                    <p>This divine practice is believed to wash away negative karma, protect against evil forces, and bring profound peace and prosperity. It is highly recommended for overcoming life's hurdles, achieving spiritual growth, and inviting divine blessings into your personal and professional life.</p>
                    
                    <div class="intro-highlight" style="background: rgba(26, 26, 64, 0.05); border-left: 6px solid #1a1a40;">
                        <p style="color: #1a1a40;">"Vastu Mitra Abhishek guides you in performing Rudrabhishek with absolute devotion and accuracy, ensuring maximum spiritual and material benefits for you and your family."</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="cards-bg-wrapper">
            <div class="content-front">
                <div class="container">
                    <div class="benefits-section" style="margin-top: 0;">
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
                    
                    
                
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section with Blurred Background -->
    <div class="booking-bg-wrapper" style="position: relative; padding: 80px 0; margin-top: 20px; overflow: hidden;">
        <style>
            .booking-bg-wrapper::before {
                content: "";
                position: absolute;
                top: -15px; left: -15px; right: -15px; bottom: -15px;
                background: url('<?= BASE_URL ?>/assets/images/rudrabhishek_banner.jpg') fixed no-repeat center center / cover;
                filter: blur(8px) brightness(0.65);
                z-index: 0;
            }
            .booking-bg-wrapper::after {
                content: "";
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background: radial-gradient(circle at center, rgba(21, 21, 53, 0.4) 0%, rgba(21, 21, 53, 0.8) 100%);
                z-index: 1;
            }
            .booking-bg-wrapper .content-front {
                position: relative;
                z-index: 2;
            }
            .booking-card-glass {
                background: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
        
        <div class="content-front">
            <div class="container">
                <!-- New Separate Booking Card -->
                <div class="booking-card booking-card-glass" style="border-radius: 30px; padding: 50px; box-shadow: 0 30px 60px rgba(0,0,0,0.2); max-width: 800px; margin-left: auto; margin-right: auto;">
                    <h2 style="text-align: center; color: #1a1a40; margin-bottom: 10px; font-weight: 700; font-size: 2.2rem;">Book Your Pooja Online</h2>
                    <p style="text-align: center; color: #555; margin-bottom: 40px; font-size: 1.1rem;">Fill out the form below and our team will get in touch with you shortly.</p>
                
                <form action="<?= BASE_URL ?>/enquiry_handler.php" method="POST" id="rudraForm" style="display: grid; gap: 20px;">
                    <input type="hidden" name="service_type_select" value="Rudrabhishek">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">Your Name*</label>
                            <input type="text" name="name" placeholder="Enter your name" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">Phone Number*</label>
                            <input type="tel" name="mobile" placeholder="Enter your mobile" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">Gotra*</label>
                            <input type="text" name="gotra" placeholder="Enter your gotra" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">City*</label>
                            <input type="text" name="city" placeholder="Enter your city" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">Complete Address*</label>
                        <input type="text" name="address" placeholder="Enter your full address" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #1a1a40; font-weight: 500;">Select Plan*</label>
                        <select name="plan" required style="width: 100%; padding: 15px; border: 1px solid #eee; border-radius: 12px; background: #fbfbfb; outline: none; transition: all 0.3s;">
                            <option value="">-- Choose a Plan --</option>
                            <option value="Yagya/Pooja - 5100 - 1 person"> 5100 - 1 person</option>
                            <option value="Yagya/Pooja - 2100 - 5 person"> 2100 - 5 person</option>
                            <option value="Yagya/Pooja - 1100 - 7 person"> 1100 - 7 person</option>
                        </select>
                    </div>

                    <!-- Hidden email field required by backend to submit successfully -->
                    <input type="hidden" name="email" value="pooja_booking@vastumitraabhishek.in">
                    
                    <button type="submit" style="background: #1a1a40; color: white; padding: 18px 40px; border-radius: 12px; text-decoration: none; font-weight: 600; border: none; cursor: pointer; transition: all 0.4s; font-size: 1.1rem; width: 100%; margin-top: 10px;">
                        Submit Request <i class="fas fa-paper-plane" style="margin-left: 8px;"></i>
                    </button>
                </form>
                <div id="rudraFormStatus" style="margin-top: 20px; text-align: center; font-size: 1.1rem; font-weight: 500;"></div>
            </div>

            <script>
            document.getElementById('rudraForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const statusDiv = document.getElementById('rudraFormStatus');
                statusDiv.innerHTML = 'Sending request...';
                statusDiv.style.color = '#666';
                
                try {
                    const formData = new FormData(this);
                    
                    // Combine the custom fields into the message so it reaches the database
                    const gotra = formData.get('gotra');
                    const city = formData.get('city');
                    const address = formData.get('address');
                    const plan = formData.get('plan');
                    
                    const compiledMessage = `Plan: ${plan}\nGotra: ${gotra}\nCity: ${city}\nAddress: ${address}`;
                    formData.set('message', compiledMessage);
                    
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();
                    
                    if(result.status === 'success') {
                        statusDiv.innerHTML = '✅ ' + result.message;
                        statusDiv.style.color = 'green';
                        this.reset();
                    } else {
                        statusDiv.innerHTML = '❌ ' + result.message;
                        statusDiv.style.color = 'red';
                    }
                } catch(err) {
                    statusDiv.innerHTML = '❌ Something went wrong. Please try again.';
                    statusDiv.style.color = 'red';
                }
            });
            
            // Focus styling
            document.querySelectorAll('#rudraForm input, #rudraForm textarea, #rudraForm select').forEach(el => {
                el.addEventListener('focus', () => { el.style.borderColor = '#ff9933'; el.style.background = '#fff'; });
                el.addEventListener('blur', () => { el.style.borderColor = '#eee'; el.style.background = '#fbfbfb'; });
            });
            </script>
        </div>
    </div>
</div>
    <style>
        /* Adjust footer layout since the form section is hidden on this page */
        .footer-info-section {
            border-left: none !important;
            padding-left: 0 !important;
        }
    </style>
    <?php 
    $hide_footer_form = true;
    include __DIR__ . '/../includes/footer.php'; 
    ?>

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
