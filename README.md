# Genrolla — Gen Z Blog Theme

**Version:** 2.0.0 · **License:** GPL v2+

Fast, SEO-friendly, Gen Z blog theme. Semi-dark design with neon green accent. Dibuat untuk blog, affiliate marketing, dan AdSense monetization.

## ✨ Fitur

- 🎨 **Design Gen Z** — semi-dark `#0F1113` + neon green `#A3FF12`, font Space Grotesk + Inter
- 📱 **Responsive** — mobile, tablet, desktop
- 🔍 **SEO-Ready**:
  - Schema.org Article + BreadcrumbList (JSON-LD)
  - Breadcrumb visual + navigasi
  - **Table of Contents** otomatis (dari heading H2)
  - Author box + meta lengkap (tanggal, read time, comments)
  - H1 hierarchy benar: front-page → archive → single
- 🚀 **One-Click Demo Import** — `Appearance → Import Demo` → 12 artikel + 5 kategori + 20 tag + featured images + komentar (sekali klik, bisa di-reset)
- 🔥 **Trending section** — query dari post dengan komentar terbanyak
- 🖼️ **Card image fallback** — kalau post nggak punya gambar, tampil gradient + icon
- 📬 **Newsletter section** — support shortcode plugin (MC4WP/ConvertKit) atau form action URL
- ⚙️ **Customizer** — warna (bg + accent), hero (image/title/subtitle/button), newsletter, copyright, social links
- 🧩 **Gutenberg & Classic Editor** compatible (tanpa plugin page builder)

## 📦 Install

1. Download repo ini → zip
2. WordPress Admin → Appearance → Themes → Add New → Upload Theme
3. Activate
4. **Appearance → Import Demo** → klik tombol (opsional, buat lihat contoh konten)
5. **Appearance → Customize** → set logo, warna, hero
6. **Appearance → Menus** → bikin Primary & Footer menu
7. **Appearance → Widgets** → isi Sidebar & Footer (opsional)

## 🗂️ Struktur

```
genrolla/
├── style.css              # Metadata + semua CSS
├── functions.php          # Setup, customizer, SEO helpers, trending, notice
├── header.php / footer.php / sidebar.php
├── front-page.php         # Home: hero + trending + latest
├── index.php              # Blog index fallback
├── archive.php            # Category/tag/author/date
├── single.php             # Single post + sidebar + ToC + author box
├── page.php               # About/Contact
├── search.php / 404.php / comments.php / searchform.php
├── inc/demo-import.php    # One-click demo content importer
├── template-parts/
│   ├── card.php           # Post card (dengan fallback image)
│   └── author-box.php
├── assets/js/main.js      # Menu, search drawer, ToC generator
└── screenshot.png
```

## ⚙️ Pengaturan

| Fitur | Lokasi |
|---|---|
| Logo, warna, hero, newsletter, copyright | Appearance → Customize |
| Menu | Appearance → Menus |
| Sidebar & Footer widgets | Appearance → Widgets |
| Demo content | Appearance → Import Demo |
| Recommended plugins (opsional) | Yoast/Rank Math, MC4WP/ConvertKit, Classic Editor |

## 💬 Newsletter

Theme menyediakan section + form HTML. Untuk beneran kirim email:
- Install **MC4WP** (Mailchimp) atau plugin ConvertKit
- Masukkan shortcode di **Customize → Newsletter Settings → Plugin Shortcode**
- Atau isi **Form action URL** dengan endpoint ESP lu

## 📝 Changelog

### 2.0.0
- Redesign total: semi-dark + neon green (Gen Z aesthetic)
- One-click demo importer (12 posts, categories, tags, images, comments)
- SEO: schema, breadcrumb, ToC, author box
- Trending section (comment count)
- Card image fallback
- Font Awesome icons (no emoji)
- Responsive + mobile menu + search drawer

### 1.0.0
- Initial release (classic light blog theme)
