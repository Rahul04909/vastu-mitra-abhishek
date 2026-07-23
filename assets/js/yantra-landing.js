document.addEventListener('DOMContentLoaded', () => {

  // ===== SCROLL ANIMATIONS (Intersection Observer) =====
  const animateElements = document.querySelectorAll('.fade-in-up');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.15 });

  animateElements.forEach(el => observer.observe(el));

  // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const targetId = anchor.getAttribute('href');
      if (targetId === '#') return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        const headerOffset = 100;
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
      }
    });
  });

  // ===== FAQ ACCORDION =====
  document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const isActive = item.classList.contains('active');

      document.querySelectorAll('.faq-item').forEach(faq => faq.classList.remove('active'));

      if (!isActive) {
        item.classList.add('active');
      }
    });
  });

  // ===== NAVIGATION DOTS (Scroll Spy) =====
  const sections = document.querySelectorAll('.yantra-nav-section');
  const navDots = document.querySelectorAll('.yantra-nav-dot');

  if (navDots.length > 0) {
    const updateActiveDot = () => {
      let current = 0;
      sections.forEach((section, index) => {
        const rect = section.getBoundingClientRect();
        if (rect.top <= 200) {
          current = index;
        }
      });
      navDots.forEach((dot, index) => {
        dot.classList.toggle('active', index === current);
      });
    };

    window.addEventListener('scroll', updateActiveDot);

    navDots.forEach(dot => {
      dot.addEventListener('click', () => {
        const targetId = dot.getAttribute('data-target');
        const target = document.querySelector(targetId);
        if (target) {
          const headerOffset = 100;
          const elementPosition = target.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
          window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
        }
      });
    });
  }

  // ===== ORDER FORM HANDLING =====
  const orderForm = document.getElementById('yantraOrderForm');
  const orderSubmitBtn = document.getElementById('orderSubmitBtn');
  const confirmationOverlay = document.getElementById('orderConfirmation');
  const confirmOrderId = document.getElementById('confirmOrderId');
  const confirmClose = document.getElementById('confirmClose');

  if (orderForm) {
    // Update summary on type/quantity change
    const typeSelect = document.getElementById('yantra_type');
    const qtyInput = document.getElementById('quantity');

    const prices = { Copper: 999, Silver: 2499, Gold: 5999 };

    function updateSummary() {
      const type = typeSelect ? typeSelect.value : 'Copper';
      const qty = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      const price = prices[type] || 999;
      const total = price * qty;

      const typeDisplay = document.getElementById('summary-type');
      const qtyDisplay = document.getElementById('summary-qty');
      const priceDisplay = document.getElementById('summary-price');
      const totalDisplay = document.getElementById('summary-total');

      if (typeDisplay) typeDisplay.textContent = type;
      if (qtyDisplay) qtyDisplay.textContent = 'x' + qty;
      if (priceDisplay) priceDisplay.textContent = '\u20B9' + price.toLocaleString();
      if (totalDisplay) totalDisplay.textContent = '\u20B9' + total.toLocaleString();
    }

    if (typeSelect) typeSelect.addEventListener('change', updateSummary);
    if (qtyInput) qtyInput.addEventListener('input', updateSummary);
    updateSummary();

    // Form submission
    orderForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const formData = new FormData(orderForm);

      orderSubmitBtn.disabled = true;
      orderSubmitBtn.innerHTML = '<span class="spinner"></span> Processing...';

      fetch('order_handler.php', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            if (confirmOrderId) confirmOrderId.textContent = '#YANTRA-' + data.order_id;
            if (confirmationOverlay) confirmationOverlay.classList.add('active');
            orderForm.reset();
            updateSummary();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Order Failed',
              text: data.message || 'Something went wrong. Please try again.',
              confirmButtonColor: '#d33'
            });
          }
        })
        .catch(err => {
          console.error('Error:', err);
          Swal.fire({
            icon: 'error',
            title: 'Connection Error',
            text: 'Unable to reach the server. Please check your internet and try again.',
            confirmButtonColor: '#d33'
          });
        })
        .finally(() => {
          orderSubmitBtn.disabled = false;
          orderSubmitBtn.innerHTML = '<i class="fas fa-lock"></i> Place Order Now';
        });
    });
  }

  // ===== CONFIRMATION MODAL CLOSE =====
  if (confirmClose) {
    confirmClose.addEventListener('click', () => {
      if (confirmationOverlay) confirmationOverlay.classList.remove('active');
    });
  }

  if (confirmationOverlay) {
    confirmationOverlay.addEventListener('click', (e) => {
      if (e.target === confirmationOverlay) {
        confirmationOverlay.classList.remove('active');
      }
    });
  }

  // ===== COUNTER TIMER (Urgency Bar) =====
  function startTimer(duration, display) {
    let timer = duration;
    const interval = setInterval(() => {
      const hours = Math.floor(timer / 3600);
      const minutes = Math.floor((timer % 3600) / 60);
      const seconds = timer % 60;

      const hrEl = document.getElementById('timer-hours');
      const minEl = document.getElementById('timer-minutes');
      const secEl = document.getElementById('timer-seconds');

      if (hrEl) hrEl.textContent = String(hours).padStart(2, '0');
      if (minEl) minEl.textContent = String(minutes).padStart(2, '0');
      if (secEl) secEl.textContent = String(seconds).padStart(2, '0');

      if (--timer < 0) {
        clearInterval(interval);
        // Reset timer
        startTimer(duration, display);
      }
    }, 1000);
  }

  const timerDisplay = document.getElementById('urgency-timer');
  if (timerDisplay) {
    startTimer(7200, timerDisplay); // 2 hours
  }
});
