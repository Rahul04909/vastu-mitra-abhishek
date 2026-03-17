<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Contact Us - Vastu Mitra Abhishek | Get Expert Vastu Consultation";
$meta_desc = "Get in touch with Vastu Mitra Abhishek for expert Vastu Shastra consultation. Visit our Faridabad office or connect online for residential, commercial, and industrial Vastu solutions.";
$meta_keywords = "contact vastu mitra abhishek, vastu consultant faridabad, vastu consultation online, vastu office address, vastu contact number";
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/contact.css">
    
    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions about Vastu? We're here to help you harmonize your living and workspaces for success and peace.</p>
        </div>
    </section>

    <!-- Contact Info & Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info-cards">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="info-details">
                            <h3>Our Office</h3>
                            <p>B-119, First Floor, Main, Mall Rd, Greenfield Colony, Sector 41, Faridabad, Haryana 121010</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-phone-volume"></i></div>
                        <div class="info-details">
                            <h3>Call Us</h3>
                            <p><a href="tel:+919971799858">+91-9971799858</a></p>
                            <p><a href="tel:+917428284357">+91-7428284357</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-envelope-open-text"></i></div>
                        <div class="info-details">
                            <h3>Email Us</h3>
                            <p><a href="mailto:info@vastumitraabhishek.in">info@vastumitraabhishek.in</a></p>
                            <p><a href="mailto:vastumabhishek@gmail.com">vastumabhishek@gmail.com</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-clock"></i></div>
                        <div class="info-details">
                            <h3>Working Hours</h3>
                            <p>Mon - Sat: 10:00 AM - 7:00 PM</p>
                            <p>Sunday: Closed</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <form action="#" method="POST" id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name*</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address*</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject" class="form-control">
                                <option value="General Enquiry">General Enquiry</option>
                                <option value="Residential Vastu">Residential Vastu</option>
                                <option value="Commercial Vastu">Commercial Vastu</option>
                                <option value="Industrial Vastu">Industrial Vastu</option>
                                <option value="Logo Design">Logo Design</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message*</label>
                            <textarea id="message" name="message" class="form-control" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Send Message <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112313.16016666874!2d77.243555!3d28.420455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cd99f1933f38d%3A0x423986a455f560e1!2sVastu%20Mitra%20Abhishek!5e0!3m2!1sen!2sin!4v1710662400000!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        // Form Submission Handling (Optional/Placeholder)
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            // e.preventDefault();
            // alert('Thank you for contacting us! We will get back to you soon.');
        });
    </script>
</body>
</html>
