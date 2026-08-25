# Genrolla — Gen Z Blog Theme

**Version:** 2.0.0 · **License:** GPL v2+

A fast, SEO-friendly, Gen Z blog theme. Semi-dark design with a neon green accent. Built for blogs, affiliate marketing, and AdSense monetization.

## ✨ Features

- 🎨 **Gen Z design** — semi-dark `#0F1113` + neon green `#A3FF12`, Space Grotesk + Inter fonts
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

### 2.0.0
- Full redesign: semi-dark + neon green (Gen Z aesthetic)
- One-click demo importer (12 posts, categories, tags, images, comments)
- SEO: schema, breadcrumb, ToC, author box
- Trending section (comment count → Highlight fallback)
- Card image fallback
- Font Awesome icons (no emoji)
- Responsive + mobile menu + search drawer
- English UI strings
