# Genrolla Child Theme

Child theme for the **Genrolla** parent theme. Customize safely — your changes won't be lost when the parent theme is updated.

## Install

**Option A — ZIP upload:**
1. Upload the folder `genrolla-child` (zipped as `genrolla-child.zip`) via **Appearance → Themes → Add New → Upload**
2. Make sure the parent theme **Genrolla** is already installed (it must live in `wp-content/themes/genrolla/`)
3. Activate **Genrolla Child**

**Option B — FTP:**
1. Copy the `genrolla-child` folder to `wp-content/themes/`
2. Activate it from **Appearance → Themes**

> ⚠️ The parent theme folder must be named exactly `genrolla` (the `Template:` header in `style.css` points to it).

## How It Works

- `functions.php` loads **all parent theme features** (demo importer, subscribers CPT, SEO, customizer, etc.)
- Parent styles load first, child styles load after → your CSS overrides win
- Anything you add below the marker `YOUR CUSTOM CODE STARTS HERE` is safe from parent updates

## Customizing

**CSS** — add rules to `style.css` below the example comment. Quick accent change:

```css
:root{
  --neon:#FF6EC7;   /* new accent color */
}
```

**PHP** — add hooks/filters in `functions.php` below the marker.

**Templates** — copy any file from the parent theme (e.g. `single.php`) into this folder and edit it. WordPress will use your copy instead of the parent's.

## Changelog

### 1.0.0
- Initial child theme release
