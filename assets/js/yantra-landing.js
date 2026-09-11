document.addEventListener('DOMContentLoaded', () => {

  // ── Scroll Animations ──
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  // ── Floating Nav ──
  const nav = document.querySelector('.floating-nav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  });

  // ── Smooth Scroll ──
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      if (id === '#') return;
      const t = document.querySelector(id);
      if (t) {
        e.preventDefault();
        const top = t.getBoundingClientRect().top + window.pageYOffset - 80;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ── FAQ Accordion ──
  document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const wasOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
      if (!wasOpen) item.classList.add('open');
    });
  });

  // ── Order Summary ──
  const typeEl = document.getElementById('yantra_type');
  const qtyEl = document.getElementById('quantity');
  const prices = { Copper: 999, Silver: 2499, Gold: 5999 };

  function updateSummary() {
    const type = typeEl ? typeEl.value : 'Copper';
    const qty = Math.max(1, parseInt(qtyEl?.value) || 1);
    const total = (prices[type] || 999) * qty;

    const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
    set('s-type', type);
    set('s-qty', 'x' + qty);
    set('s-price', '\u20B9' + (prices[type] || 999).toLocaleString());
    set('s-total', '\u20B9' + total.toLocaleString());
  }

  if (typeEl) typeEl.addEventListener('change', updateSummary);
  if (qtyEl) qtyEl.addEventListener('input', updateSummary);
  updateSummary();

  // ── Order Submit ──
  const form = document.getElementById('yantraOrderForm');
  const submitBtn = document.getElementById('orderSubmitBtn');
  const modal = document.getElementById('orderConfirmation');
  const orderIdEl = document.getElementById('confirmOrderId');
  const closeModal = document.getElementById('confirmClose');

  if (form) {
    form.addEventListener('submit', e => {
      e.preventDefault();

      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner"></span> Processing...';

      fetch('order_handler.php', { method: 'POST', body: new FormData(form) })
        .then(r => r.json())
        .then(d => {
          if (d.status === 'success') {
            if (orderIdEl) orderIdEl.textContent = '#YANTRA-' + d.order_id;
            if (modal) modal.classList.add('active');
            form.reset();
            updateSummary();
          } else {
            Swal.fire({ icon: 'error', title: 'Order Failed', text: d.message, confirmButtonColor: '#d33' });
          }
        })
        .catch(() => {
          Swal.fire({ icon: 'error', title: 'Connection Error', text: 'Please check your internet and try again.', confirmButtonColor: '#d33' });
        })
        .finally(() => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<i class="fas fa-lock"></i> Place Order Now';
        });
    });
  }

  if (closeModal) closeModal.addEventListener('click', () => { if (modal) modal.classList.remove('active'); });
  if (modal) modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('active'); });

  // ── Urgency Timer ──
  (function startTimer(duration) {
    let t = duration;
    setInterval(() => {
      const h = Math.floor(t / 3600);
      const m = Math.floor((t % 3600) / 60);
      const s = t % 60;
      const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = String(v).padStart(2, '0'); };
      set('th', h); set('tm', m); set('ts', s);
      if (--t < 0) t = duration;
    }, 1000);
  })(7200);
});
