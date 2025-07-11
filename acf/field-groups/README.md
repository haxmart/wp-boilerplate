# ACF Field Groups Directory

This directory contains ACF field group JSON files for the Registry theme.

## About ACF Field Groups

ACF field groups define the custom fields that appear in the WordPress admin for your blocks, post types, and other content.

## Auto-sync Feature

ACF automatically syncs field groups when JSON files are placed in this directory. This ensures that field configurations are version-controlled and can be easily deployed across environments.

## File Naming Convention

Field group files should be named descriptively to match their purpose:
- `group_hero_block.json` - Fields for hero block
- `group_testimonial_block.json` - Fields for testimonial block
- `group_page_options.json` - Fields for page options

## Creating Field Groups

1. **Create fields in WordPress admin** (Plugins > Custom Fields > Field Groups)
2. **Export to JSON** - ACF will automatically create JSON files in this directory
3. **Version control** - Commit the JSON files to your repository
4. **Deploy** - ACF will automatically sync fields on other environments

## Block-specific Fields

When creating fields for ACF blocks, remember to:
- Use descriptive field names and labels
- Group related fields using tabs (Content, Appearance, Buttons)
- Set appropriate field types and validation rules
- Configure field location rules to show only for specific blocks

## Best Practices

- Always test field changes in a development environment first
- Use consistent naming conventions across field groups
- Document any complex field relationships or dependencies
- Consider using conditional logic for advanced field interactions