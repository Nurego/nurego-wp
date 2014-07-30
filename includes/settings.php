<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', __("Nurego WordPress", 'nwp-text-domain'), __("Nurego Wordpress Settings", 'nwp-text-domain'), 'edit_plugins', 'nwp-settings-menu', 'nwp_custom_submenu_page_callback');
}

/**
 * nwp_render_submenu_item($title, $option, $description);
 * Takes the title, option, and description and renders a table row
 *
 * Maybe start using this once it is determined if the strings will still
 * be caught for translation?
 *
 * @param string $title         Title to display
 * @param string $option        Slug for option
 * @param string $description   Text to describe option  
 */
function nwp_render_submenu_text_item($title, $option, $description) {
?>
    <tr valign="top">
    <th scope="row"><b><?php _e($title, 'nwp-text-domain');?>:</b></th>
    <td><input type="text" name="<?php echo $option;?>" value="<?php echo get_option($option);?>" />
    <label class="description" for="<?php echo $option;?>"><?php _e($description, 'nwp-text-domain');?></label>
    </td></tr>
<?php
}


/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {
?>
     <div class="wrap">
     <h2><?php _e('Nurego WordPress Settings', 'nwp-text-domain');?></h2>
           <p>
            <form method="POST" action="options.php">
            <?php settings_fields('nwp_settings_group');
            do_settings_sections('nwp_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row"><b><?php _e('Nurego Live API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" name="live_api_key" size="40" value="<?php echo get_option('live_api_key');?>" />
                        <label class="description" for="live_api_key">(<?php _e('Required', 'nwp-text-domain');?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><b><?php _e('Nurego Test API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" name="test_api_key" size="40" value="<?php echo get_option('test_api_key');?>" />
                        <label class="description" for="test_api_key">(<?php _e('Required', 'nwp-text-domain'); ?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><h3><?php _e('Display Settings', 'nwp-text-domain');?>:</h3></th>
                </tr>
                 <tr valign="top">
                <th scope="row"><?php _e('Use theme styling?', 'nwp-text-domain');?></th>
                    <td><input type="checkbox" name='use_theme_css' value='1' <?php checked(get_option('use_theme_css'), true);?> />
                        <label class="description" for="use_theme_css"><?php _e('Check to use your built in theme settings for the pricing table. Overrides all other style settings.');?></label>
                    </td>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Custom CSS Url', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="css_url" value="<?php echo get_option('css_url');?>" />
                            <label class="description" for="css_url"><?php _e('The ABSOLUTE Url to the custom CSS file to be used',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Table Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='background' value="<?php echo get_option('background');?>" />
                    <label class="description" for="background"><?php _e('Hex value for table background color',
                                                                          'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='font' value="<?php echo get_option('font');?>" />
                    <label class="description" for="font"><?php _e('Hex value for table font color',
                                                                          'nwp-text-domain');?></label>
                </tr> 
               <tr valign="top">
                <th scope="row"><?php _e('Label Price', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_price" value="<?php echo get_option('label_price');?>" />
                        <label class="description" for="label_price"><?php _e('Label in the price column',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Label Select', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_select" value="<?php echo get_option('label_select');?>" />
                        <label class="description" for="label_select"><?php _e('Label on the select buttons', 
                                                                               'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Prefix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_before_price" value="<?php echo get_option('label_before_price');?>" />
                        <label class="description" for="lable_before_price"><?php _e('Price preffix (ie $ for $1.00)', 
                                                                                     'nwp-text-domain');?>.</label>
                        </td>
                 </tr>
                 <tr valign="top">
                 <th scope="row"><?php _e('Price Suffix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="label_after_price" value="<?php echo get_option('label_after_price');?>" />
                        <label class="description" for=""><?php _e('Price suffix (ie $ for 1.00$)',
                                                                   'nwp-text-domain');?>.</label>
                        </td>
                <tr valign="top">
                <th scope="row"><?php _e('Element ID', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="element_id" value="<?php echo get_option('element_id');?>" />
                            <label class="description" for="element_id"><?php _e('The ID of the HTML element you want the offering table appended to', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><h3><?php _e('Render Settings', 'nwp-text-domain');?>:</h3></th>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Loading Timeout', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="time_out" value="<?php echo get_option('time_out');?>" />
                        <label class="description" for="time_out"><?php _e('The amount of time in milliseconds to wait before timing out when loading an offering',
                                                                           'nwp-text-domain');?>.</label>
                        </td>
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
    register_setting('nwp_settings_group', 'background');
    register_setting('nwp_settings_group', 'font');
    register_setting('nwp_settings_group', 'primary_color');
    register_setting('nwp_settings_group', 'secondary_color');
    register_setting('nwp_settings_group', 'tertiary-color');
    register_setting('nwp_settings_group', 'use_theme_css');
}
?>
