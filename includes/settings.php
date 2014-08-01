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
                        <td><input type="text" name="nwp_live_api_key" size="40" value="<?php echo get_option('nwp_live_api_key');?>" />
                        <label class="description" for="nwp_live_api_key">(<?php _e('Required', 'nwp-text-domain');?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><b><?php _e('Nurego Test API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" name="nwp_test_api_key" size="40" value="<?php echo get_option('nwp_test_api_key');?>" />
                        <label class="description" for="nwp_test_api_key">(<?php _e('Required', 'nwp-text-domain'); ?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><h3><?php _e('Display Settings', 'nwp-text-domain');?>:</h3></th>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Use theme styling?', 'nwp-text-domain');?></th>
                    <td><input type="checkbox" name='nwp_use_theme_css' value='1' <?php checked(get_option('nwp_use_theme_css'), true);?> />
                        <label class="description" for="nwp_use_theme_css"><?php _e('Check to use your built in theme settings for the pricing table. Overrides all other style settings.');?></label>
                    </td>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Table Template', 'nwp-text-domain');?>:</th>
                    <td><select name="nwp_template">
                        <option value="1" <?php selected(get_option('nwp_template'), 1);?>><?php _e('Template 1', 'nwp-text-domain');?></option>
                        <option value="2" <?php selected(get_option('nwp_template'), 2);?>><?php _e('Template 2', 'nwp-text-domain');?></option>
                        <option value="3" <?php selected(get_option('nwp_template'), 3);?>><?php _e('Template 3', 'nwp-text-domain');?></option>
                        </select>
                        <label class="description" for="nwp_template"><?php _e('Choose the layout of your pricing table', 'nwp-text-domain');?></label>
                    </td>
                <tr valign="top">
                <th scope="row"><?php _e('Custom CSS Url', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="nwp_css_url" value="<?php echo get_option('nwp_css_url');?>" />
                            <label class="description" for="nwp_css_url"><?php _e('The ABSOLUTE Url to the custom CSS file to be used',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Table Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_background' value="<?php echo get_option('nwp_background');?>" />
                    <label class="description" for="nwp_background"><?php _e('Hex value for table background color',
                                                                          'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Plan Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_plan_font_color' value="<?php echo get_option('nwp_plan_font_color');?>" />
                    <label class="description" for="nwp_plan_font_color"><?php _e('Hex value for plan font color',
                                                                          'nwp-text-domain');?></label>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_price_color' value="<?php echo get_option('nwp_price_color');?>" />
                    <label class="description" for="nwp_price_color"><?php _e('Hex value for price font color',
                                                                          'nwp-text-domain');?></label>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Primary Accent Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_primary_color' value="<?php echo get_option('nwp_primary_color');?>" />
                    <label class="description" for="nwp_primary_color"><?php _e('Primary color for pricing table',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Secondary Accent Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_secondary_color' value="<?php echo get_option('nwp_secondary_color');?>" />
                    <label class="description" for="nwp_secondary_color"><?php _e('Secondary color for pricing table',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Plan Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" name='nwp_plan_background_color' value="<?php echo get_option('nwp_plan_background_color');?>" />
                    <label class="description" for="nwp_plan_background_color"><?php _e('Background color for plans in the pricing table',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Label Price', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="nwp_label_price" value="<?php echo get_option('nwp_label_price');?>" />
                        <label class="description" for="nwp_label_price"><?php _e('Label in the price column',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Label Select', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="nwp_label_select" value="<?php echo get_option('nwp_label_select');?>" />
                        <label class="description" for="nwp_label_select"><?php _e('Label on the select buttons', 
                                                                               'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Prefix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="nwp_label_before_price" value="<?php echo get_option('nwp_label_before_price');?>" />
                        <label class="description" for="nwp_label_before_price"><?php _e('Price preffix (ie $ for $1.00)', 
                                                                                     'nwp-text-domain');?>.</label>
                        </td>
                 </tr>
                 <tr valign="top">
                 <th scope="row"><?php _e('Price Suffix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="nwp_label_after_price" value="<?php echo get_option('nwp_label_after_price');?>" />
                        <label class="description" for="nwp_label_after_price"><?php _e('Price suffix (ie $ for 1.00$)',
                                                                   'nwp-text-domain');?>.</label>
                        </td>
                <tr valign="top">
                <th scope="row"><?php _e('Element ID', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="nwp_element_id" value="<?php echo get_option('nwp_element_id');?>" />
                            <label class="description" for="nwp_element_id"><?php _e('The ID of the HTML element you want the offering table appended to', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><h3><?php _e('Render Settings', 'nwp-text-domain');?>:</h3></th>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Select URL', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="nwp_select_url" value="<?php echo get_option('nwp_select_url');?>" />
                            <label class="description" for="nwp_select_url"><?php _e('The ID of the HTML element you want the offering table appended to', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Select Callback', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" name="nwp_select_callback" value="<?php echo get_option('nwp_select_callback');?>" />
                            <label class="description" for="nwp_select_callback"><?php _e('The ID of the HTML element you want the offering table appended to', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
               </tr>
               <tr valign="top">
                <th scope="row"><?php _e('Loading Timeout', 'nwp-text-domain');?>:</th>
                        <td><input type="text" name="nwp_time_out" value="<?php echo get_option('nwp_time_out');?>" />
                        <label class="description" for="nwp_time_out"><?php _e('The amount of time in milliseconds to wait before timing out when loading an offering',
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
    register_setting('nwp_settings_group', 'nwp_live_api_key');
    register_setting('nwp_settings_group', 'nwp_test_api_key');
    register_setting('nwp_settings_group', 'nwp_element_id');
    register_setting('nwp_settings_group', 'nwp_theme');
    register_setting('nwp_settings_group', 'nwp_css_url');
    register_setting('nwp_settings_group', 'nwp_select_url');
    register_setting('nwp_settings_group', 'nwp_select_callback');
    register_setting('nwp_settings_group', 'nwp_label_price');
    register_setting('nwp_settings_group', 'nwp_label_select');
    register_setting('nwp_settings_group', 'nwp_label_feature_on');
    register_setting('nwp_settings_group', 'nwp_label_feature_off');
    register_setting('nwp_settings_group', 'nwp_label_before_price');
    register_setting('nwp_settings_group', 'nwp_label_after_price');
    register_setting('nwp_settings_group', 'nwp_time_out');
    register_setting('nwp_settings_group', 'nwp_loading_class');
    register_setting('nwp_settings_group', 'nwp_error_class');
    register_setting('nwp_settings_group', 'nwp_warning_class');
    register_setting('nwp_settings_group', 'nwp_empty_class');
    register_setting('nwp_settings_group', 'nwp_price_class');
    register_setting('nwp_settings_group', 'nwp_background');
    register_setting('nwp_settings_group', 'nwp_plan_font_color');
    register_setting('nwp_settings_group', 'nwp_primary_color');
    register_setting('nwp_settings_group', 'nwp_secondary_color');
    register_setting('nwp_settings_group', 'nwp_use_theme_css');
    register_setting('nwp_settings_group', 'nwp_price_color');
    register_setting('nwp_settings_group', 'nwp_plan_background_color');
    register_setting('nwp_settings_group', 'nwp_template');
}
?>
