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

    extract( shortcode_atts( array(
        'api_key' => ''
    ), $atts ) );

    // Ugly hack to render the javascript on the page
    echo '<script type="text/javascript">' 
        .'alert("Hello");'
        ,'jQuery( document ).ready( function() {'
        ,'Nurego.setApiKey(' . "'". $api_key . "'" . ');'
        ,'};'
        ,'</script>';
}

/**
 * Now we include all the shortcoes
 */
add_shortcode('nurego_test', 'nwp_nurego_test');
add_shortcode('nurego', 'nwp_nurego_offering');
?>

