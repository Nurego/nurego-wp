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
    echo '</div>';
}

// Hook in the submenu
add_action('admin_menu', 'register_nwp_submenu_page');
?>
