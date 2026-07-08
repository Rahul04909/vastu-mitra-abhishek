(function () {
    'use strict';

    var overlay = document.getElementById('newsletterOverlay');
    var closeBtn = document.getElementById('newsletterClose');
    var form = document.getElementById('newsletterForm');
    var submitBtn = document.getElementById('newsletterSubmitBtn');
    var responseDiv = document.getElementById('newsletterResponse');
    var shownThisSession = sessionStorage.getItem('newsletterShown');

    function openPopup() {
        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closePopup() {
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        sessionStorage.setItem('newsletterShown', '1');
    }

    if (!shownThisSession && overlay) {
        setTimeout(openPopup, 3000);
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closePopup);
    }

    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closePopup();
            }
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay && overlay.classList.contains('active')) {
            closePopup();
        }
    });

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var name = form.querySelector('[name="name"]');
            var email = form.querySelector('[name="email"]');

            var inputs = form.querySelectorAll('input, select');
            inputs.forEach(function (el) { el.classList.remove('error'); });

            var valid = true;
            if (!name.value.trim()) {
                name.classList.add('error');
                valid = false;
            }
            if (!email.value.trim() || !/\S+@\S+\.\S+/.test(email.value)) {
                email.classList.add('error');
                valid = false;
            }
            if (!valid) return;

            var baseUrl = form.getAttribute('data-base-url') || '';
            var formData = new FormData(form);
            formData.append('newsletter_submit', '1');

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';

            fetch(baseUrl + '/newsletter_handler.php', {
                method: 'POST',
                body: formData
            })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    responseDiv.className = 'newsletter-response ' + (data.status === 'success' ? 'success' : 'error');
                    responseDiv.textContent = data.message;

                    if (data.status === 'success') {
                        form.reset();
                        setTimeout(function () {
                            closePopup();
                        }, 2000);
                    }
                })
                .catch(function () {
                    responseDiv.className = 'newsletter-response error';
                    responseDiv.textContent = 'An unexpected error occurred. Please try again.';
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Subscribe Now';
                });
        });
    }
})();
