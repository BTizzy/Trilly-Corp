/**
 * Trilly Co — main.js  v2.0.0
 * Theme toggle · Mobile menu · Reveal animations · Audience routing · Contact form
 */

(function () {
  'use strict';

  /* ── helpers ────────────────────────────────── */
  const $ = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

  /* ═══════════════════════════════════════════
     THEME TOGGLE
     ═══════════════════════════════════════════ */
  const html  = document.documentElement;
  const themeBtn = $('[data-theme-toggle]');
  const DARK_SVG = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`;
  const LIGHT_SVG = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`;

  function applyTheme(t) {
    html.setAttribute('data-theme', t);
    localStorage.setItem('trillyco-theme', t);
    if (themeBtn) {
      themeBtn.innerHTML = t === 'dark' ? DARK_SVG : LIGHT_SVG;
      themeBtn.setAttribute('aria-label', t === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
    }
  }

  // Restore saved theme
  const saved = localStorage.getItem('trillyco-theme');
  const sys   = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  applyTheme(saved || sys);

  if (themeBtn) {
    themeBtn.addEventListener('click', () => {
      applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
    });
  }

  /* ═══════════════════════════════════════════
     MOBILE MENU
     ═══════════════════════════════════════════ */
  const menuBtn    = $('[data-menu-toggle]');
  const mobileMenu = $('#mobile-menu');
  const OPEN_SVG   = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>`;
  const CLOSE_SVG  = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>`;

  if (menuBtn && mobileMenu) {
    let isOpen = false;

    function setMenu(open) {
      isOpen = open;
      mobileMenu.classList.toggle('open', open);
      mobileMenu.setAttribute('aria-hidden', String(!open));
      menuBtn.setAttribute('aria-expanded', String(open));
      menuBtn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      menuBtn.innerHTML   = open ? OPEN_SVG : CLOSE_SVG;
    }

    menuBtn.addEventListener('click', () => setMenu(!isOpen));

    // Close on link click
    $$('a', mobileMenu).forEach(a => {
      a.addEventListener('click', () => setMenu(false));
    });

    // Close on outside click
    document.addEventListener('click', e => {
      if (isOpen && !e.target.closest('.site-nav')) setMenu(false);
    });

    // Close on Escape
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && isOpen) setMenu(false);
    });
  }

  /* ═══════════════════════════════════════════
     SCROLL REVEAL
     ═══════════════════════════════════════════ */
  const reveals = $$('.reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('in');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(el => io.observe(el));
  } else {
    reveals.forEach(el => el.classList.add('in'));
  }

  /* ═══════════════════════════════════════════
     AUDIENCE ROUTING
     Routes CTA clicks → pre-selects form dropdown
     Also stores value for HubSpot hidden field
     ═══════════════════════════════════════════ */
  const audienceHidden = $('#audienceHidden');
  const audienceSelect = $('#audienceSelect');
  const formAudienceTag = $('#formAudienceTag');
  const AUDIENCE_LABELS = {
    'small-business': { label: '🏪 Small business inquiry', cls: 'smb'     },
    'startup':        { label: '🚀 Startup inquiry',        cls: 'startup' },
    'general':        { label: '',                           cls: ''        },
  };

  function setAudience(val) {
    if (!val || val === 'general') return;
    if (audienceHidden) audienceHidden.value = val;
    if (audienceSelect) audienceSelect.value = val;
    if (formAudienceTag) {
      const info = AUDIENCE_LABELS[val];
      if (info && info.label) {
        formAudienceTag.textContent = info.label;
        formAudienceTag.className = `form-audience-tag visible ${info.cls}`;
      } else {
        formAudienceTag.className = 'form-audience-tag';
      }
    }
    // Persist so it survives scroll
    sessionStorage.setItem('trillyco-audience', val);
  }

  // Pick up any saved audience from session
  const savedAudience = sessionStorage.getItem('trillyco-audience');
  if (savedAudience) setAudience(savedAudience);

  // All CTA links with data-route-audience
  $$('[data-route-audience]').forEach(el => {
    el.addEventListener('click', () => {
      const v = el.getAttribute('data-route-audience');
      if (v) setAudience(v);
    });
  });

  // Keep hidden field in sync when user changes dropdown
  if (audienceSelect && audienceHidden) {
    audienceSelect.addEventListener('change', () => {
      setAudience(audienceSelect.value);
    });
  }

  /* ═══════════════════════════════════════════
     CONTACT FORM SUBMISSION
     Submits via WP AJAX → PHP handler
     which can forward to HubSpot.
     ═══════════════════════════════════════════ */
  const form       = $('#contact-form');
  const formStatus = $('#formStatus');
  const formSubmit = $('#formSubmit');

  if (form) {
    form.addEventListener('submit', async e => {
      e.preventDefault();

      // Basic validation
      const name  = form.elements['name']?.value.trim();
      const email = form.elements['email']?.value.trim();
      if (!name || !email) {
        showStatus('Please enter your name and email.', 'error');
        return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showStatus('Please enter a valid email address.', 'error');
        return;
      }

      formSubmit.disabled = true;
      formSubmit.textContent = 'Sending…';
      if (formStatus) formStatus.textContent = '';

      try {
        const body = new FormData(form);
        body.set('action', 'trillyco_contact');

        // Use WP AJAX if available (WordPress context)
        const endpoint = (typeof trillycoData !== 'undefined')
          ? trillycoData.ajaxUrl
          : '/wp-admin/admin-ajax.php';

        if (typeof trillycoData !== 'undefined') {
          body.set('nonce', trillycoData.nonce);
        }

        const res  = await fetch(endpoint, { method: 'POST', body });
        const json = await res.json();

        if (json.success) {
          showStatus(json.data?.message || 'Message sent — we\'ll be in touch shortly.', 'success');
          form.reset();
          if (audienceHidden) audienceHidden.value = 'general';
          if (formAudienceTag) formAudienceTag.className = 'form-audience-tag';
          // Clear session audience so next visit starts fresh
          sessionStorage.removeItem('trillyco-audience');
          // Fire HubSpot analytics event if available
          if (window._hsq) {
            window._hsq.push(['trackEvent', { id: 'Contact Form Submission', value: json.data?.audience || 'general' }]);
          }
        } else {
          showStatus(json.data?.message || 'Something went wrong — please try again or email us directly.', 'error');
        }
      } catch (_) {
        showStatus('Could not send — please email info@trillycorp.com directly.', 'error');
      } finally {
        formSubmit.disabled = false;
        formSubmit.textContent = 'Send inquiry';
      }
    });
  }

  function showStatus(msg, type) {
    if (!formStatus) return;
    formStatus.textContent = msg;
    formStatus.style.color = type === 'error' ? 'var(--smb)' : 'var(--accent)';
  }

  /* ═══════════════════════════════════════════
     AUDIENCE CARD HIGHLIGHT (desktop hover)
     ═══════════════════════════════════════════ */
  $$('[data-audience-card]').forEach(card => {
    card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-3px)');
    card.addEventListener('mouseleave', () => card.style.transform = '');
  });

})();
