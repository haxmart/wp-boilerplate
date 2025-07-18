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
    // Check if ACF is active
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Auto-register all blocks in the registry/ directory
    $registry_dir = get_theme_file_path('registry');

    if (is_dir($registry_dir)) {
        // Use recursive iterator to find all block.json files
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($registry_dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === 'block.json') {
                $block_dir = $file->getPath();
                
                // Read and parse the block.json to check if it's an ACF block
                $block_json = json_decode(file_get_contents($file->getPathname()), true);
                
                if ($block_json && isset($block_json['acf'])) {
                    // This is an ACF block, register it properly
                    $result = register_block_type($block_dir);
                    
                    // Debug: Log registration attempts (remove in production)
                    if (defined('WP_DEBUG') && WP_DEBUG) {
                        error_log('Attempting to register ACF block: ' . $block_json['name'] . ' at ' . $block_dir);
                        if (is_wp_error($result)) {
                            error_log('Block registration failed: ' . $result->get_error_message());
                        } elseif ($result) {
                            error_log('ACF block registered successfully: ' . $block_json['name']);
                        }
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

// Call the registration function directly when this file is included
// The file is already included within the acf/init hook in functions.php
registry_register_blocks();

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
