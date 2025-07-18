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
    // Auto-register all blocks in the kit/ directory
    $kit_dir = get_theme_file_path('kit');

    if (is_dir($kit_dir)) {
        // Use recursive iterator to find all block.json files
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($kit_dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === 'block.json') {
                // Register the block using the directory containing block.json
                $result = register_block_type($file->getPath());

                // Debug: Log registration attempts (remove in production)
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    error_log('Attempting to register block at: ' . $file->getPath());
                    if (is_wp_error($result)) {
                        error_log('Block registration failed: ' . $result->get_error_message());
                    }
                }
            }
        }
    }

    // Also check if acf/blocks directory exists for legacy blocks
    $blocks_dir = get_theme_file_path('acf/blocks');
    if (is_dir($blocks_dir)) {
        $blocks = glob($blocks_dir . '/*', GLOB_ONLYDIR);

        foreach ($blocks as $block_dir) {
            $block_json = $block_dir . '/block.json';
            if (file_exists($block_json)) {
                register_block_type($block_dir);
            }
        }
    }
}

// Register blocks on init with priority 5 (before default priority 10)
add_action('init', 'registry_register_blocks', 5);

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
