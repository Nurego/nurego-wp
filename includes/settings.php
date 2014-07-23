<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', "Nurego WordPress", __("Nurego Wordpress Settings", 'nwp-text-domain'), 'edit_plugins', 'nwp-settings-menu', 'nwp_custom_submenu_page_callback');
}

/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {
?>
     <div class="wrap">
     <h2><?php __('Nurego WordPress Settings', 'nwp-text-domain');?></h2>
           <p>
            <form method="POST" action="options.php">
            <?php settings_fields('nwp_settings_group');
            do_settings_sections('nwp_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row"><b><?php __('Nurego Live API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" name="live_api_key" size="40" value="<?php echo get_option('live_api_key');?>" />
                        <label class="description" for="live_api_key">(<?php __('Required', 'nwp-text-domain');?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><b><?php __('Nurego Test API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" name="test_api_key" size="40" value="<?php echo get_option('test_api_key');?>" />
                        <label class="description" for="test_api_key">(<?php __('Required', 'nwp-text-domain'); ?>)</label>
                        </td>
                </tr>
                <tr valign="top">

                <th scope="row"><h3><?php __('Optional Settings', 'nwp-text-domain');?>:</h3></th>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Element ID', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="element_id" value="<?php echo get_option('element_id');?>" />
                            <label class="description" for="element_id"><?php __('The ID of the HTML element you want the offering table appended to', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Theme', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="theme" value="<?php echo get_option('theme');?>" />
                            <label class="description" for="theme"><?php __('The CSS class for the pricing table',
                                                                            'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Custom CSS Url', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="css_url" value="<?php echo get_option('css_url');?>" />
                            <label class="description" for="css_url"><?php __('The ABSOLUTE Url to the custom CSS file to be used',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Select Url', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="select_url" value="<?php echo get_option('select_url');?>" />
                        <label class="description" for="select_url"><?php __('Url prefix for plan links',
                                                                             'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Select Callback', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="select_callback" value="<?php echo get_option('select_callback');?>" />
                        <label class="description" for="select_callback"><?php __('Callback function executed when a plan is selected',
                                                                                  'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Label Price', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_price" value="<?php echo get_option('label_price');?>" />
                        <label class="description" for="label_price"><?php __('Label in the price column',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Label Select', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_select" value="<?php echo get_option('label_select');?>" />
                        <label class="description" for="label_select"><?php __('Label on the select buttons', 
                                                                               'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Label Feature On', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_feature_on" value="<?php echo get_option('label_feature_on');?>" />
                        <label class="description" for="label_feature_on"><?php __('Text to render for features that are on. Can be HTML',
                                                                                   'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Label Feature Off', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_feature_off" value="<?php echo get_option('label_feature_off');?>" />
                        <label class="description" for="label_feature_off"><?php __('Text to render for features that are off. Can be HTML',
                                                                                    'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php __('Price Prefix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_before_price" value="<?php echo get_option('label_before_price');?>" />
                        <label class="description" for="lable_before_price"><?php __('Price preffix (ie $ for $1.00)', 
                                                                                     'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Price Suffix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_after_price" value="<?php echo get_option('label_after_price');?>" />
                        <label class="description" for=""><?php __('Price suffix (ie $ for 1.00$)',
                                                                   'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Loading Timeout', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="time_out" value="<?php echo get_option('time_out');?>" />
                        <label class="description" for="time_out"><?php __('The amount of time in milliseconds to wait before timing out when loading an offering',
                                                                           'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Loading Class', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="loading_class" value="<?php echo get_option('loading_class');?>" />
                        <label class="description" for="loading_class"><?php __('CSS class for loading block',
                                                                                'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Error Class', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="error_class" value="<?php echo get_option('error_class');?>" />
                        <label class="description" for="error_class"><?php __('CSS class for error block',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Warning Class', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="warning_class" value="<?php echo get_option('warning_class');?>" />
                        <label class="description" for="warning_class"><?php __('CSS class for warning block',
                                                                                'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Empy Class', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="empty_class" value="<?php echo get_option('empty_class');?>" />
                        <label class="description" for="empty_class"><?php __('CSS class for an empty block',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                 <tr valign="top">
                 <th scope="row"><?php __('Price Class', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="price_class" value="<?php echo get_option('price_class');?>" />
                        <label class="description" for="price_class"><?php __('CSS class for price block',
                                                                              'nwp-text-domain');?>.</label></td>
                </tr>
                <tr valign="top">
                    <td><?php submit_button(); ?></td>
               </tr>
           </form></p>
    </div> <?php
}

/**
 * Register all of the settings we intend to show on the settings page
 */
function register_nwp_settings() {
    register_setting('nwp_settings_group', 'live_api_key');
    register_setting('nwp_settings_group', 'test_api_key');
    register_setting('nwp_settings_group', 'element_id');
    register_setting('nwp_settings_group', 'theme');
    register_setting('nwp_settings_group', 'css_url');
    register_setting('nwp_settings_group', 'select_url');
    register_setting('nwp_settings_group', 'select_callback');
    register_setting('nwp_settings_group', 'label_price');
    register_setting('nwp_settings_group', 'label_select');
    register_setting('nwp_settings_group', 'label_feature_on');
    register_setting('nwp_settings_group', 'label_feature_off');
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
