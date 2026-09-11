<?php
// PHP Fallback for non-AJAX submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['footer_enquiry_submit'])) {
    require_once __DIR__ . '/../enquiry_handler.php';
    // The handler will return JSON, but for standard POST we might want to stay on the page.
    // However, the AJAX script below is the preferred method.
}
?>
<footer class="footer">
    <div class="footer-logo-container">
        <!-- <div class="footer-logo">
            <img src="<?= BASE_URL ?>/assets/logo/logo.png" alt="AppliedVastu Logo">
        </div> -->
    </div>

    <div class="container footer-content">
        <!-- Left Section: Guidance Form -->
        <div class="footer-form-section">
            <h3>Get Vastu Mitra Guidance</h3>
            <form action="#" method="POST" class="guidance-form">
                <div class="form-row">
                    <input type="text" name="name" placeholder="Enter your name*" required>
                    <input type="email" name="email" placeholder="Enter your e-mail*" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="mobile" placeholder="Enter your mobile or what's a">
                    <select name="country">
                        <option value="">--Select your country*--</option>
                        <option value="India">India</option>
                        <!-- <option value="USA">USA</option>
                        <option value="UK">UK</option> -->
                    </select>
                </div>
                <div class="form-row full-width">
                    <select name="service_type_select">
                        <option value="">--Select Vastu Consultancy Type--</option>
                        <option value="Residential">Residential Vastu</option>
                        <option value="Commercial">Commercial Vastu</option>
                        <option value="Industrial">Industrial Vastu</option>
                        <option value="Personalized Vastu">Personalized Vastu</option>
                    </select>
                </div>
                <div class="form-row full-width file-input">
                    <label for="file-upload">Choose file</label>
                    <input type="file" id="file-upload" name="attachment">
                    <span id="file-name">No file chosen</span>
                </div>
                <p class="file-info">Max upload size 10MB (.jpeg, .jpg, .png, .pdf, .dwg only)</p>

                <div class="service-type-radios">
                    <span>Service Type</span>
                    <label><input type="radio" name="service_mode" value="Online" checked> Online Service</label>
                    <label><input type="radio" name="service_mode" value="Onsite"> Onsite Service</label>
                </div>

                <textarea name="message" placeholder="Enter Message Here"></textarea>

                <div id="enquiry-response" style="margin-bottom: 20px; display: none;"></div>

                <button type="submit" class="footer-submit-btn" id="footer-submit-btn">Submit</button>
            </form>
        </div>

        <!-- Right Section: Info & Links -->
        <div class="footer-info-section">
            <div class="info-group">
                <h3>Online Vastu Consultancy</h3>
                <p>We realize that finding a good <strong>Vastu consultant</strong> online is very difficult. That is
                    why Vastu Mitra Abhishek decides to offer world-class accurate online Vastu consultancy services. It
                    is straightforward for anyone to take our online Vastu consultancy services wherever they are in the
                    world. <a href="#">Read More</a></p>
            </div>

            <div class="footer-links-grid">
                <div class="links-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?= BASE_URL ?>/index.php">Home</a></li>
                        <li><a href="<?= BASE_URL ?>/about.php">About Us</a></li>
                        <li><a href="<?= BASE_URL ?>/services.php">Vastu Plan</a></li>
                        <li><a href="<?= BASE_URL ?>/blog.php">Blog</a></li>
                        <li><a href="<?= BASE_URL ?>/contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="links-column">
                    <h4>Important Links</h4>
                    <ul>
                        <li><a href="<?= BASE_URL ?>/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="<?= BASE_URL ?>/refund-policy.php">Refund Policy</a></li>
                        <li><a href="<?= BASE_URL ?>/terms-and-conditions.php">Terms and Condition</a></li>
                        <li><a href="<?= BASE_URL ?>/payment-details.php">Payment Details</a></li>
                        <li><a href="<?= BASE_URL ?>/disclaimer.php">Disclaimer</a></li>
                    </ul>
                </div>
                <div class="links-column">
                    <h4>Our Service</h4>
                    <ul>
                        <li><a href="<?= BASE_URL ?>/pages/residential-vastu.php">Residential Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/commercial-vastu.php">Commercial Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/industrial-vastu.php">Industrial Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/personal-vastu.php">Personal Vastu</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/vastu-logo-design.php">Vastu Logo Design</a></li>
                        <!-- <li><a href="#">Astro Vastu</a></li>
                        <li><a href="#">Vastu Planning & Design</a></li>
                        <li><a href="#">Vastu Consultant</a></li> -->
                    </ul>
                </div>
                <div class="links-column contact-details">
                    <h4>Vastu Mitra Abhishek</h4>
                    <p><strong>Registered Office address:</strong> B-119, First Floor, Main, Mall Rd, Greenfield Colony,
                        Sector 41, Faridabad, Haryana 121010</p>
                    <!-- <p><strong>GST NUMBER:</strong> 19COIPD3746Q1ZA</p> -->
                    <p><strong>Call:</strong> +91-9971799858 & +91-9971799858</p>
                    <p><strong>Email:</strong> info@vastumitraabhishek.in</p>
                </div>
            </div>

            <div class="footer-badges">
                <div class="badge-google">
                    <span>4.9 ★★★★★</span>
                    <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                        alt="Google" style="height: 20px;">
                </div>
                <img src="https://images.dmca.com/Badges/dmca_protected_sml_120l.png?ID=1a2b3c4d" alt="DMCA">
                <div class="app-links">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="App Store">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        alt="Google Play">
                </div>
            </div>
        </div>
    </div>

    <!-- Social & Copyright Section -->
    <div class="footer-bottom">
        <div class="social-icons">
            <a href="https://www.facebook.com/VastuMitraAbhishek" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/vastu_mitra_abhishek/" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"></a>
            <a href="https://in.linkedin.com/in/vastumitraabhishek" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/145/145807.png" alt="LinkedIn"></a>
            <!-- <a href="https://twitter.com" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/3256/3256013.png" alt="X"></a> -->
            <a href="https://youtu.be/Lb1re-Balng?si=cYGCWxJ6NVHaiqva" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube"></a>
            <!-- <a href="https://pinterest.com" target="_blank"><img
                    src="https://cdn-icons-png.flaticon.com/512/145/145808.png" alt="Pinterest"></a> -->
        </div>
        <div class="copyright">
            <p>(C) Copyright 2019-2026, All Rights Reserved. A Website Powered By <a href="https://www.mineib.com"
                    target="_blank" class="mineib-link">Mineib Creative Technology</a></p>
        </div>
    </div>
</footer>

<script>
    document.querySelector('.guidance-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const btn = document.getElementById('footer-submit-btn');
        const responseDiv = document.getElementById('enquiry-response');
        const formData = new FormData(form);
        formData.append('footer_enquiry_submit', '1');

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

        // Ensure accurate path to enquiry_handler.php relative to the current page
        // Since footer is included, BASE_URL is the safest bet
        fetch('<?= BASE_URL ?>/enquiry_handler.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                responseDiv.style.display = 'block';
                responseDiv.className = 'alert ' + (data.status === 'success' ? 'alert-success' : 'alert-danger');
                responseDiv.innerHTML = data.message;
                responseDiv.style.padding = '15px';
                responseDiv.style.borderRadius = '5px';
                responseDiv.style.marginBottom = '20px';
                responseDiv.style.color = 'white';
                responseDiv.style.backgroundColor = data.status === 'success' ? '#28a745' : '#dc3545';

                if (data.status === 'success') {
                    form.reset();
                    document.getElementById('file-name').innerText = 'No file chosen';
                    // Optional: hide message after 5 seconds
                    setTimeout(() => { responseDiv.style.display = 'none'; }, 5000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseDiv.style.display = 'block';
                responseDiv.style.color = 'white';
                responseDiv.style.backgroundColor = '#dc3545';
                responseDiv.style.padding = '15px';
                responseDiv.style.borderRadius = '5px';
                responseDiv.innerHTML = 'An unexpected error occurred. Please try again.';
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Submit';
            });
    });

    // File name display enhancement
    const fileInput = document.getElementById('file-upload');
    if (fileInput) {
        fileInput.addEventListener('change', function () {
            var fileName = this.files[0] ? this.files[0].name : "No file chosen";
            const fileNameDisplay = document.getElementById('file-name');
            if (fileNameDisplay) fileNameDisplay.innerText = fileName;
        });
    }
</script>