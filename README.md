# WordPress Boilerplate

A modern WordPress theme boilerplate with TailwindCSS v4, ACF Gutenberg blocks, and professional code quality tools.

## Features

- 🎨 **TailwindCSS v4** - Latest utility-first CSS framework with CSS-first configuration
- ⚛️ **ACF Gutenberg Blocks** - Modern block.json registration with auto-discovery
- 🔧 **@wordpress/scripts** - Industry-standard WordPress build pipeline
- ✨ **Ultracite Code Formatting** - AI-ready code formatting and linting
- 🚀 **Performance Optimized** - Fast builds, automatic asset optimization
- 📱 **Modern WordPress Standards** - Full theme.json support, responsive design

## Quick Start

### Prerequisites

- Node.js 18+ recommended
- WordPress 6.0+
- ACF Pro plugin (for custom blocks)

### Installation

1. **Clone or download** this theme to your WordPress themes directory
2. **Install dependencies**:
   ```bash
   npm install
   ```
3. **Start development**:
   ```bash
   npm run start
   ```
4. **Activate the theme** in WordPress admin

## Development Commands

| Command | Description |
|---------|-------------|
| `npm run start` | Development mode with watch and hot reload |
| `npm run build` | Production build with minification |
| `npm run format:biome` | Format all code files |
| `npm run lint:biome` | Lint all code files |
| `npm run check:biome` | Check and fix code issues |

## Project Structure

```
registry/
├── src/                      # Source files
│   ├── css/
│   │   ├── style.css        # Main CSS with TailwindCSS imports
│   │   └── base/
│   │       └── typography.css # Custom typography styles
│   ├── js/
│   │   └── theme.js         # Theme JavaScript functionality
│   └── index.js             # Webpack entry point
├── build/                   # Compiled assets (auto-generated)
├── acf/                     # ACF configuration
│   ├── blocks/             # Custom block templates
│   └── field-groups/       # ACF field group JSON files
├── inc/                     # Theme includes
│   └── blocks.php          # Block registration
├── .vscode/                 # VS Code settings
├── style.css               # WordPress theme header
├── index.php               # Main template
├── functions.php           # Theme functions
├── biome.jsonc            # Code formatting config
└── postcss.config.js      # CSS processing config
```

## Customization

### Adding Custom Styles

Edit `src/css/base/typography.css` for your project-specific styles:

```css
/* Typography styles for .typography class */
.typography {
  /* Your custom styles here */
  h1 {
    @apply text-4xl font-bold mb-6;
  }
  
  p {
    @apply mb-4 leading-relaxed;
  }
}
```

### TailwindCSS Configuration

Customize TailwindCSS in `src/css/style.css`:

```css
@import "tailwindcss";
@import "./base/typography.css";

@theme {
  --color-brand-primary: #your-color;
  --font-family-heading: "Your Font", sans-serif;
}
```

### Theme Configuration

Modify theme settings in `functions.php`:

```php
// Add theme support
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

// Customize excerpt length
function boilerplate_excerpt_length($length) {
    return 25; // Change excerpt length
}
add_filter('excerpt_length', 'boilerplate_excerpt_length');
```

## Creating ACF Blocks

### 1. Create Block Directory

```bash
mkdir acf/blocks/your-block
```

### 2. Create block.json

```json
{
  "name": "boilerplate/your-block",
  "title": "Your Block",
  "description": "Description of your block",
  "category": "boilerplate-blocks",
  "icon": "admin-comments",
  "keywords": ["keyword1", "keyword2"],
  "acf": {
    "mode": "edit",
    "renderTemplate": "block.php"
  }
}
```

### 3. Create block.php Template

```php
<?php
/**
 * Your Block Template
 */

// Fetch fields
$content = get_field('content');
$title = get_field('title');

// Early return if required fields missing
if (!$content) {
    return;
}
?>

<div id="<?php echo esc_attr($block['id']); ?>" class="px-5 py-14 md:px-10 md:py-20 lg:py-26 xl:py-30">
    <div class="max-w-7xl mx-auto">
        <?php if ($title) : ?>
            <h2 class="text-3xl font-bold mb-6"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        
        <div class="typography">
            <?php echo wp_kses_post($content); ?>
        </div>
    </div>
</div>
```

### 4. Register Block

In `inc/blocks.php`, add:

```php
register_block_type(get_theme_file_path('acf/blocks/your-block'));
```

### 5. Create ACF Fields

1. Go to **Custom Fields > Field Groups** in WordPress admin
2. Create fields for your block
3. Set **Location Rules** to show only for your block
4. ACF will auto-generate JSON file in `acf/field-groups/`

## Block Development Best Practices

### Field Organization

Use ACF tabs to organize fields:

- **Content Tab**: Text, WYSIWYG, headings
- **Appearance Tab**: Images, layout options, colors  
- **Buttons Tab**: CTAs and button configurations

### Block Structure

Follow this pattern for consistent blocks:

```php
<div id="<?php echo esc_attr($block['id']); ?>" class="px-5 py-14 md:px-10 md:py-20 lg:py-26 xl:py-30">
    <div class="max-w-7xl mx-auto">
        <div class="grid gap-y-8 md:gap-8 md:grid-cols-12">
            <!-- Block content -->
        </div>
    </div>
</div>
```

### Content Layouts

**Center-aligned content:**
```php
<div class="md:col-span-10 md:col-start-2 lg:col-span-8 lg:col-start-3">
    <div class="typography">
        <?php echo wp_kses_post($content); ?>
    </div>
</div>
```

**Left-aligned content:**
```php
<div class="md:col-span-10 lg:col-span-8">
    <div class="typography">
        <?php echo wp_kses_post($content); ?>
    </div>
</div>
```

### Security

Always sanitize output:

```php
// For HTML attributes
<?php echo esc_attr($value); ?>

// For URLs
<?php echo esc_url($url); ?>

// For rich content (allows safe HTML)
<?php echo wp_kses_post($content); ?>

// For plain text
<?php echo esc_html($text); ?>
```

## Code Quality

### Formatting

This theme uses **Ultracite** (Biome-based) for code formatting:

- **Automatic formatting** on save (VS Code)
- **AI-compatible** code style
- **Fast Rust-based** processing
- **Zero configuration** required

### Supported Languages

- ✅ JavaScript/TypeScript
- ✅ CSS
- ✅ HTML  
- ✅ JSON
- ❌ PHP (use editor's built-in formatting)

### VS Code Integration

Format-on-save is automatically configured. Install the **Biome extension** for the best experience.

## Build Process

### Development Workflow

1. **Edit source files** in `src/` directory
2. **Run `npm run start`** for watch mode
3. **Files auto-compile** to `build/` directory
4. **Browser refreshes** automatically
5. **WordPress loads** compiled assets

### Production Deployment

1. **Run `npm run build`** for optimized assets
2. **Upload theme** to production server
3. **Compiled assets** automatically loaded by WordPress

### Asset Loading

WordPress automatically enqueues:

- `build/style-index.css` - Compiled CSS
- `build/index.js` - Compiled JavaScript
- **Cache-busting** versions included
- **Editor styles** for block editor

## Troubleshooting

### Build Issues

**Problem**: `npm run build` fails
**Solution**: 
1. Delete `node_modules/` and `package-lock.json`
2. Run `npm install`
3. Try build again

**Problem**: TailwindCSS classes not working
**Solution**:
1. Check `src/css/style.css` imports
2. Verify TailwindCSS is processing files
3. Run `npm run build` to regenerate CSS

### Block Issues

**Problem**: Block not appearing in editor
**Solution**:
1. Check `inc/blocks.php` registration
2. Verify `block.json` syntax
3. Ensure ACF Pro is active
4. Check WordPress/ACF version compatibility

**Problem**: Block fields not showing
**Solution**:
1. Verify ACF field group location rules
2. Check field group is assigned to block
3. Ensure field group JSON is syncing

### Code Formatting

**Problem**: Code not formatting on save
**Solution**:
1. Install Biome VS Code extension
2. Check `.vscode/settings.json` exists
3. Verify Biome is set as default formatter

## Contributing

1. **Follow the code style** enforced by Biome
2. **Test all changes** in development
3. **Update documentation** when adding features
4. **Use semantic commit messages**

## License

GPL v2 or later

## Support

For detailed development notes, see `sketchpad.md` in the theme root.