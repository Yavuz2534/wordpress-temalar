# AquaPro — Demo Content Structure

This document defines the demo dataset a one-click importer should create. Ship a
WordPress eXtended RSS (WXR) export built from this structure (Tools → Export).

## Pages
- **Home** (set as static front page) — empty content; rendered by `front-page.php`.
- **Blog** — set as the Posts page.
- **About**, **Contact** — standard pages.

## Customizer (theme_mods) seed
```
aquapro_company   = "AquaPro Plumbing"
aquapro_tagline   = "Emergency Home Services"
aquapro_phone     = "+1 (800) 555-0123"
aquapro_whatsapp  = "18005550123"
aquapro_email     = "hello@aquapro.example"
aquapro_address   = "123 Main St, Springfield"
aquapro_maparea   = "Springfield"
aquapro_preset    = "aqua"
aquapro_dark_mode = "toggle"
```

## Services (aquapro_service) — with `_aqua_icon`
| Title | _aqua_icon |
|---|---|
| Leak Detection | leak |
| Drain Cleaning | drain |
| Camera Inspection | camera |
| Boiler & Heating | boiler |
| Taps & Fixtures | tap |
| General Plumbing | wrench |

## Projects (aquapro_project) — with `_aqua_before` / `_aqua_after`
At least 3 projects, each with two image attachments (before / after).

## Testimonials (aquapro_review) — with `_aqua_role` (location)
6–9 short reviews.

## Team (aquapro_member) — with `_aqua_role` + featured image
4 members.

## Service Areas (aquapro_area)
8–12 neighbourhoods/cities.

## Menus
- **Primary:** Home, Services (mega), About, Blog, Contact.
- **Footer:** Privacy, Terms, Sitemap.

## Importer notes
Map each item’s meta exactly as above. After import, run
`flush_rewrite_rules()` (or re-save permalinks) so CPT archives resolve.
