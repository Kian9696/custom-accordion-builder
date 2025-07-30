<?php
if (!defined('ABSPATH'))
    exit;

function cab_render_accordion_shortcode($atts)
{
    $atts = shortcode_atts([
        'id' => ''
    ], $atts);

    $id = sanitize_title($atts['id']);
    $accordions = get_option('cab_accordions', []);

    if (!isset($accordions[$id])) {
        return '<p><strong>Accordion not found:</strong> ' . esc_html($id) . '</p>';
    }

    $items = $accordions[$id];
    $output = '<div class="cab-accordion-wrapper" data-accordion-id="' . esc_attr($id) . '">';

    foreach ($items as $index => $item) {
        $title = esc_html($item['title']);
        $content = wp_kses_post($item['content']);

        $output .= '
            <div class="cab-accordion-item">
                <button class="cab-accordion-header" aria-expanded="false" aria-controls="cab-panel-' . esc_attr($id) . '-' . $index . '" id="cab-header-' . esc_attr($id) . '-' . $index . '">
                    <span class="cab-header-title">' . $title . '</span>
                    <span class="cab-header-icon" aria-hidden="true">' . cab_get_arrow_svg('down') . '</span>
                </button>
                <div class="cab-accordion-panel" id="cab-panel-' . esc_attr($id) . '-' . $index . '" role="region" aria-labelledby="cab-header-' . esc_attr($id) . '-' . $index . '">
                    <div class="cab-accordion-content">' . $content . '</div>
                </div>
            </div>';

    }

    $output .= '</div>';

    return $output;
}
add_shortcode('custom_accordion', 'cab_render_accordion_shortcode');

function cab_get_arrow_svg($direction = 'down')
{
    if ($direction === 'up') {
        return '<svg class="cab-arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56" fill="none">
        <path d="M17.29 36.645L28 25.9583L38.71 36.645L42 33.355L28 19.355L14 33.355L17.29 36.645Z" fill="#060606"/>
        </svg>';
    } else {
        return '<svg class="cab-arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56" fill="none">
        <path d="M17.29 19.355L28 30.0416L38.71 19.355L42 22.645L28 36.645L14 22.645L17.29 19.355Z" fill="#060606"/>
        </svg>';
    }
}


