# Genrolla — Modern Blog Theme

**Version:** 2.2.3 · **License:** GPL v2+

A fast, SEO-friendly, modern blog theme. Semi-dark design with a neon green accent. Built for blogs, affiliate marketing, and AdSense monetization.

## ✨ Features

- 🎨 **Modern design** — semi-dark `#0F1113` + neon green `#A3FF12`, Space Grotesk + Inter fonts
- 📱 **Fully responsive** — mobile, tablet, desktop
- 🔍 **SEO-ready**:
  - Schema.org Article + BreadcrumbList (JSON-LD)
  - Visual breadcrumbs + navigation hierarchy
  - **Auto Table of Contents** (from H2 headings)
  - Author box + full meta (date, read time, comments)
  - Correct H1 hierarchy: front page → archive → single
- 🚀 **One-click demo import** — `Appearance → Import Demo` → 12 posts + 6 categories + 20 tags + featured images + comments (resettable)
- 🔥 **Trending section** — most-commented posts first, falls back to the **Highlight** category, then latest
- 🖼️ **Card image fallback** — gradient + icon when a post has no image
- ❓ **FAQ (Accordion)** — repeater meta box in the post editor, conditional accordion section after the content, and automatic FAQPage JSON-LD schema
- 📬 **Newsletter section** — supports plugin shortcodes (MC4WP/ConvertKit) or a form action URL
- ⚙️ **Customizer** — colors (background + accent), hero (image/title/subtitle/button), newsletter, copyright
- 🧩 **Gutenberg & Classic Editor compatible** — no page builder required

## 📦 Install

1. Download this repo → zip
2. WordPress Admin → Appearance → Themes → Add New → Upload Theme
3. Activate
4. **Appearance → Import Demo** → click the button (optional, for sample content)
5. **Appearance → Customize** → set logo, colors, hero
6. **Appearance → Menus** → create Primary & Footer menus
7. **Appearance → Widgets** → fill Sidebar & Footer (optional)

## 👶 Child Theme

A ready-made child theme lives in the `genrolla-child/` folder. Copy it to `wp-content/themes/genrolla-child/` (or upload the zipped folder) and activate it. All parent features keep working, and your custom CSS/PHP survives parent updates. See `genrolla-child/README.md` for details.

## 🗂️ Structure

```
genrolla/
├── style.css              # Metadata + all CSS
├── functions.php          # Setup, customizer, SEO helpers, trending
├── header.php / footer.php / sidebar.php
├── front-page.php         # Home: hero + trending + latest
├── index.php              # Blog index fallback
├── archive.php            # Category/tag/author/date
├── single.php             # Single post + sidebar + ToC + author box
├── page.php               # Default page
├── template-about.php     # About page template (full width)
├── template-full-width.php# Full-width page template
├── search.php / 404.php / comments.php / searchform.php
├── inc/demo-import.php    # One-click demo content importer
├── inc/faq.php            # FAQ accordion + FAQPage schema
├── template-parts/        # card.php + author-box.php
├── assets/                # main.js, featured/
└── screenshot.png
```

## ⚙️ Settings

| Feature | Location |
|---|---|
| Logo, colors, hero, newsletter, copyright | Appearance → Customize |
| Menus | Appearance → Menus |
| Sidebar & Footer widgets | Appearance → Widgets |
| Demo content | Appearance → Import Demo |
| Recommended plugin | Yoast SEO (optional, for advanced SEO) |

## 💬 Newsletter

The theme provides the section + HTML form. To actually send emails:
- Install **MC4WP** (Mailchimp) or a ConvertKit plugin
- Paste its shortcode in **Customize → Newsletter Settings → Plugin Shortcode**
- Or fill the **Form action URL** with your ESP endpoint

## 📝 Changelog

### 2.2.3
- Fix: single post meta now renders the correct singular and plural comment count instead of always "comments"
- Fix: the table of contents heading is English and translatable instead of a hardcoded Indonesian string, and the label can be filtered through the theme text domain
- Fix: released package now includes `template-about.php` and `template-full-width.php`, which were missing from earlier builds even though they are documented page templates
- Chore: tested up to WordPress 7.1.2
- Chore: child theme source is now tracked in the repository (`genrolla-child/`), so the released child zip can be rebuilt from source

### 2.2.2
- Font Awesome is hosted locally in the theme and loaded with the handle `genrolla-fontawesome`, so Elementor and other builders stop dequeuing the icon stylesheet
- Re-enqueue guard on `wp_enqueue_scripts` and `wp_print_styles` to restore the icon stylesheet if something removes it

### 2.2.1
- Demo importer fixes and featured image set for the sample content

### 2.2.0
- FAQ (Accordion): repeater meta box in the post editor, conditional accordion section after the content, and automatic FAQPage JSON-LD schema

### 2.1.4
- SEO polish: breadcrumb hierarchy, H1 handling, and author box refinements

### 2.0.0
- Full redesign: semi-dark + neon green (modern aesthetic)
- One-click demo importer (12 posts, categories, tags, images, comments)
- SEO: schema, breadcrumb, ToC, author box
- Trending section (comment count → Highlight fallback)
- Card image fallback
- Font Awesome icons (no emoji)
- Responsive + mobile menu + search drawer
- English UI strings
