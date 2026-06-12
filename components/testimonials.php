<?php
$testimonials = [
    [
        'name' => 'Mumkshu Shublaya',
        'role' => 'client',
        'content' => 'Vastu Mitra Abhishek changed the energy of my office completely. Within 3 months, our footfall increased by 40%. His scientific approach is truly impressive.',
        'image' => 'assets/testimonial-1.jpeg'
    ],
    [
        'name' => 'Priya Verma',
        'role' => 'IT Professional, Bangalore',
        'content' => 'I was facing continuous health issues in my new apartment. Abhishek identified the kitchen dosha and suggested simple remedies. I feel much better now!',
        'image' => 'assets/testimonial-2.jpeg'
    ],
    [
        'name' => 'Amit Khanna',
        'role' => 'Industrialist, Mumbai',
        'content' => 'The Industrial Vastu consultation was eye-opening. We optimized our machine placement as per his advice, and the production efficiency has improved significantly.',
        'image' => 'assets/testimonial-3.jpeg'
    ],
    [
        'name' => 'Sneha Gupta',
        'role' => 'Home Maker, Jaipur',
        'content' => 'Very professional and polite. He explains everything logically. Our family life has become much more harmonious after following his Vastu tips.',
        'image' => 'assets/testimonial-4.jpeg'
    ],
    [
        'name' => 'Vikram Singh',
        'role' => 'Real Estate Developer, Gurgaon',
        'content' => 'I always consult Abhishek before starting any new project. His guidance on site planning is invaluable for the success of my buildings.',
        'image' => 'assets/images/testimonials/male_3.png'
    ],
    [
        'name' => 'Anjali Desai',
        'role' => 'Doctor, Pune',
        'content' => 'Scientific Vastu is real! Abhishek proved it with his precise calculations. Highly recommended for anyone looking for authentic Vastu solutions.',
        'image' => 'assets/images/testimonials/female_3.png'
    ],
    [
        'name' => 'Sandeep Reddy',
        'role' => 'Software Engineer, Hyderabad',
        'content' => 'Amazing experience. He didn\'t ask for major structural changes, just simple yet powerful remedies. My career growth has been phenomenal since then.',
        'image' => 'assets/images/testimonials/male_4.png'
    ],
    [
        'name' => 'Meera Nair',
        'role' => 'Interior Designer, Kochi',
        'content' => 'I collaborate with Abhishek for my clients. His ability to blend Vastu with modern aesthetics is what makes him the best in the field.',
        'image' => 'assets/images/testimonials/female_4.png'
    ],
    [
        'name' => 'Rohan Mehta',
        'role' => 'Shop Owner, Ahmedabad',
        'content' => 'Commercial Vastu works! My shop was struggling for 2 years. After Abhishek\'s visit and corrections, business is booming. Thank you, sir!',
        'image' => 'assets/images/testimonials/male_5.png'
    ],
    [
        'name' => 'Kavita Joshi',
        'role' => 'Teacher, Lucknow',
        'content' => 'Deeply satisfied with the Personal Vastu consultation. It helped me clear my mental blocks and brought peace to my living space.',
        'image' => 'assets/images/testimonials/female_5.png'
    ],
    [
        'name' => 'Arun Goel',
        'role' => 'CEO, Tech Startup, Noida',
        'content' => 'Vastu Mitra Abhishek is a genius. His scientific reasoning behind every Vastu principle convinced me to try his services, and the results are proof.',
        'image' => 'assets/images/testimonials/male_6.png'
    ],
    [
        'name' => 'Pooja Kapoor',
        'role' => 'Fashion Designer, Chandigarh',
        'content' => 'The positive vibes in my studio are now palpable. Abhishek\'s expertise is unmatched. Highly professional and result-oriented!',
        'image' => 'assets/images/testimonials/female_6.png'
    ]
];

shuffle($testimonials);
?>

<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">What Our <span>Customers</span> Say</h2>
            <p class="section-subtitle">Don't just take our word for it—read what our satisfied clients have to experience after our Vastu consultation.</p>
        </div>

        <div class="swiper testimonials-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $t): ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="<?= $t['image'] ?>" alt="<?= $t['name'] ?>">
                        </div>
                        <span class="quote-icon quote-left"><i class="fas fa-quote-left"></i></span>
                        <span class="quote-icon quote-right"><i class="fas fa-quote-right"></i></span>
                        
                        <div class="testimonial-content">
                            <p>"<?= $t['content'] ?>"</p>
                        </div>
                        
                        <div class="testimonial-info">
                            <h3><?= $t['name'] ?></h3>
                            <p><?= $t['role'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="google-reviews-widget">
            <a href="https://www.google.com/search?sca_esv=43340ab55d5d8314&sxsrf=ANbL-n6948n98Jl6JxG_q3PFr343uoVwgg:1776931123066&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOQaWzM-xnbYX_VORxZ1pDmVSkQiABo2_4eyVOEdwyTT9OhFnZ8pI3dGZxCLJrrWQG4GSAa8dG67N5yx6q8mnFxq3TUVSKPgh1V2f4MIr9lSpkoFivA%3D%3D&q=Vastu+Mitra+Abhishek+Reviews&sa=X&ved=2ahUKEwjgq4WjwIOUAxUB2TgGHYPkLc8Q0bkNegQILxAH&biw=1280&bih=665&dpr=2" target="_blank" class="google-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" alt="Google Logo">
                <span>Write a Google Review</span>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.testimonials-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            }
        }
    });
});
</script>
