<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


function persian_tools_add_font_css() {
    // Registering the style once
    wp_register_style('persian-tools', false, [], PERSIAN_TOOLS_VERSION); // No external file, for inline styles
    wp_enqueue_style('persian-tools');

    $font_choice = get_option('persian_tools_font_choice');

    // Conditional styles based on font choice
    if ($font_choice === 'vazir') {
        $custom_css = "
            @font-face {
                font-family: 'IRVazir';
                src: url('" . esc_url(plugins_url('fonts/IRVazir.woff', __FILE__)) . "') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'IRVazir-Bold';
                src: url('" . esc_url(plugins_url('fonts/IRVazir-Bold.woff', __FILE__)) . "') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            body {
                font-family: 'IRVazir', sans-serif;
            }
        ";
        wp_add_inline_style('persian-tools-fonts', $custom_css);
    } elseif ($font_choice === 'sahel') {
        $custom_css = "
            @font-face {
                font-family: 'IRSahel';
                src: url('" . esc_url(plugins_url('fonts/IRSahel.woff2', __FILE__)) . "') format('woff2');
                font-weight: normal;
                font-style: normal;
            }
			@font-face {
                font-family: 'IRSahel-Bold';
                src: url('" . esc_url(plugins_url('fonts/IRSahel.woff2', __FILE__)) . "') format('woff2');
                font-weight: normal;
                font-style: normal;
            }
            body {
                font-family: 'IRYekan', sans-serif;
            }
        ";
        wp_add_inline_style('persian-tools-fonts', $custom_css);
    }
    
}
add_action('wp_enqueue_scripts', 'persian_tools_add_font_css');


// Uninstall
function persian_tools_uninstall() {
    if (get_option('persian_tools_delete_on_uninstall')) {
        delete_option('persian_tools_option');
        delete_option('persian_tools_delete_on_uninstall');
        delete_option('persian_tools_font_choice');
    }
}
register_uninstall_hook(__FILE__, 'persian_tools_uninstall');