# ACF Blocks Directory

This directory contains custom ACF Gutenberg blocks for the Registry theme.

## Adding New Blocks

To add a new ACF block:

1. **Create a block directory** in `acf/blocks/` (e.g., `acf/blocks/hero/`)

2. **Create required files** in your block directory:
   - `block.json` - Block configuration
   - `block.php` - Block template
   - ACF field group JSON file (optional, can be in `acf/field-groups/`)

3. **Register the block** in `inc/blocks.php`:
   ```php
   register_block_type(get_theme_file_path('acf/blocks/hero'));
   ```

## Block Structure Example

```
acf/blocks/hero/
├── block.json          # Block configuration
├── block.php           # Block template
└── fields.json         # ACF field group (optional)
```

## Sample block.json

```json
{
  "name": "registry/hero",
  "title": "Hero Section",
  "description": "A hero section block",
  "category": "registry-blocks",
  "icon": "cover-image",
  "keywords": ["hero", "banner"],
  "acf": {
    "mode": "edit",
    "renderTemplate": "block.php"
  }
}
```

## Block Template Guidelines

- Always sanitize output with `esc_attr()`, `wp_kses_post()`, etc.
- Use early returns for missing required fields
- Follow the block structure pattern from the theme guidelines
- Wrap content in `.typography` class for WYSIWYG content
- Use gap utilities for spacing between elements