# Registry Theme Development Log

## Project Overview
This is a WordPress theme boilerplate designed for modern development with TailwindCSS v4 and ACF Gutenberg blocks. The theme serves as a foundation for future WordPress projects.

## Development Timeline

### Phase 1: Core WordPress Theme Setup
**Goal**: Create basic WordPress theme structure

**Files Created**:
- `style.css` - WordPress theme header and metadata
- `index.php` - Basic theme template with TailwindCSS utility classes
- `functions.php` - Theme setup, features, and asset enqueuing

**Key Decisions**:
- Used basic WordPress theme structure
- Included TailwindCSS classes in templates for utility-first approach
- Set up theme support for modern WordPress features (title-tag, post-thumbnails, etc.)

### Phase 2: TailwindCSS v4 Integration
**Goal**: Set up modern CSS workflow with TailwindCSS v4

**Files Created**:
- `package.json` - Dependencies and build scripts
- `postcss.config.js` - PostCSS configuration for TailwindCSS v4
- `src/css/style.css` - Main CSS entry point with TailwindCSS imports
- `src/css/base/typography.css` - Empty typography file for project customization
- `src/index.js` - Webpack entry point for asset compilation

**Key Decisions**:
- Chose TailwindCSS v4 for latest features and performance
- Used CSS-first configuration approach (no tailwind.config.js)
- Kept typography.css empty as a boilerplate for future customization
- Separated build logic (index.js) from theme logic (theme.js)

**Technical Implementation**:
- TailwindCSS v4 uses `@import "tailwindcss"` syntax
- CSS variables automatically generated for all theme values
- Automatic content detection without manual configuration
- PostCSS processes TailwindCSS through @tailwindcss/postcss plugin

### Phase 3: Build System with @wordpress/scripts
**Goal**: Implement robust asset compilation pipeline

**Files Created**:
- `src/js/theme.js` - Theme-specific JavaScript functionality
- Build scripts in package.json

**Key Decisions**:
- Chose @wordpress/scripts over custom webpack config for WordPress compatibility
- Separated concerns: index.js (build) vs theme.js (functionality)
- Used standard WordPress build practices

**Technical Implementation**:
- Webpack compiles from src/ to build/ directory
- CSS and JS processed separately but bundled together
- Assets include cache-busting version hashes
- Development and production build modes

**Build Process**:
1. `src/index.js` imports CSS and JS files
2. @wordpress/scripts processes through webpack
3. TailwindCSS processes CSS through PostCSS
4. Output: `build/style-index.css` and `build/index.js`
5. WordPress enqueues compiled assets with proper versioning

### Phase 4: ACF Gutenberg Blocks Infrastructure
**Goal**: Create foundation for custom block development

**Files Created**:
- `inc/blocks.php` - Block registration system
- `acf/blocks/` directory - For block templates
- `acf/field-groups/` directory - For ACF field JSON files
- `acf/blocks/README.md` - Block development guide
- `acf/field-groups/README.md` - Field group documentation

**Key Decisions**:
- Used modern block.json registration method (WordPress 5.8+)
- Implemented auto-discovery system for blocks
- Created custom block category "Registry Blocks"
- Followed ACF 6.0+ best practices

**Technical Implementation**:
- Block registration via `register_block_type()` function
- Blocks use ACF-specific configuration in block.json
- Field groups auto-sync from JSON files
- Editor asset enqueuing for block editor integration

**Infrastructure Features**:
- Automatic block discovery (commented out for manual control)
- Custom block category for organization
- Editor styles integration
- Block editor asset enqueuing

### Phase 5: Code Quality with Ultracite
**Goal**: Implement professional code formatting and linting

**Files Created**:
- `biome.jsonc` - Biome configuration extending Ultracite preset
- `.vscode/settings.json` - VS Code format-on-save integration

**Key Decisions**:
- Chose Ultracite (Biome-based) over ESLint/Prettier for performance
- Configured to only process src/ directory (ignore build/)
- Set up AI-compatible formatting rules
- Added custom rules for TailwindCSS v4 compatibility

**Technical Implementation**:
- Biome (Rust-based) for fast formatting and linting
- Ultracite preset provides opinionated, AI-ready rules
- Custom configuration disables unknown at-rule warnings for @theme
- Format-on-save integration for development workflow

**Code Quality Features**:
- Arrow functions enforced over function expressions
- Console.log warnings (commented out for debugging)
- Automatic code formatting on save
- Consistent code style across project

## Asset Compilation Flow

### Development Mode (`npm run start`)
1. Webpack watches src/ directory for changes
2. TailwindCSS processes CSS files through PostCSS
3. JavaScript files processed and bundled
4. Assets output to build/ with source maps
5. Browser auto-refreshes on changes

### Production Mode (`npm run build`)
1. Same process but optimized for production
2. CSS and JS minified
3. Source maps removed
4. Cache-busting hashes updated

### WordPress Integration
1. `functions.php` enqueues compiled assets
2. CSS loaded via `wp_enqueue_style()`
3. JS loaded via `wp_enqueue_script()`
4. Editor styles automatically included
5. Asset versioning handled automatically

## File Structure Logic

### Source Files (`src/`)
- `index.js` - Webpack entry point (build instructions)
- `js/theme.js` - Theme functionality
- `css/style.css` - Main CSS with TailwindCSS imports
- `css/base/typography.css` - Project-specific typography

### Build Files (`build/`)
- `style-index.css` - Compiled CSS
- `index.js` - Compiled JavaScript
- `*.asset.php` - WordPress asset dependency files

### WordPress Files
- `style.css` - WordPress theme header
- `index.php` - Basic theme template
- `functions.php` - Theme setup and asset enqueuing

### ACF Structure
- `acf/blocks/` - Block templates and configuration
- `acf/field-groups/` - Field group JSON files
- `inc/blocks.php` - Block registration logic

## Configuration Files

### Build Configuration
- `package.json` - Dependencies and scripts
- `postcss.config.js` - PostCSS/TailwindCSS configuration
- `biome.jsonc` - Code formatting and linting rules

### Editor Configuration
- `.vscode/settings.json` - VS Code integration
- Format-on-save enabled for supported file types

## Key Technical Decisions

1. **TailwindCSS v4 over v3**: Latest features, better performance, CSS-first config
2. **@wordpress/scripts over custom webpack**: WordPress compatibility, maintenance
3. **Biome over ESLint/Prettier**: Performance, AI compatibility
4. **block.json over PHP registration**: Modern WordPress standards
5. **Separation of concerns**: Build logic separate from theme logic

## Future Considerations

### Planned Enhancements
- Add example ACF blocks
- Create component library
- Add theme customization options
- Implement theme.json support

### Potential Improvements
- Add TypeScript support
- Implement CSS-in-JS for components
- Add automated testing
- Create deployment scripts

## Development Notes

### Common Commands
- `npm run start` - Development mode with watch
- `npm run build` - Production build
- `npm run format:biome` - Format all code
- `npm run lint:biome` - Lint all code

### File Modification Notes
- All source files automatically formatted by Biome
- CSS processed through TailwindCSS v4
- JavaScript uses modern ES6+ syntax
- PHP files formatted by editor (Zed built-in)

## Lessons Learned

1. **TailwindCSS v4 Configuration**: CSS-first approach simplifies setup
2. **WordPress Asset Handling**: Proper enqueuing prevents conflicts
3. **Code Quality Tools**: Biome provides excellent performance vs ESLint
4. **Block Development**: Modern block.json method is more maintainable
5. **Build Process**: Separating entry points improves maintainability