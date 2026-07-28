# AquaPro — User Guide

Thank you for choosing **AquaPro**, a premium WordPress theme for plumbing, HVAC, drainage and home-service businesses.

## 1. Installation

1. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**.
2. Upload `aquapro.zip` and click **Install Now**, then **Activate**.
3. Recommended: install a caching plugin and an SMTP plugin (so lead emails deliver reliably).

> The ZIP already has `style.css` at the theme root — if your host shows a “missing style.css” error, re-zip the `aquapro` folder so that `aquapro/style.css` is at the top level.

## 2. Set your homepage

1. Go to **Settings → Reading → Your homepage displays → A static page**.
2. Create/select a blank page as the homepage. AquaPro renders the full landing design via `front-page.php`.

## 3. Brand & content (no code)

Open **Appearance → Customize → AquaPro Options**:

| Section | What you control |
|---|---|
| **Brand & Contact** | Company name, tagline, phone, WhatsApp, email, address, map location, hours |
| **Colors & Dark Mode** | Color preset, custom accent colors, dark mode (auto / toggle / off), corner radius |
| **Typography** | Heading & body font family, base font scale |
| **Header & Footer** | Sticky header, top bar, footer credit |
| **Homepage Hero** | Badge, title, subtitle |

All “Call” buttons use the phone number from **Brand & Contact**.

## 4. Add your services, projects, team, reviews, areas

AquaPro adds five content types in the admin sidebar:

- **Services** — add an *Icon slug* in the “AquaPro Details” box (e.g. `wrench`, `leak`, `drain`, `camera`, `boiler`, `tap`).
- **Projects** — set *Before* and *After* image IDs for the slider.
- **Testimonials** — write the review; add a *Location* in the details box.
- **Team** — add a *Role/title*; set a featured image as the photo.
- **Service Areas** — one per neighbourhood/city.

Until you add your own, the homepage shows tasteful demo placeholders.

## 5. Menus & widgets

- **Appearance → Menus**: assign menus to *Primary*, *Footer*, *Mobile*. Add the CSS class `mega` to a top-level item to turn its submenu into a mega menu.
- **Appearance → Widgets**: fill the four footer columns and the blog sidebar.

## 6. Dark mode

Choose how dark mode behaves in **Customize → Colors & Dark Mode**:
- **Auto** — follows the visitor’s system setting.
- **Toggle** — shows a moon button in the header.
- **Light only** — disables dark mode.

## 7. Support

Bundled documentation: this file and `DEVELOPER.md`. For theme updates, re-upload the new ZIP.
