Nurego WordPress Plugin
=======================

This is a WordPress plugin for easy interaction with the Nurego API.
It is a wrapper for the javascript library that also does the tweaking necessary
to work correctly with WordPress.

It may evolve to be more than just a wrapper, but for now nurego.js does all of the
heavy lifting.

It renders a basic html table so it is most likely compatible with your current
WordPress theme. Read the **Parameters** and **Usage** sections to see exactly how thisis done.


Usage
-----

    Basic
    [nurego api_key='<YOUR API KEY>"]

    Passing in parameters
    [nurego api_key='<YOUR API KEY>' param='<VALUE>']

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

