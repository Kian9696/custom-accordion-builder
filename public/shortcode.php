<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function cab_render_accordion_shortcode( $atts ) {
    $atts = shortcode_atts( [
        'id' => ''
    ], $atts );

    $id = sanitize_title( $atts['id'] );
    $accordions = get_option( 'cab_accordions', [] );

    if ( ! isset( $accordions[$id] ) ) {
        return '<p><strong>Accordion not found:</strong> ' . esc_html($id) . '</p>';
    }

    $items = $accordions[$id];
    $output = '<div class="cab-accordion-wrapper" data-accordion-id="' . esc_attr($id) . '">';

    foreach ( $items as $index => $item ) {
        $title = esc_html( $item['title'] );
        $content = wp_kses_post( $item['content'] );

        $output .= '
        <div class="cab-accordion-item">
            <button class="cab-accordion-header" aria-expanded="false" aria-controls="cab-panel-' . esc_attr($id) . '-' . $index . '" id="cab-header-' . esc_attr($id) . '-' . $index . '">
                ' . $title . '
            </button>
            <div class="cab-accordion-panel" id="cab-panel-' . esc_attr($id) . '-' . $index . '" role="region" aria-labelledby="cab-header-' . esc_attr($id) . '-' . $index . '">
                <div class="cab-accordion-content">' . $content . '</div>
            </div>
        </div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode( 'custom_accordion', 'cab_render_accordion_shortcode' );
