/**
 * JSONP Callback (global scope)
 */
var nr_callback = function () {
};
/**
 * Closure
 */
(function () {

    /**
     * Public object
     */
    this.Nurego = {};
    /**
     * set Param
     * @param {String} key
     * @param {String|Array} value
     */
    this.Nurego.setParam = function(key, value)
    {
        if (p.hasOwnProperty(key)) {
            p[key] = value;
        }
        else {
            throw "Undefined param '" + key + "'.";
        }

        return true;
    };

    /**
     * set Public Key
     * @param {String} api_key
     */

    this.Nurego.setApiKey = function(api_key)
    {
        this.setParam('api_key', api_key);

        //Save initialization
        try {
            nr_init();
        } catch (e) {
            nr_error(e);
        }
    };

    //Default params
    var p = {
        api_key: null,
        element_id: null,
        theme: 'nr-default',
        css_url: '',
        select_url: '/?plan_id=',
        select_callback: null,
        label_price: 'Monthly cost',
        label_select: 'Select',
        label_feature_on: '<span class="nr-check nr-yes"></span>',
        label_feature_off: '<span class="nr-check nr-no"></span>',
        label_before_price: '$',
        label_after_price: '',
        time_out: 5 * 1000, //Milliseconds,
        loading_class: 'nr-container nr-loading',
        error_class: 'nr-notify nr-red',
        warning_class: 'nr-notify nr-yellow',
        empty_class: 'nr-container nr-empty',
        price_class: 'nr-price',
        nurego_url: 'https://am-staging.nurego.com/',
        offerings_url: 'https://am-staging.nurego.com/v1/offerings?api_key=',
        jquery_url: 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
        template: '',
        plugin_url: '',
    };

    var timeout_func,
        container,
        b_loading,
        b_warning,
        b_error,
        b_empty;

    /**
     * Initialization
     */
    function nr_init() {

        //Load CSS styles
        if (p.theme && p.css_url) {
            var head = document.getElementsByTagName('head')[0],
                link = document.createElement('link');
            link.setAttribute('href', p.css_url);
            link.setAttribute('rel', 'stylesheet');
            link.setAttribute('type', 'text/css');
            head.appendChild(link);
        }
        
        //Load jquery
        if (!window.jQuery) {
          var jq = document.createElement('script'); jq.type = 'text/javascript';
          jq.src = p.jquery_url;
          document.getElementsByTagName('head')[0].appendChild(jq);
        }

        //Create main DOM elements
        container = document.createElement('div');
        if (p.theme) {
            container.setAttribute('class', p.theme);
        }

        b_loading = document.createElement('div');
        b_loading.setAttribute('class', p.loading_class);
        b_loading.style.display = 'none';

        b_warning = document.createElement('div');
        b_warning.setAttribute('class', p.warning_class);
        b_warning.style.display = 'none';

        b_error = document.createElement('div');
        b_error.setAttribute('class', p.error_class);
        b_error.style.display = 'none';

        b_empty = document.createElement('div');
        b_empty.setAttribute('class', p.empty_class);
        b_empty.style.display = 'none';

        container.appendChild(b_loading);
        container.appendChild(b_warning);
        container.appendChild(b_error);
        container.appendChild(b_empty);

        //Check if element exist
        if (p.element_id) {
            var element = document.getElementById(p.element_id);
            if (element) {
                element.appendChild(container);
            }
            else {
                document.body.appendChild(container);
                throw "Element '#" + p.element_id + "' not found.";
            }
        }
        else {
            document.body.appendChild(container);
        }

        //Show loading block
        b_loading.style.display = '';

        jQuery.getScript(p.plugin_url + '/js/template' + p.template + '.js');

        //Check
        if(!p.api_key) {
            throw "Api key is empty.";
        }

        //Timeout
        timeout_func = setTimeout(function () {
            try {
                //Hide loading block
                b_loading.style.display = 'none';

                //Try to get from cache
                var data = nr_cache_get();
                if (data) {
                    nr_draw(data, p);
                }
                else {
                    b_warning.appendChild(document.createTextNode('Pricing plans is currently not available.'));
                    b_warning.style.display = '';
                    b_empty.style.display = '';
                }
            } catch (e) {
                nr_error(e);
            }
        }, p.time_out);

        //Fetch pricing data
        var scr = document.createElement('script');
        scr.type = 'text/javascript';
        scr.async = true;
        scr.src = p.offerings_url //TODO document.location.protocol + '//..'
            + p.api_key
            + '&callback=nr_callback';
        var nr = document.getElementsByTagName('script')[0];
        nr.parentNode.insertBefore(scr, nr);
    }

    /**
     * Get pricing data from cache (HTML5 Web Storage)
     * @return {Array|Boolean}
     */
    function nr_cache_get() {

        //Check if browser supports HTML5 Web Storage
        if (typeof(Storage) === 'undefined' || typeof(window['localStorage']) === 'undefined') {
            return false;
        }

        return JSON.parse(window.localStorage.getItem('nr_' + p.api_key));
    }

    /**
     * Set pricing data to cache (HTML5 Web Storage)
     * @param {Array} data
     */
    function nr_cache_set(data) {

        //Check if browser supports HTML5 Web Storage
        if (typeof(Storage) === 'undefined' || typeof(window['localStorage']) === 'undefined') {
            return false;
        }

        return window.localStorage.setItem('nr_' + p.api_key, JSON.stringify(data));
    }

    /**
     * Prepare raw data
     * @param {Array} response
     */
    function nr_prepareData(response) {

        var raw_plans = response.plans.data;
        var features = [];
        var plans = [];

        //Get all features
        for (var i = 0; i < raw_plans.length; i++) {
            var plan_features = raw_plans[i].features.data;
            var tmp = {
                name: raw_plans[i].name,
                id: raw_plans[i].id,
                price: 0,
                features: [],
                discounts: raw_plans[i].discounts
            };
            for (j = 0; j < plan_features.length; j++) {
                if (plan_features[j].element_type === 'recurring') {
                    tmp.price = parseFloat(plan_features[j].price);
                }
                else {
                    if (features.indexOf(plan_features[j].name) === -1) {
                        features.push(plan_features[j].name);
                    }
                    tmp.features.push({
                        name: plan_features[j].name,
                        value: plan_features[j].max_unit ? plan_features[j].max_unit : p.label_feature_on
                    });
                }
            }
            plans.push(tmp);
        }
        return {
            features: features,
            plans: plans
        };
    }

    /**
     * Error handler
     * @param {String} e
     */
    function nr_error(e) {

        if (typeof nr_debug !== 'undefined' && nr_debug === true) {
            throw e;
        }
        else {
            //Show error block
            if (container) {
                b_loading.style.display = 'none';
                b_warning.style.display = 'none';
                b_error.appendChild(document.createTextNode(e));
                b_error.style.display = '';
                b_empty.style.display = '';
            }
            throw e;
        }
    }

    /**
     * JSONP Callback
     * @param {Array} response
     */
    nr_callback = function (response) {
        try {
            clearTimeout(timeout_func);

            //Check for API error
            if (typeof response.error !== 'undefined' && response.error) {
                throw response.error;
            }

            //Prepare and cache
            var data = nr_prepareData(response);
            if (data) {
                nr_cache_set(data);
            }

            //Hide loading block
            b_loading.style.display = 'none';

            nr_draw(data, p);
        } catch (e) {
            nr_error(e);
        }
    };

})();
