<?php
/**
 * Plugin Name: Nurego WordPress
 * Plugin URI: http://www.nurego.com
 * Description Nurego integration for your WordPress site.
 * Version: 1.0.0
 * Text Domain: nwp-text-domain
 * Author: Erik Barzdukas
 * Author URI: https://github.com/erikbarzdukas
 * License: GPL2
 *
 *  Copyright 2014  Nurego  (email : info@nurego.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */


/**
 * Globals and constants definitions
 * Just need easy access to file paths
 */

if(!defined('NUREGO_BASE_URL')) {
    define('NUREGO_BASE_URL', plugin_dir_url(__FILE__));
}

if(!defined('NUREGO_BASE_DIR')) {
    define('NUREGO_BASE_DIR', dirname(__FILE__));
}

/**
 * Includes
 */

if(is_admin()) {
    //Loads admin settings
    include(NUREGO_BASE_DIR . '/includes/settings.php');
    add_action('admin_init', 'register_nwp_settings');
    add_action('admin_menu', 'register_nwp_submenu_page');
} else {
    //Load up the rest
    include(NUREGO_BASE_DIR . '/includes/shortcodes.php');
}

/**
 * Load the text domain for proper internationalization and 
 * localization. Checkout /languages/ to translate
 */
function nwp_load_text_domain() {
    load_plugin_textdomain('nwp-text-domain', false, dirname(plugin_basename(__FILE__)). '/languages');
}

// Load text domain on init
add_action('init', 'nwp_load_text_domain');

/**
 * Load external resources
 * namely the nurego-js javascript
 */
function nwp_get_nurego_js() {
    # Using a local/customized copy
    wp_register_script('nurego-js', NUREGO_BASE_URL . '/includes/js/nurego.js');
}

function nwp_load_easyXDM() {
    # I keeps them in includes/js/easyXDM/
    wp_register_script('nwp_easyXDM', NUREGO_BASE_URL . '/includes/js/easyXDM/easyXDM.min.js');
}
function nwp_load_jscolor() {
    wp_register_script('nwp_jscolor', NUREGO_BASE_URL . '/includes/js/jscolor.js');
}

//Make sure the scripts are included
add_action('init', 'nwp_get_nurego_js'); 
add_action('init', 'nwp_load_easyXDM');
add_action('init', 'nwp_load_jscolor');
?>
