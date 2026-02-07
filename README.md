# Amnesia Skateboards WordPress Theme

A modern, content-focused WordPress/WooCommerce theme for Amnesia Skateboards.

## Features

- 🎨 Clean, minimalist design
- 📱 Fully responsive
- 🛒 Full WooCommerce integration
- 📝 Custom post types for Team Members and Videos
- 🎥 YouTube/Vimeo video embedding
- 📧 Newsletter signup section
- ⚡ Fast and lightweight

## Installation

1. Download this repository as a ZIP file
2. In WordPress admin, go to Appearance → Themes → Add New → Upload Theme
3. Upload the ZIP file
4. Activate the theme
5. Install and activate WooCommerce plugin
6. Configure your menus in Appearance → Menus

## Setup Instructions

### 1. Create Navigation Menu
1. Go to Appearance → Menus
2. Create a new menu called "Primary Menu"
3. Add pages: Home, Shop, Blog, Team, Contact
4. Assign to "Primary Menu" location

### 2. Add Team Members
1. Go to Team Members → Add New
2. Add team member name as title
3. Add bio/description in content
4. Set featured image (will appear in grayscale with color on hover)
5. Publish

### 3. Add Videos
1. Go to Videos → Add New
2. Add video title
3. Add description in content
4. Paste YouTube or Vimeo URL in the "Video URL" field
5. Set featured image (thumbnail)
6. Publish

### 4. Configure Homepage
The homepage automatically displays:
- Hero section with site title
- Latest 6 blog posts and videos
- Most recent video (embedded)
- Team members
- Newsletter signup

### 5. Set Up WooCommerce
1. Install WooCommerce plugin
2. Run the setup wizard
3. Add products under Products → Add New
4. Products will automatically use the theme styling

## Customization

### Change Colors
Edit the CSS variables in `style.css`:
```css
:root {
    --primary-black: #000000;
    --primary-white: #ffffff;
    --text-color: #333333;
    --border-color: #e5e5e5;
}
```

### Modify Hero Section
Edit `front-page.php` to change the hero text and buttons.

### Update Social Links
Edit `footer.php` to update social media URLs.

### Add Custom Logo
1. Go to Appearance → Customize → Site Identity
2. Upload your logo
3. It will replace the text logo in the header

## License

GPL v2 or later

## Changelog

### Version 1.0
- Initial release
- Homepage with content hub
- Team members custom post type
- Videos custom post type
- WooCommerce integration
- Responsive design
- Newsletter section
```

---

## **FILE 2: `.gitignore`**
```
.DS_Store
Thumbs.db
*.log
node_modules/
