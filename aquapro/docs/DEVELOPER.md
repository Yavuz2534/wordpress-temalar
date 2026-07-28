# AquaPro — Developer Documentation

A modular, object-oriented WordPress theme. No build step is required; assets
ship as plain CSS and ES modules.

## Architecture

```
aquapro/
├── style.css                  # Theme header + minimal fallback only
├── functions.php              # Bootstrap: constants + module loader (aquapro_boot)
├── inc/                       # One class per responsibility (AquaPro_*)
│   ├── class-security.php     # Headers, generator removal, login hardening
│   ├── class-setup.php        # Supports, menus, image sizes, i18n, widgets
│   ├── class-enqueue.php      # Split CSS layers + ESM JS + inline tokens
│   ├── class-cpt.php          # Services/Projects/Testimonials/Team/Areas + taxes
│   ├── class-meta.php         # Lightweight meta boxes for the CPTs
│   ├── class-customizer.php   # Options framework: presets, colors, type, dark, hero
│   ├── class-template.php     # Template tags + inline SVG icon loader
│   ├── class-schema.php       # LocalBusiness/Plumber JSON-LD
│   ├── class-ajax.php         # Nonce-protected contact + search endpoints
│   └── class-woocommerce.php  # Optional, loads only if WooCommerce is active
├── template-parts/
│   ├── content.php / content-none.php
│   └── home/                  # One file per homepage section (filterable order)
├── assets/
│   ├── css/                   # variables → presets → main → rtl (cascade layers)
│   ├── js/                    # main.js (ESM), customize-preview.js
│   └── icons/                 # Self-hosted, licensing-safe inline SVGs
├── languages/aquapro.pot      # Translation template
└── docs/                      # USER.md + DEVELOPER.md
```

## Conventions

- **Coding standards:** follows the WordPress Coding Standards. Every file guards
  `defined( 'ABSPATH' )`. All output is escaped; all input is sanitized + nonce-checked.
- **Namespacing:** classes are `AquaPro_*`, functions/hooks/options are `aquapro_`-prefixed,
  CSS is BEM-ish under the `.aqua-` namespace, CSS variables are `--aqua-*`.
- **Modules:** add a class to `inc/`, expose a static `register()`, then add its slug to
  `$modules` in `aquapro_boot()`. The loader resolves `class-{slug}.php` → `AquaPro_{Studly}`.

## Theming hooks (filters)

| Filter | Purpose |
|---|---|
| `aquapro_home_sections` | Reorder / add / remove homepage section slugs. |
| `aquapro_pricing` | Replace the pricing plans array. |
| `aquapro_faqs` | Replace the FAQ items (also drives FAQ schema). |
| `aquapro_content_width` | Adjust `$content_width`. |

## Dynamic design tokens

`AquaPro_Customizer::dynamic_css()` prints a `<style id="aquapro-tokens">` block with the
live `--aqua-accent`, `--aqua-radius`, font tokens etc. This is how “unlimited color
customization” works instantly with no recompile. The Customizer preview JS mirrors the
same tokens via `postMessage` for live editing.

## Custom post type meta keys

| CPT | Meta key | Use |
|---|---|---|
| Service | `_aqua_icon` | Icon slug from `assets/icons/`. |
| Team / Testimonial | `_aqua_role` | Role or location line. |
| Project | `_aqua_before`, `_aqua_after` | Attachment IDs for the before/after slider. |

## AJAX endpoints

- `wp_ajax(_nopriv)_aquapro_contact` — lead form. Nonce `aquapro_contact`, honeypot field
  `website`, 20s/IP transient rate-limit, emails `admin_email`.
- `wp_ajax(_nopriv)_aquapro_search` — instant search across posts/pages/services/projects.
  Nonce `aquapro_search`.

## Extending toward the full premium feature set

The following are scaffolded with clean seams so they can be completed without rearchitecting:

- **Elementor / Gutenberg patterns:** register block patterns mirroring `template-parts/home/*`.
- **Header/Footer builder & mega menu editor:** the markup + `.mega` menu hook are in place;
  back them with an options panel or a builder library.
- **One-click demo import:** ship a WXR export + a small importer that maps to the CPTs/meta
  documented above (`docs/demo-content.md`).
- **WooCommerce templates:** `class-woocommerce.php` declares support and wraps content;
  drop `woocommerce/` overrides as needed.

## Child themes

Override any template part by copying it into a child theme (e.g.
`template-parts/home/pricing.php`). Use the filters above for data-only changes.
