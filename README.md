# WordPress Boilerplate

A modern WordPress theme boilerplate with TailwindCSS v4 and ACF Gutenberg blocks.

## Requirements

- Node.js 18+
- WordPress 6.0+
- ACF Pro plugin
- pnpm (`npm install -g pnpm`)

## Quick Start

```bash
# Install dependencies
pnpm install

# Start development
pnpm start

# Build for production
pnpm build
```

## Commands

| Command | Description |
|---------|-------------|
| `pnpm start` | Development mode with watch |
| `pnpm build` | Production build |
| `pnpm format` | Format code with Prettier |
| `pnpm lint:css` | Lint CSS files |
| `pnpm lint:js` | Lint JavaScript files |

## Project Structure

```
boilerplate/
├── src/                    # Source files
│   ├── global.css         # TailwindCSS v4 entry
│   ├── index.js           # JavaScript entry
│   └── js/
│       └── theme.js       # Theme scripts
├── build/                 # Compiled assets (gitignored)
├── acf/
│   ├── blocks/           # ACF block templates
│   └── json/             # ACF field group JSON
└── inc/
    └── blocks.php        # Block registration
```

## Creating ACF Blocks

1. Create block directory: `acf/blocks/your-block/`
2. Add `block.json` and `block.php` template
3. Register in `inc/blocks.php`:
   ```php
   register_block_type(get_theme_file_path('acf/blocks/your-block'));
   ```
4. Create ACF fields in WordPress admin
5. JSON files auto-sync to `acf/json/`

## Block Template Pattern

```php
<div id="<?php echo esc_attr($block['id']); ?>" class="px-5 py-14 md:px-10 md:py-20 lg:py-26 xl:py-30">
    <div class="max-w-7xl mx-auto">
        <!-- Block content -->
    </div>
</div>
```

## Notes

- TailwindCSS v4 config is in `src/global.css` using `@theme {}`
- PostCSS config uses `@tailwindcss/postcss` for v4
- Build directory is excluded from git and watch mode
- WordPress auto-enqueues `build/index.css` and `build/index.js`

## License

GPL v2 or later
