<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', __("Nurego WordPress", 'nwp-text-domain'), __("Nurego Wordpress Settings", 'nwp-text-domain'), 'edit_plugins', 'nwp-settings-menu', 'nwp_custom_submenu_page_callback');
}

/**
 * Let's learn metaboxes
 */


/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {

    global $nwp_options;
    if( isset( $_GET['tab'])) $tab = $_GET['tab'];
    else $tab = 'api_keys'; 
    
    wp_enqueue_script('nwp_jscolor'); ?>

     <div class="wrap">
     <h2><?php _e('Nurego WordPress Settings', 'nwp-text-domain');?></h2>
           <p>
            <form method="POST" action="options.php">
            <?php settings_fields('nwp_settings_group'); ?>

            <table class="form-table">
            <h2 class="nav-tab-wrapper'">
            <a href="?page=nwp-settings-menu&tab=api_keys" class="nav-tab <?php echo ($tab == 'api_keys') ? 'nav-tab-active' : '' ;?>">API Keys</a>
                <a href="?page=nwp-settings-menu&tab=display" class="nav-tab <?php echo ($tab == 'display') ? 'nav-tab-active' : '' ;?>">Display</a>
                <a href="?page=nwp-settings-menu&tab=render" class="nav-tab <?php echo ($tab == 'render') ? 'nav-tab-active' : '' ;?>">Render</a>
            </h2>

            <?php if($tab == 'api_keys') {?>
                <tr valign="top">
                <th scope="row"><b><?php _e('Nurego Live API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" id="nwp_settings[live_api_key]" name="nwp_settings[live_api_key]" size="40" value="<?php echo $nwp_options['live_api_key'];?>" />
                        <label class="description" for="nwp_settings[live_api_key]">(<?php _e('Required', 'nwp-text-domain');?>)</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><b><?php _e('Nurego Test API Key', 'nwp-text-domain');?>:</b></th>
                        <td><input type="text" id="nwp_settings[test_api_key]" name="nwp_settings[test_api_key]" size="40" value="<?php echo $nwp_options['test_api_key'];?>" />
                        <label class="description" for="nwp_settings[test_api_key]">(<?php _e('Required', 'nwp-text-domain'); ?>)</label>
                        </td>
                </tr>
                <?php } else if($tab == 'display') {?>
                <tr valign="top">
                <th scope="row"><?php _e('Use theme styling?', 'nwp-text-domain');?></th>
                    <td><input type="checkbox" id='nwp_settings[use_theme_css]' name='nwp_settings[use_theme_css]' value='1' <?php checked($nwp_options['use_theme_css'], true);?> />
                        <label class="description" for="nwp_settings[use_theme_css]"><?php _e('Check to use your built in theme settings for the pricing table. Overrides all other style settings.');?></label>
                    </td>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Table Template', 'nwp-text-domain');?>:</th>
                    <td><select id="nwp_options[template]" name="nwp_options[template]">
                        <option value="1" <?php selected($nwp_options['template'], 1);?>><?php _e('Template 1', 'nwp-text-domain');?></option>
                        <option value="2" <?php selected($nwp_options['template'], 2);?>><?php _e('Template 2', 'nwp-text-domain');?></option>
                        <option value="3" <?php selected($nwp_options['template'], 3);?>><?php _e('Template 3', 'nwp-text-domain');?></option>
                        </select>
                        <label class="description" for="nwp_options[template]"><?php _e('Choose the layout of your pricing table', 'nwp-text-domain');?></label>
                    </td>
                <tr valign="top">
                <th scope="row"><?php _e('Table Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[background]' name='nwp_options[background]' value="<?php echo $nwp_options['background'];?>" />
                    <label class="description" for="nwp_options[background]"><?php _e('Table background color (hex value)',
                                                                          'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Plan Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id'nwp_options[plan_font_color]' name='nwp_options[plan_font_color]' value="<?php echo $nwp_options['plan_font_color'];?>" />
                    <label class="description" for="nwp_options[plan_font_color]"><?php _e('Plan font color (hex value)',
                                                                          'nwp-text-domain');?></label>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[price_color]' name='nwp_options[price_color]' value="<?php echo $nwp_options['price_color'];?>" />
                    <label class="description" for="nwp_options[price_color]"><?php _e('Price font color (hex value)',
                                                                          'nwp-text-domain');?></label>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Primary Accent Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[primary_color]' name='nwp_options[primary_color]' value="<?php echo $nwp_options['primary_color'];?>" />
                    <label class="description" for="nwp_options[primary_color]"><?php _e('Primary color for pricing table (hex value)',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Secondary Accent Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[secondary_color]'name='nwp_options[secondary_color]' value="<?php echo $nwp_options['secondary_color'];?>" />
                    <label class="description" for="nwp_options[secondary_color]"><?php _e('Secondary color for pricing table (hex value)',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Plan Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[plan_background_color]' name='nwp_options[plan_background_color]' value="<?php echo $nwp_options['plan_background_color'];?>" />
                    <label class="description" for="nwp_options[plan_background_color]"><?php _e('Background color for plans in the pricing table (hex value)',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Button Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[button_color]' name='nwp_options[button_color]' value="<?php echo $nwp_options['button_color'];?>" />
                    <label class="description" for="nwp_options[button_color]"><?php _e('Button color (hex value)',
                                                                            'nwp-text-domain');?></label>
                </tr> 
                <tr valign="top">
                <th scope="row"><?php _e('Button Text Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_options[button_text_color]' name='nwp_options[button_text_color]' value="<?php echo $nwp_options['button_text_color'];?>" />
                    <label class="description" for="nwp_options[button_text_color]"><?php _e('Button text color (hex value)',
                                                                            'nwp-text-domain');?></label>
                </tr>                <tr valign="top">
                <th scope="row"><?php _e('Price Label', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_options[label_price]" name="nwp_options[label_price]" value="<?php echo $nwp_options['label_price'];?>" />
                        <label class="description" for="nwp_options[nwp_label_price]"><?php _e('Label in the price column',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Select Button Text', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_options[label_select]" name="nwp_options[label_select]" value="<?php echo $nwp_options['label_select'];?>" />
                        <label class="description" for="nwp_options[label_select]"><?php _e('Label on the select buttons', 
                                                                               'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Prefix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_options[label_before_price]" name="nwp_options[label_before_price]" value="<?php echo $nwp_options['label_before_price'];?>" />
                        <label class="description" for="nwp_options[label_before_price]"><?php _e('Price preffix (ie $ for $1.00)', 
                                                                                     'nwp-text-domain');?>.</label>
                        </td>
                 </tr>
                 <tr valign="top">
                 <th scope="row"><?php _e('Price Suffix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_options[label_after_price]" name="nwp_options[label_after_price]" value="<?php echo $nwp_options['label_after_price'];?>" />
                        <label class="description" for="nwp_options[label_after_price]"><?php _e('Price suffix (ie $ for 1.00$)',
                                                                   'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Custom CSS Url', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" id="nwp_options[css_url]" name="nwp_options[css_url]" value="<?php echo $nwp_options['css_url'];?>" />
                            <label class="description" for="nwp_options[css_url]"><?php _e('The ABSOLUTE Url to the custom CSS file to be used. (Will override current settings)',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <?php } else {?>
                <tr valign="top">
                <th scope="row"><?php _e('Select Button URL', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" id="nwp_options[select_url]" name="nwp_options[select_url]" value="<?php echo $nwp_options['select_url'];?>" />
                            <label class="description" for="nwp_options[select_url]"><?php _e('URL to send the user to after selecting a plan. Ex http://foo.com/?plan_id=', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
               <tr valign="top">
                <th scope="row"><?php _e('Loading Timeout', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_options[time_out]" name="nwp_options[time_out]" value="<?php echo $nwp_options['time_out'];?>" />
                        <label class="description" for="nwp_options[time_out]"><?php _e('The amount of time in milliseconds to wait before timing out when loading an offering',
                                                                           'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <?php } ?>
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
    register_setting('nwp_settings_group', 'nwp_settings');
}
add_action('admin_init', 'register_nwp_settings');
?>
