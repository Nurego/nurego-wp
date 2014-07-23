<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', "Nurego-WP Settings", "Nurego-WP Settings", 'edit_plugins', 'nwp-settings-menu', 'nwp_custom_submenu_page_callback');
}

/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {

    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Nurego WordPress Setting Page</h2>';
    echo '<p>';
    echo '<form method="POST" action="options.php">';
    settings_fields('nwp_settings_group');
    do_settings_sections('nwp_settings_group');
    submit_button();
    echo '</form>';
    echo '</div>';
}

/**
 * Register all of the settings we intend to show on the settings page
 */
function register_nwp_settings() {
    register_setting('nwp_settings_group', 'element_id');
    register_setting('nwp_settings_group', 'theme');
    register_setting('nwp_settings_group', 'css_url');
    register_setting('nwp_settings_group', 'select_url');
    register_setting('nwp_settings_group', 'select_callback');
    register_setting('nwp_settings_group', 'label_price');
    register_setting('nwp_settings_group', 'label_select');
    register_setting('nwp_settings_group', 'label_feature_on');
    register_setting('nwp_settings_group', 'label_feature_on');
    register_setting('nwp_settings_group', 'label_before_price');
    register_setting('nwp_settings_group', 'label_after_price');
    register_setting('nwp_settings_group', 'time_out');
    register_setting('nwp_settings_group', 'loading_class');
    register_setting('nwp_settings_group', 'error_class');
    register_setting('nwp_settings_group', 'warning_class');
    register_setting('nwp_settings_group', 'empty_class');
    register_setting('nwp_settings_group', 'price_class');
}
?>
