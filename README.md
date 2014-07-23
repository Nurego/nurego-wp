Nurego WordPress Plugin
=======================

This is a WordPress plugin for easy interaction with the Nurego API.
It is a wrapper for the javascript library that also does the tweaking necessary
to work correctly with WordPress.


Usage
-----

###Basic
Once installed, visit the Nurego-WP Settings page in the Settings menu to enter in your
Nurego live and test API keys. You can set the optional settings if you'd like.

Then render the offering like so:

    Basic
    [nurego-test] // Loads from your test API key you saved.

    [nurego-live] // Loads from the live API key you saved.

###Advanced
Included is a shortcode that renders based on what you pass it, for more advanced and customizable 
use cases such as loading differnt CSS styles on different pages.

    Advanced
    [nurego api_key="<YOUR API KEY>" param="<VALUE>"]

Check out **Parameters** below to see what settings are available to you. 

Parameters
----------

    element_id: null, //Id of the DOM element. (string or null)
    theme: 'nr-default', //CSS class for pricing table. (string or null)
    css_url: 'http://js.nurego.com/v1/lib/css/themes.css', //Url to custom CSS file. (string or null)
    select_url: '/?plan_id=', //Url prefix for plan link. (string)
    select_callback: null, //Callback function after selecting plan. (function or null)
    label_price: 'Monthly cost', //Label in Price column. (string)
    label_select: 'Select', //Label on Select button. (string)
    label_feature_on: '<span class="nr-check nr-yes"></span>', //String for enabled option. (string)
    label_feature_off: '<span class="nr-check nr-no"></span>', //String for disabled option. (string)
    label_before_price: '$', //Prefix for price value. (string)
    label_after_price: '', //Suffix for price value. (string)
    time_out: 5 * 1000, //Timeout in milliseconds. (integer)
    loading_class: 'nr-container nr-loading',  //CSS class for loading block. (string)
    error_class: 'nr-notify nr-red', //CSS class for error block. (string)
    warning_class: 'nr-notify nr-yellow', //CSS class for waring block. (string)
    empty_class: 'nr-container nr-empty', //CSS class for empty block. (string)
    price_class: 'nr-price', //CSS class for price block. (string)

