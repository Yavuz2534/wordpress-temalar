/**
 * AquaPro front-end behaviour.
 *
 * Vanilla ES module — zero dependencies. Each feature is a small init function
 * guarded by feature detection, so a missing section never throws.
 *
 * @package AquaPro
 */

const data = window.AquaProData || {};

/* ---------- Mobile menu ---------- */
function initBurger() {
  const burger = document.querySelector('[data-aqua-burger]');
  const panel = document.getElementById('aqua-mobile');
  if (!burger || !panel) return;
  burger.addEventListener('click', () => {
    const open = burger.getAttribute('aria-expanded') === 'true';
    burger.setAttribute('aria-expanded', String(!open));
    panel.hidden = open;
  });
}

/* ---------- Dark mode toggle ---------- */
function initDarkToggle() {
  const btn = document.querySelector('[data-aqua-darktoggle]');
  if (!btn) return;
  const stored = localStorage.getItem('aquaTheme');
  if (stored) document.documentElement.setAttribute('data-theme', stored);
  btn.addEventListener('click', () => {
    const next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('aquaTheme', next);
  });
}

/* ---------- Sticky header shadow on scroll ---------- */
function initStickyShadow() {
  const header = document.querySelector('.aqua-header[data-sticky="1"]');
  if (!header) return;
  const onScroll = () => header.classList.toggle('is-stuck', window.scrollY > 8);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
}

/* ---------- Reviews carousel ---------- */
function initCarousel() {
  document.querySelectorAll('[data-aqua-carousel]').forEach((root) => {
    const track = root.querySelector('[data-aqua-track]');
    const prev = root.querySelector('[data-aqua-prev]');
    const next = root.querySelector('[data-aqua-next]');
    if (!track) return;
    const step = () => track.querySelector('.aqua-review')?.offsetWidth + 24 || 320;
    prev?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
    next?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
  });
}

/* ---------- Before / After slider ---------- */
function initBeforeAfter() {
  document.querySelectorAll('[data-aqua-ba]').forEach((root) => {
    const before = root.querySelector('[data-aqua-ba-before]');
    const range = root.querySelector('[data-aqua-ba-range]');
    const handle = root.querySelector('[data-aqua-ba-handle]');
    if (!before || !range) return;
    const apply = (v) => {
      before.style.width = v + '%';
      if (handle) handle.style.left = v + '%';
    };
    range.addEventListener('input', () => apply(range.value));
    apply(range.value);
  });
}

/* ---------- AJAX lead form ---------- */
function initForms() {
  document.querySelectorAll('[data-aqua-form]').forEach((form) => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const status = form.querySelector('[data-aqua-status]');
      const submit = form.querySelector('[data-aqua-submit]');
      const setStatus = (msg, ok) => {
        if (!status) return;
        status.textContent = msg;
        status.className = 'aqua-form__status ' + (ok ? 'is-ok' : 'is-error');
      };
      if (status) setStatus(data.i18n?.sending || 'Sending…', true);
      if (submit) submit.disabled = true;

      try {
        const body = new FormData(form);
        body.append('action', 'aquapro_contact');
        body.append('nonce', data.contactNonce || '');
        const res = await fetch(data.ajaxUrl, { method: 'POST', body });
        const json = await res.json();
        if (json.success) {
          setStatus(json.data?.message || data.i18n?.sent, true);
          form.reset();
        } else {
          setStatus(json.data?.message || data.i18n?.error, false);
        }
      } catch (err) {
        setStatus(data.i18n?.error || 'Error', false);
      } finally {
        if (submit) submit.disabled = false;
      }
    });
  });
}

/* ---------- AJAX search ---------- */
function initSearch() {
  const open = document.querySelector('[data-aqua-search-open]');
  const bar = document.querySelector('[data-aqua-search]');
  const input = document.querySelector('[data-aqua-search-input]');
  const out = document.querySelector('[data-aqua-search-results]');
  if (!open || !bar || !input || !out) return;

  open.addEventListener('click', () => {
    bar.hidden = !bar.hidden;
    if (!bar.hidden) input.focus();
  });

  let timer;
  input.addEventListener('input', () => {
    clearTimeout(timer);
    const q = input.value.trim();
    if (q.length < 2) { out.innerHTML = ''; return; }
    timer = setTimeout(async () => {
      const url = new URL(data.ajaxUrl);
      url.searchParams.set('action', 'aquapro_search');
      url.searchParams.set('nonce', data.searchNonce || '');
      url.searchParams.set('q', q);
      try {
        const res = await fetch(url);
        const json = await res.json();
        const items = (json.data?.results || [])
          .map((r) => `<li><a href="${r.url}">${escapeHtml(r.title)}<small>${escapeHtml(r.type)}</small></a></li>`)
          .join('');
        out.innerHTML = items;
      } catch (e) { /* silent */ }
    }, 250);
  });
}

function escapeHtml(s) {
  const d = document.createElement('div');
  d.textContent = s;
  return d.innerHTML;
}

/* ---------- Boot ---------- */
function boot() {
  initBurger();
  initDarkToggle();
  initStickyShadow();
  initCarousel();
  initBeforeAfter();
  initForms();
  initSearch();
}

if (document.readyState !== 'loading') boot();
else document.addEventListener('DOMContentLoaded', boot);
