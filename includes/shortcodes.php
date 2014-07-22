<?php
/**
 * nwp_nrego_test($atts, $content = null):
 * function is just to test that the shortcodes are registering properly
 * @param string $test_string
 */
function nwp_nurego_test($atts, $content = null) {

    extract( shortcode_atts( array(
        'test' => ''
    ), $atts ) );

    echo $api_key;

}

/**
 * nwp_nurego_offering():
 * fetches an offering for the api_key it is called with
 * Will migrate to using the api_key set in the settings page??
 * @param string $api_key
 */
function nwp_nurego_offering($atts, $content = null) {

    // Load the nurego-js library at this time to use it 
    wp_enqueue_script('nurego-js');

    extract( shortcode_atts( array(
        'api_key' => ''
    ), $atts ) );

    // Ugly hack to render the javascript on the page
    // and then the table in the right spot.
    $output = '<script type="text/javascript">'
             .'alert("Hello");'
             .'jQuery( document ).ready( function() {'
             .'Nurego.setParam(\'element_id\', \'nwp_div\');'
             .'Nurego.setApiKey(' . "'". $api_key . "'" . ');'
             .'});'
             .'</script>'
             .'<div id=\'nwp_div\'>'
             .'</div>';

    return $output;
}

/**
 * Now we include all the shortcoes
 */
add_shortcode('nurego_test', 'nwp_nurego_test');
add_shortcode('nurego', 'nwp_nurego_offering');
?>

