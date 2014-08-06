<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', 
        __("Nurego-WP", 'nwp-text-domain'), 
        __("Nurego-WP", 'nwp-text-domain'), 
        'edit_plugins', 
        'nwp-settings-menu', 
        'nwp_custom_submenu_page_callback');
}



/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {

    global $nwp_render_options;
    global $nwp_display_options;
    global $nwp_key_options;
    if( isset( $_GET['tab'])) $tab = $_GET['tab'];
    else $tab = 'api_keys'; 
    
    wp_enqueue_script('nwp_jscolor'); ?>

    <div class="wrap">
    <h2><?php _e('Nurego WordPress Settings', 'nwp-text-domain');?></h2>
    <p>
        <h2 class="nav-tab-wrapper'">
            <a href="?page=nwp-settings-menu&tab=api_keys" class="nav-tab <?php echo ($tab == 'api_keys') ? 'nav-tab-active' : '' ;?>">API Keys</a>
            <a href="?page=nwp-settings-menu&tab=display" class="nav-tab <?php echo ($tab == 'display') ? 'nav-tab-active' : '' ;?>">Display</a>
            <a href="?page=nwp-settings-menu&tab=render" class="nav-tab <?php echo ($tab == 'render') ? 'nav-tab-active' : '' ;?>">Render</a>
        </h2>

    <?php if($tab == 'api_keys') {?>
        <form method="POST" action="options.php">
        <?php settings_fields('nwp_settings_key_group'); ?> 
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><b><?php _e('Nurego API Key (live OR test)', 'nwp-text-domain');?>:</b></th>
                <td><input type="text" id="nwp_key_settings[api_key]" name="nwp_key_settings[api_key]" size="40" 
                           value="<?php echo (isset($nwp_key_options['api_key'])) ? $nwp_key_options['api_key'] : '' ;?>" />
                     <label class="description" for="nwp_key_settings[api_key]">(<?php _e('Required', 'nwp-text-domain');?>)</label>
                </td>
            </tr>
            <tr valign="top">
                <td><?php submit_button(); ?></td>
            </tr>
 
        </form></p>
    <?php } else if($tab == 'display') {?>
        <form method="POST" action="options.php">
        <?php settings_fields('nwp_settings_display_group'); ?> 
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Use theme styling?', 'nwp-text-domain');?></th>
                    <td><input type="checkbox" id='nwp_display_settings[use_theme_css]' name='nwp_display_settings[use_theme_css]' 
                               value='1' <?php checked(1, isset($nwp_display_options['use_theme_css']) );?> />
                        <label class="description" for="nwp_display_settings[use_theme_css]">
                               <?php _e('Check to use your built in theme settings for the pricing table. Overrides all other style settings.');?></label>
                    </td>
            </tr> 
            <tr valign="top">
                <th scope="row"><?php _e('Table Template', 'nwp-text-domain');?>:</th>
                    <td><select id="nwp_display_settings[template]" name="nwp_display_settings[template]">
                        <option value="1" <?php selected($nwp_display_options['template'], 1);?>><?php _e('Template 1', 'nwp-text-domain');?></option>
                        <option value="2" <?php selected($nwp_display_options['template'], 2);?>><?php _e('Template 2', 'nwp-text-domain');?></option>
                        <option value="3" <?php selected($nwp_display_options['template'], 3);?>><?php _e('Template 3', 'nwp-text-domain');?></option>
                        </select>
                        <label class="description" for="nwp_display_settings[template]"><?php _e('Choose the layout of your pricing table', 'nwp-text-domain');?></label>
                    </td>
            <tr valign="top">
                <th scope="row"><?php _e('Table Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_display_settings[background]' name='nwp_display_settings[background]' 
                               value="<?php echo (isset($nwp_display_options['background'])) ? $nwp_display_options['background'] : '';?>" />
                        <label class="description" for="nwp_display_options[background]"><?php _e('Table background color (hex value)',
                                                                          'nwp-text-domain');?></label>
            </tr> 
            <tr valign="top">
                <th scope="row"><?php _e('Plan Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id'nwp_display_settings[plan_font_color]' name='nwp_display_settings[plan_font_color]' 
                               value="<?php echo (isset($nwp_display_options['plan_font_color'])) ? $nwp_display_options['plan_font_color'] : '';?>" />
                        <label class="description" for="nwp_display_settings[plan_font_color]"><?php _e('Plan font color (hex value)',
                                                                          'nwp-text-domain');?></label>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Price Font Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_display_settings[price_color]' name='nwp_display_settings[price_color]'
                               value="<?php echo (isset($nwp_display_options['price_color'])) ? $nurego_display_options['price_color'] : '' ;?>" />
                        <label class="description" for="nwp_display_settings[price_color]"><?php _e('Price font color (hex value)',
                                                                          'nwp-text-domain');?></label>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Plan Background Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_display_settings[plan_background_color]' name='nwp_display_settings[plan_background_color]' 
                               value="<?php echo (isset($nwp_display_options['plan_background_color'])) ? $nwp_display_options['plan_background_color'] : '';?>" />
                        <label class="description" for="nwp_display_settings[plan_background_color]"><?php _e('Background color for plans in the pricing table (hex value)',
                                                                            'nwp-text-domain');?></label>
            </tr> 
            <tr valign="top">
                <th scope="row"><?php _e('Button Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_display_settings[button_color]' name='nwp_display_settings[button_color]' 
                               value="<?php echo (isset($nwp_display_options['button_color'])) ? $nwp_display_options['button_color'] : '';?>" />
                        <label class="description" for="nwp_display_settings[button_color]"><?php _e('Button color (hex value)',
                                                                            'nwp-text-domain');?></label>
            </tr> 
            <tr valign="top">
                <th scope="row"><?php _e('Button Text Color', 'nwp-text-domain');?></th>
                    <td><input type="text" class="color" id='nwp_display_settings[button_text_color]' name='nwp_display_settings[button_text_color]' 
                               value="<?php echo (isset($nwp_display_options['button_text_color'])) ? $nwp_display_options['button_text_color'] : '';?>" />
                        <label class="description" for="nwp_display_settings[button_text_color]"><?php _e('Button text color (hex value)',
                                                                            'nwp-text-domain');?></label>
            </tr>                <tr valign="top">
                <th scope="row"><?php _e('Price Label', 'nwp-text-domain');?>:</th>
                    <td><input type="text" id="nwp_display_settings[label_price]" name="nwp_display_settings[label_price]" 
                               value="<?php echo (isset($nwp_display_options['label_price'])) ? $nwp_display_options['label_price'] : '';?>" />
                        <label class="description" for="nwp_display_settings[nwp_label_price]"><?php _e('Label in the price column',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Select Button Text', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_display_settings[label_select]" name="nwp_display_settings[label_select]" 
                                   value="<?php echo (isset($nwp_display_options['label_select'])) ? $nwp_display_options['label_select'] : '';?>" />
                        <label class="description" for="nwp_display_settings[label_select]"><?php _e('Label on the select buttons', 
                                                                               'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Price Prefix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_display_settings[label_before_price]" name="nwp_display_settings[label_before_price]" 
                                   value="<?php echo (isset($nwp_display_options['label_before_price'])) ? $nwp_display_options['label_before_price'] : '';?>" />
                        <label class="description" for="nwp_display_settings[label_before_price]"><?php _e('Price preffix (ie $ for $1.00)', 
                                                                                     'nwp-text-domain');?>.</label>
                        </td>
                 </tr>
                 <tr valign="top">
                 <th scope="row"><?php _e('Price Suffix', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_display_settings[label_after_price]" name="nwp_display_settings[label_after_price]" 
                                   value="<?php echo (isset($nwp_display_options['label_after_price'])) ? $nwp_display_options['label_after_price'] : '';?>" />
                        <label class="description" for="nwp_display_settings[label_after_price]"><?php _e('Price suffix (ie $ for 1.00$)',
                                                                   'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                <th scope="row"><?php _e('Custom CSS Url', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" id="nwp_display_settings[css_url]" name="nwp_display_settings[css_url]" 
                                   value="<?php echo (isset($nwp_display_options['css_url'])) ? $nwp_display_options['css_url'] : '';?>" />
                                   <label class="description" for="nwp_display_settings[css_url]">
                                            <?php _e('The ABSOLUTE Url to the custom CSS file to be used. (Will override current settings)',
                                                                              'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <td><?php submit_button(); ?></td>
                </tr>
            </form>
        </p>
        <?php } else {?>
            <form method="POST" action="options.php">
            <?php settings_fields('nwp_settings_render_group'); ?> 
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Select Button URL', 'nwp-text-domain');?>:</th>
                        <td>
                            <input type="text" id="nwp_render_settings[select_url]" name="nwp_render_settings[select_url]" 
                                   value="<?php echo (isset($nwp_render_options['select_url'])) ? $nwp_render_options['select_url'] : '';?>" />
                                <label class="description" for="nwp_render_settings[select_url]">
                                    <?php _e('URL to send the user to after selecting a plan. Ex http://foo.com/?plan_id=', 
                                                                                 'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Loading Timeout', 'nwp-text-domain');?>:</th>
                        <td><input type="text" id="nwp_render_settings[time_out]" name="nwp_render_settings[time_out]" 
                                   value="<?php echo (isset($nwp_render_options['time_out'])) ? $nwp_render_options['time_out'] : '5000';?>" />
                                <label class="description" for="nwp_render_settings[time_out]">
                                    <?php _e('The amount of time in milliseconds to wait before timing out when loading an offering',
                                                                           'nwp-text-domain');?>.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <td><?php submit_button(); ?></td>
                </tr>
            </form></p>
           <?php } ?>
           </div> <?php
}

/**
 * Register all of the settings we intend to show on the settings page
 */
function register_nwp_settings() {
    register_setting('nwp_settings_key_group', 'nwp_key_settings');
    register_setting('nwp_settings_display_group', 'nwp_display_settings');
    register_setting('nwp_settings_render_group', 'nwp_render_settings');
}
add_action('admin_init', 'register_nwp_settings');
?>
