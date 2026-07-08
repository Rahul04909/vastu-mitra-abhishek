<div class="newsletter-overlay" id="newsletterOverlay">
    <div class="newsletter-modal">
        <button class="newsletter-close" id="newsletterClose" aria-label="Close">&times;</button>

        <div class="newsletter-image-col">
            <img src="<?= BASE_URL ?>/assets/images/newsletter.png" alt="Vastu Mitra Abhishek" loading="lazy">
            <div class="image-overlay-text">
                <h3></h3>
                <p></p>
            </div>
        </div>

        <div class="newsletter-form-col">
            <div class="form-header">
                <h2>Subscribe to Newsletter</h2>
                <p>Get Vastu tips &amp; exclusive offers straight to your inbox</p>
            </div>

            <form class="newsletter-form" id="newsletterForm" novalidate data-base-url="<?= BASE_URL ?>">
                <input type="text" name="name" placeholder="Your Name *" required>
                <input type="email" name="email" placeholder="Your Email *" required>
                <input type="tel" name="mobile" placeholder="Mobile Number">
                <input type="text" name="city" placeholder="City">
                <input type="text" name="gotra" placeholder="Gotra">
                <select name="num_persons">
                    <option value="">Number of Persons</option>
                    <?php for ($i = 1; $i <= 15; $i++): ?>
                    <option value="<?= $i ?>"><?= $i . ' ' . ($i === 1 ? 'Person' : 'Persons') ?></option>
                    <?php endfor; ?>
                </select>

                <div class="newsletter-response" id="newsletterResponse"></div>

                <button type="submit" class="newsletter-submit-btn" id="newsletterSubmitBtn">
                    Subscribe Now
                </button>
            </form>
        </div>
    </div>
</div>
