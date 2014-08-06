<?php
/**
 * nwp_nurego_offering():
 * fetches an offering for the api_key it is called with
 *
 * Following params are can be passed through shortcode
 *  ie [nurego param="value"]
 *
 * @param string $api_key
 * @param string $element_id         ID of DOM element
 * @param string $theme              CSS class for pricing table
 * @param string $css_url            URL to css file if non-default is desired
 * @param string $select_url         URL prefix for plan link
 * @param function $select_callback  Callback function for pricing plan
 * @param string $label_price        Label in price column
 * @param string $label_select       Label on select button
 * @param string $label_feature_on   String for enabled option
 * @param string $label_feature_off  String for disabled option
 * @param string $label_before_price Prefix for price value (currency)
 * @param string $label_after_price  Suffix for price value (currency)
 * @param integer $time_out          Timeout in milliseconds
 * @param string $loading_class      CSS class for loading block
 * @param string $error_class        CSS class for error block
 * @param string $warning_class      CSS class for warning block
 * @param string $empty_class        CSS class for empty block
 * @param string $price_class        CSS class for price block
 */
function nwp_nurego_offering($atts, $content = null) {

    // Load the nurego-js library at this time to use it 
    wp_enqueue_script('nurego-js');

    // Need easyXDM too
    wp_enqueue_script('nwp_easyXDM');

    // Load all potential params from symbol table
    $a = shortcode_atts( array(
        'api_key'            => '',
        'element_id'         => 'nwp_div',   // Default for correct placement
        'theme'              => '',
        'css_url'            => '',
        'select_url'         => '',
        'select_callback'    => '',
        'label_price'        => '',
        'label_select'       => '',
        'label_feature_on'   => '',
        'label_feature_off'  => '',
        'label_before_price' => '',
        'label_after_price'  => '',
        'time_out'           => '',
        'error_class'        => '',
        'warning_class'      => '',
        'empty_class'        => '',
        'price_class'        => '',
        'plugin_url'         => plugin_dir_url(__FILE__),
        'template'           => '1',
    ), $atts );

    // Top part of JS sandwich that will be returned
    $output_top = '<script type="text/javascript">'
        .'jQuery( document ).ready( function() {';

    // Middle part of sandwich w/params
    $output_middle = '';
    foreach ($a as $key => $value) {
        if ($value != '' && $key != 'api_key') {
            $output_middle .= 'Nurego.setParam(\''.$key .'\',\''.$value.'\');';
        } else {
            // Debugging code:
            //$output_middle .='<!--Tried to set: '.$key.' with value: '.$value.'-->';
            continue;
        };
    };
    
    $output_bottom = 'Nurego.setApiKey(' . "'". $a['api_key'] . "'" . ');'
        .'});'
        .'</script>'
        .'<div id=\'nwp_div\'>' // Default div to specify for correct placement
        .'</div>';

    // Combine it all for the correct output
    $output = $output_top . $output_middle . $output_bottom;

    return $output;
}

/**
 * nwp_nurego_live_shortcode 
 * Following params are set in the settings page
 *
 * @param string $live_api_key
 * @param string $element_id         ID of DOM element
 * @param string $theme              CSS class for pricing table
 * @param string $css_url            URL to css file if non-default is desired
 * @param string $select_url         URL prefix for plan link
 * @param function $select_callback  Callback function for pricing plan
 * @param string $label_price        Label in price column
 * @param string $label_select       Label on select button
 * @param string $label_feature_on   String for enabled option
 * @param string $label_feature_off  String for disabled option
 * @param string $label_before_price Prefix for price value (currency)
 * @param string $label_after_price  Suffix for price value (currency)
 * @param integer $time_out          Timeout in milliseconds
 * @param string $loading_class      CSS class for loading block
 * @param string $error_class        CSS class for error block
 * @param string $warning_class      CSS class for warning block
 * @param string $empty_class        CSS class for empty block
 * @param string $price_class        CSS class for price block
 */
function nwp_nurego_from_settings_shortcode($atts, $content = null) {

    //Global settings arrays
    global $nwp_render_options;
    global $nwp_display_options;
    global $nwp_key_options;

    // Skip these values because they are 'meta' values
    // for other values in the array
    $skip_keys = array('css_url',
        'theme_css',
        'background',
        'plan_font_color',
        'price_color',
        'plan_background_color',
        'button_color',
        'button_text_color',
        'use_theme_css',
    );

    // Load the nurego-js library with the correct template
    // at this time to use it 
    wp_enqueue_script('nurego-js');

    // Need easyXDM too
    wp_enqueue_script('nwp_easyXDM'); 
    
    // Top part of JS sandwich that will be returned
    $output_top = '<script type="text/javascript">'
        .'jQuery( document ).ready( function() {';

    // Iterate through and set the parameters
    $output_middle = '';
    foreach ($nwp_render_options as $key => $value) {
        if (isset($nwp_render_options[$key]) && $nwp_render_options[$key] != '' && ! in_array($key, $skip_keys)) {
            $output_middle .= 'Nurego.setParam(\''.$key .'\',\''.$value.'\');';
        } else {
            // Throw debugging stuff here as needed
            continue;
        }
    }

    foreach ($nwp_display_options as $key => $value) {
        if (isset($nwp_display_options[$key]) && $nwp_display_options[$key] != '' && ! in_array($key, $skip_keys)) {
            $output_middle .= 'Nurego.setParam(\''.$key .'\',\''.$value.'\');';
        } else {
            // Throw debugging stuff here as needed
            continue;
        }
    }

    //Make sure the CSS is there
    $output_middle .= nwp_handle_css();

    //Render the table where the shortcode is
    $output_middle .= 'Nurego.setParam(\'element_id\',\'nwp_div\');';

    //Feed the drawing functions the plugin dir
    $output_middle .= 'Nurego.setParam(\'plugin_url\',\''.plugin_dir_url(__FILE__).'\');';

    //Bottom part of sandwich
    $output_bottom = 'Nurego.setApiKey(' . "'". $nwp_key_options['api_key'] . "'" . ');';

    $output_bottom .= '});'
        .'</script>'
        .'<div id=\'nwp_div\'>' // Default div to specify for correct placement
        .'</div>';

    // Combine it all for the correct output
    $output = $output_top . $output_middle . $output_bottom;

    return $output;
}

/**
 * nwp_handle_css()
 *
 * Handles including the correct CSS stylesheet 
 */
function nwp_handle_css() { 

    global $nwp_display_options;
               
    if (isset($nwp_display_options['use_theme_css']) && $nwp_display_options['use_theme_css']  == true) {
        // Include nothing so that the theme's styelsheet is used
        return;
    } else if (isset($nwp_display_options['css_url']) && $nwp_display_options['css_url']) {
        // Include the stylesheet specified by the user in the settings page
        return 'Nurego.setParam(\'css_url\','. $nwp_display_options['css_url'].');';
    } else {
        // Include the stylesheet dynamically generated using settings
        include(NUREGO_BASE_DIR . '/includes/css.php');
        return;
    }
}



/**
 * Now we include all the shortcodes
 */
add_shortcode('nurego', 'nwp_nurego_from_settings_shortcode');
add_shortcode('nurego-custom', 'nwp_nurego_offering');
?>

