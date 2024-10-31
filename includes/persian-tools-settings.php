<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}



function persian_tools_add_admin_menu() {
    add_menu_page(
        'تنظیمات افزونه پارسی تولز', 
        'Persian Tools',
        'manage_options',
        'persian-tools',
        'persian_tools_settings_page',
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'persian_tools_add_admin_menu');


function persian_tools_enqueue_scripts($hook_suffix) {
    if ($hook_suffix !== 'toplevel_page_persian-tools') {
        return;
    }
// CSS
wp_enqueue_style('persian-tools-style', PERSIAN_TOOLS_ASSETS_PATH . '/css/persian-tools.css', array(), PERSIAN_TOOLS_VERSION);

// JS
wp_enqueue_script('persian-tools-script', PERSIAN_TOOLS_ASSETS_PATH . '/js/persian-tools.js', array('jquery'), PERSIAN_TOOLS_VERSION, true);

}
add_action('admin_enqueue_scripts', 'persian_tools_enqueue_scripts');


function persian_tools_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Persian Tools Settings', 'persian-tools'); ?></h1>
        <!-- Tabs Warpper -->
        <h2 class="nav-tab-wrapper">
            <a href="#tab-font" class="nav-tab nav-tab-active" id="tab-font-link">فونت سایت</a>
            <a href="#tab-misc" class="nav-tab" id="tab-misc-link">متفرقه</a>
        </h2>

        <!-- Tabs Content -->
        <div id="tab-font" class="tab-content">
            <form method="post" action="options.php">
                <?php
                settings_fields('persian_tools_settings_group');
                do_settings_sections('persian-tools-font');
                submit_button();
                ?>
            </form>
        </div>

        <!-- Tab 2 -->
        <div id="tab-misc" class="tab-content" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('persian_tools_settings_group');
                do_settings_sections('persian-tools-misc');
                submit_button();
                ?>
            </form>
        </div>

    </div>
    <?php
}


function persian_tools_sanitize_font_choice($input) {

    return sanitize_text_field($input);
}

function persian_tools_sanitize_delete_on_uninstall($input) {

    return (bool) $input;
}

function persian_tools_settings_init() {
    register_setting('persian_tools_settings_group', 'persian_tools_option');
    
    register_setting(
        'persian_tools_settings_group',
        'persian_tools_delete_on_uninstall',
        array(
            'sanitize_callback' => 'persian_tools_sanitize_delete_on_uninstall'
        )
    );
    
    register_setting(
        'persian_tools_settings_group',
        'persian_tools_font_choice',
        array(
            'sanitize_callback' => 'persian_tools_sanitize_font_choice'
        )
    );

    add_settings_section(
        'persian_tools_settings_section_font',
        'تنظیمات فونت',
        'persian_tools_settings_section_callback_font',
        'persian-tools-font'
    );

    add_settings_section(
        'persian_tools_settings_section_misc',
        'تنظیمات متفرقه',
        'persian_tools_settings_section_callback_misc',
        'persian-tools-misc'
    );

    add_settings_field(
        'persian_tools_font_choice',
        'انتخاب فونت سایت',
        'persian_tools_font_choice_callback',
        'persian-tools-font',
        'persian_tools_settings_section_font'
    );

    add_settings_field(
        'persian_tools_delete_on_uninstall',
        'حذف تنظیمات و پیکربندی پس از حذف افزونه',
        'persian_tools_delete_on_uninstall_callback',
        'persian-tools-misc',
        'persian_tools_settings_section_misc'
    );
}
add_action('admin_init', 'persian_tools_settings_init');



function persian_tools_settings_section_callback_font() {
    echo 'تنظیمات فونت سایت را از اینجا انتخاب کنید.';
}


function persian_tools_settings_section_callback_misc() {
    echo 'تنظیمات متفرقه را از اینجا انتخاب کنید.';
}


function persian_tools_font_choice_callback() {
    $option = get_option('persian_tools_font_choice');
    ?>
    <select name="persian_tools_font_choice">
        <option value="vazir" <?php selected($option, 'vazir'); ?>>وزیر</option>
        <option value="sahel" <?php selected($option, 'sahel'); ?>>ساحل</option>
    </select>
    <?php
}

// Callback Uninstall
function persian_tools_delete_on_uninstall_callback() {
    $option = get_option('persian_tools_delete_on_uninstall');
    ?>
    <input type="checkbox" name="persian_tools_delete_on_uninstall" value="1" <?php checked(1, $option, true); ?>>
    <?php
}