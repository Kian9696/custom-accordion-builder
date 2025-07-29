<?php
/**
 * Plugin Name: Custom Accordion Builder
 * Description: Create multiple custom accordions from the dashboard and use them via shortcode.
 * Version: 1.0
 * Author: Kian Kiani
 * Text Domain: custom-accordion-builder
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Plugin Constants
define('CAB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CAB_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include Admin Settings Page
if (is_admin()) {
    require_once CAB_PLUGIN_DIR . 'admin/settings-page.php';
}

// Include Frontend Shortcode
require_once CAB_PLUGIN_DIR . 'public/shortcode.php';

// Enqueue Scripts and Styles
function cab_enqueue_assets()
{
    $css_file = CAB_PLUGIN_DIR . 'public/css/accordion.css';
    $js_file = CAB_PLUGIN_DIR . 'public/js/accordion.js';

    wp_enqueue_style(
        'cab-accordion-style',
        CAB_PLUGIN_URL . 'public/css/accordion.css',
        [],
        file_exists($css_file) ? filemtime($css_file) : false
    );

    wp_enqueue_script(
        'cab-accordion-script',
        CAB_PLUGIN_URL . 'public/js/accordion.js',
        [],
        file_exists($js_file) ? filemtime($js_file) : false,
        true
    );

    $style = get_option('cab_style_options', [
        'background_color' => '#ffffff',
        'font_size' => '16px',
        'border_color' => '#cccccc',
        'border_width' => '1px',
    ]);

    $custom_css = ":root {
        --cab-bg-color: {$style['background_color']};
        --cab-font-size: {$style['font_size']};
        --cab-border-color: {$style['border_color']};
        --cab-border-width: {$style['border_width']};
        --cab-header-padding: {$style['header_padding']};
        --cab-panel-bg: {$style['panel_background']};
        --cab-content-padding: {$style['content_padding']};
        --cab-content-font-size: {$style['content_font_size']};
        --cab-content-border-width: {$style['content_border_width']};
    }";

    wp_add_inline_style('cab-accordion-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'cab_enqueue_assets');



// Activation Hook (create option if needed)
function cab_activate_plugin()
{
    if (!get_option('cab_accordions')) {
        add_option('cab_accordions', []);
    }
}
register_activation_hook(__FILE__, 'cab_activate_plugin');
