<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Expert Vastu Services</h2>
            <p class="section-subtitle">Comprehensive Vastu solutions tailored for your growth, prosperity, and peace of mind.</p>
        </div>

        <!-- Swiper -->
        <div class="swiper services-swiper">
            <div class="swiper-wrapper">
                <!-- Residential Vastu -->
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="assets/images/residential-vastu.jpg" alt="Residential Vastu">
                            <div class="service-overlay">
                                <a href="pages/residential-vastu.php" class="service-btn">Enquire Now</a>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3>Residential Vastu</h3>
                            <p>Harmonize your home environment to invite health, wealth, and happiness for your family.</p>
                            <a href="pages/residential-vastu.php" class="service-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Commercial Vastu -->
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="assets/images/commercial-vastu.jpg" alt="Commercial Vastu">
                            <div class="service-overlay">
                                <a href="pages/commercial-vastu.php" class="service-btn">Enquire Now</a>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3>Commercial Vastu</h3>
                            <p>Expert guidance for shops and showrooms to ensure business growth and customer footfall.</p>
                            <a href="pages/commercial-vastu.php" class="service-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Industrial Vastu -->
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="assets/images/industrial-vastu.jpg" alt="Industrial Vastu">
                            <div class="service-overlay">
                                <a href="pages/industrial-vastu.php" class="service-btn">Enquire Now</a>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3>Industrial Vastu</h3>
                            <p>Optimizing energy flow in factories and plants to improve production and reduce losses.</p>
                            <a href="pages/industrial-vastu.php" class="service-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Personal Vastu -->
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="assets/images/personal-vastu.jpg" alt="Personal Vastu">
                            <div class="service-overlay">
                                <a href="pages/personal-vastu.php" class="service-btn">Enquire Now</a>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3>Personal Vastu</h3>
                            <p>Individualized Vastu consultation to align your personal space with your unique destiny.</p>
                            <a href="pages/personal-vastu.php" class="service-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Vastu Logo Design -->
                <div class="swiper-slide">
                    <div class="service-card">
                        <div class="service-image">
                            <img src="assets/images/service-logo-design.jpg" alt="Vastu Logo Design">
                            <div class="service-overlay">
                                <a href="pages/vastu-logo-design.php" class="service-btn">Enquire Now</a>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3>Vastu Logo Design</h3>
                            <p>Unlock business prosperity with a scientifically designed Vastu Logo that aligns with your energy.</p>
                            <a href="pages/vastu-logo-design.php" class="service-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination if needed -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Swiper Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.services-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
            loop: true,
        });
    });
</script>
