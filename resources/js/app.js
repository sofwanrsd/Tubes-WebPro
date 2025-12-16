import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Auth slider toggle (only if elements exist)
document.addEventListener('DOMContentLoaded', () => {
  const signUpButton = document.getElementById('signUp');
  const signInButton = document.getElementById('signIn');
  const container = document.getElementById('container');

  if (!signUpButton || !signInButton || !container) return;

  signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));
  signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));
});

document.addEventListener('DOMContentLoaded', () => {
  const goLogin = document.getElementById('goLogin');
  const container = document.getElementById('container');

  if (!goLogin || !container) return;

  goLogin.addEventListener('click', () => {
    container.classList.add('auth-leaving');
    const href = goLogin.dataset.href || '/login';
    setTimeout(() => window.location.href = href, 600);
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const signUpButton = document.getElementById('signUp');
  const signInButton = document.getElementById('signIn');
  const forgotLink = document.getElementById('forgotLink');
  const backLogin = document.getElementById('backLogin');
  const container = document.getElementById('container');

  if (!container) return;

  // register mode
  if (signUpButton) {
    signUpButton.addEventListener('click', () => {
      container.classList.add('right-panel-active');
      container.classList.remove('forgot-panel-active');
    });
  }

  // login mode
  if (signInButton) {
    signInButton.addEventListener('click', () => {
      container.classList.remove('right-panel-active');
      container.classList.remove('forgot-panel-active');
    });
  }

  // forgot mode (no redirect)
  if (forgotLink) {
    forgotLink.addEventListener('click', (e) => {
      e.preventDefault();
      container.classList.remove('right-panel-active');
      container.classList.add('forgot-panel-active');
    });
  }

  // back from forgot
  if (backLogin) {
    backLogin.addEventListener('click', () => {
      container.classList.remove('forgot-panel-active');
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  // enter animation on every page load
  document.documentElement.classList.add('page-enter');
  requestAnimationFrame(() => {
    // next frame: let CSS transition animate into place
    document.documentElement.classList.remove('page-enter');
  });

  const isSameOrigin = (href) => {
    try { return new URL(href, window.location.href).origin === window.location.origin; }
    catch { return false; }
  };

  document.addEventListener('click', (e) => {
    const a = e.target.closest('a');
    if (!a) return;

    const href = a.getAttribute('href') || '';
    const target = a.getAttribute('target');

    // skip cases we shouldn't hijack
    if (!href || href.startsWith('#')) return;
    if (target === '_blank') return;
    if (a.hasAttribute('download')) return;
    if (a.dataset.noTransition === '1') return;
    if (!isSameOrigin(href)) return;

    // allow ctrl/cmd click new tab
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    e.preventDefault();

    // leave animation
    document.body.classList.add('page-leave');

    setTimeout(() => {
      window.location.href = href;
    }, 220);
  });

  // handle back/forward cache (biar gak stuck opacity 0)
  window.addEventListener('pageshow', () => {
    document.body.classList.remove('page-leave');
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  // Capture=true biar gak “ketabrak” handler link transition yang udah ada
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('[data-logout-to-login]');
    if (!btn) return;

    e.preventDefault();
    e.stopPropagation();

    const logoutUrl = btn.dataset.logoutUrl || '/logout';
    const loginUrl  = btn.dataset.loginUrl || '/login';

    try {
      // Logout dulu biar /login gak ke-redirect balik (guest middleware)
      await fetch(logoutUrl, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        credentials: 'same-origin',
      });
    } catch (err) {
      // kalau fetch gagal pun, tetep coba redirect
    }

    window.location.href = loginUrl;
  }, true);
});

// Navbar Drag & Drop (Home / Catalog)
document.addEventListener('DOMContentLoaded', () => {
  const token = document.querySelector('[data-drag-nav-token]');
  const zones = Array.from(document.querySelectorAll('[data-drop-nav]'));
  if (!token || zones.length === 0) return;

  const overClasses = ['ring-2', 'ring-white/25', 'bg-black/20', 'border-white/30'];
  const flashClasses = ['ring-2', 'ring-white/35', 'bg-black/30', 'border-white/40'];

  token.addEventListener('dragstart', (e) => {
    token.classList.add('opacity-80');
    e.dataTransfer?.setData('text/plain', 'nav-token');
  });

  token.addEventListener('dragend', () => {
    token.classList.remove('opacity-80');
    zones.forEach(z => z.classList.remove(...overClasses));
  });

  zones.forEach((z) => {
    z.addEventListener('dragover', (e) => {
      e.preventDefault(); // allow drop
      z.classList.add(...overClasses);
    });

    z.addEventListener('dragleave', () => {
      z.classList.remove(...overClasses);
    });

    z.addEventListener('drop', (e) => {
      e.preventDefault();
      z.classList.remove(...overClasses);

      // flash feedback "berubah"
      z.classList.add(...flashClasses);
      setTimeout(() => z.classList.remove(...flashClasses), 180);

      const url = z.dataset.targetUrl;
      if (url) window.location.href = url;
    });
  });
});



