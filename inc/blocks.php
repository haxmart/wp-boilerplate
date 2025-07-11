<?php
/**
 * ACF Blocks Registration
 *
 * @package Registry
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF blocks
 *
 * This function registers all custom ACF blocks for the theme.
 * Add your block registrations here when you create new blocks.
 *
 * Example:
 * register_block_type(get_theme_file_path('acf/blocks/hero'));
 * register_block_type(get_theme_file_path('acf/blocks/callout'));
 */
function registry_register_blocks()
{
    // Register your ACF blocks here
    // Example:
    // register_block_type(get_theme_file_path('acf/blocks/hero'));
    
    // Check if blocks directory exists
    $blocks_dir = get_theme_file_path('acf/blocks');
    if (!is_dir($blocks_dir)) {
        return;
    }
    
    // Auto-register all blocks in the acf/blocks directory
    // Uncomment the code below if you want automatic registration
    
    /*
    $blocks = glob($blocks_dir . '/*', GLOB_ONLYDIR);
    
    foreach ($blocks as $block_dir) {
        $block_json = $block_dir . '/block.json';
        if (file_exists($block_json)) {
            register_block_type($block_dir);
        }
    }
    */
}

// Register blocks when ACF is ready
add_action('acf/init', 'registry_register_blocks');

/**
 * Add custom block categories
 *
 * This function adds custom block categories for organizing blocks in the editor.
 */
function registry_add_block_categories($categories, $post)
{
    // Add custom category for theme blocks
    array_unshift($categories, array(
        'slug'  => 'registry-blocks',
        'title' => __('Registry Blocks', 'registry'),
        'icon'  => 'layout',
    ));
    
    return $categories;
}
add_filter('block_categories_all', 'registry_add_block_categories', 10, 2);

/**
 * Enqueue block editor assets
 *
 * This function enqueues CSS and JS specifically for the block editor.
 */
function registry_enqueue_block_editor_assets()
{
    // Enqueue editor styles if they exist
    if (file_exists(get_theme_file_path('build/style-index.css'))) {
        wp_enqueue_style(
            'registry-editor-style',
            get_theme_file_uri('build/style-index.css'),
            array(),
            wp_get_theme()->get('Version')
        );
    }
    
    // Enqueue editor scripts if they exist
    if (file_exists(get_theme_file_path('build/index.js'))) {
        wp_enqueue_script(
            'registry-editor-script',
            get_theme_file_uri('build/index.js'),
            array('wp-blocks', 'wp-element', 'wp-editor'),
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action('enqueue_block_editor_assets', 'registry_enqueue_block_editor_assets');