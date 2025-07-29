<?php
if (!defined('ABSPATH'))
    exit;

function cab_register_admin_menu()
{
    add_menu_page(
        'Custom Accordions',
        'Custom Accordions',
        'manage_options',
        'cab_accordion_list',
        'cab_render_list_page',
        'dashicons-editor-justify',
        80
    );

    add_submenu_page(
        null,
        'Edit Accordion',
        'Edit Accordion',
        'manage_options',
        'cab_accordion_edit',
        'cab_render_edit_page'
    );

    add_submenu_page(
        'cab_accordion_list',
        'تنظیمات استایل',
        'تنظیمات استایل',
        'manage_options',
        'cab_accordion_styles',
        'cab_render_style_settings_page'
    );

}
add_action('admin_menu', 'cab_register_admin_menu');

require_once __DIR__ . '/list-page.php';
require_once __DIR__ . '/edit-page.php';
require_once __DIR__ . '/style-settings.php';

