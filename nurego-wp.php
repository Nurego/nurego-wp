<?php
/**
 * Plugin Name: Nurego WordPress
 * Plugin URI: http://www.nurego.com
 * Description Nurego integration for your WordPress site.
 * Version: 0.1
 * Author: Erik Barzdukas
 * Author URI: https://github.com/erikbarzdukas
 * License: GPL2
 *
 *  Copyright 2014  Erik Barzdukas  (email : erik.barzdukas@gmail.com)

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
 * Load external resources
 * namely the nurego-js javascript
 */
function nwp_get_nurego_js() {
    wp_register_script('nurego-js', "http://js.nurego.com/v1/lib/js/nurego.js");
}

//Make sure the script is included
add_action('init', 'nwp_get_nurego_js'); 

?>
