# AquaPro — Premium Plumbing & Home-Service WordPress Theme

A production-ready, conversion-focused WordPress theme for plumbing, HVAC,
drainage and maintenance companies. Built to a commercial (ThemeForest-style)
quality bar: modular OOP architecture, Customizer options framework, custom post
types, AJAX lead forms, Schema.org markup, dark mode, RTL and accessibility.

## Highlights
- 🎨 5 color presets + unlimited custom colors (live tokens, no rebuild)
- 🌙 Dark mode (auto / toggle / off)
- 🧩 Gutenberg-first; WooCommerce-ready; Elementor-friendly markup
- 🧱 CPTs: Services, Projects, Testimonials, Team, Service Areas
- ⚡ AJAX contact form (nonce + honeypot + rate-limit) and AJAX search
- 🗺️ Service-area map, before/after slider, reviews carousel, FAQ + schema
- ♿ WCAG-minded (skip link, focus-visible, reduced-motion, semantic landmarks)
- 🚀 Split CSS, ES modules, lazy images, no external runtime dependencies
- 🌍 Translation-ready (`languages/aquapro.pot`) + RTL stylesheet

## Install
See `docs/USER.md`. In short: Appearance → Themes → Upload `aquapro.zip` → Activate,
then set a static front page and fill **Customize → AquaPro Options**.

## For developers
See `docs/DEVELOPER.md` (architecture, hooks, tokens, extension seams) and
`docs/demo-content.md` (demo dataset for a one-click importer).

## Licensing-safe assets
- **Icons:** original inline SVGs in `assets/icons/` (no third-party icon-font license).
- **Fonts:** self-host your chosen families in `assets/fonts/` (the theme references
  `--aqua-font-heading` / `--aqua-font-body`); ship only license-compatible webfonts
  (e.g. SIL OFL families) or let the site owner add Google Fonts via a plugin.
- **Images:** ship none, or only CC0/own-licensed demo images. Document sources in
  the demo package.

## License
GNU General Public License v2 or later.
