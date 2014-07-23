<?php
/**
 * Add in the Nurego-wp submenu
 * Need to make the text translatable
 */
function register_nwp_submenu_page() {
    add_submenu_page('options-general.php', "Nurego-WP Settings", "Nurego-WP Settings", 'edit_plugins', 'nwp-settings-menu', 'nwp_custom_submenu_page_callback');
}

/** 
 * Renders the HTML for the submenu page
 */
function nwp_custom_submenu_page_callback() {
?>
     <div class="wrap">
         <h2>Nurego WordPress Setting Page</h2>
           <p>
            <form method="POST" action="options.php">
            <?php settings_fields('nwp_settings_group');
            do_settings_sections('nwp_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><b>Nurego Live API Key:</b></th>
                        <td><input type="text" name="live_api_key" size="40" value="<?php echo get_option('live_api_key');?>" />
                            <label class="description" for="live_api_key">(Required)</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><b>Nurego Test API Key:</b></th>
                        <td><input type="text" name="test_api_key" size="40" value="<?php echo get_option('test_api_key');?>" />
                            <label class="description" for="test_api_key">(Required)</label>
                        </td>
                </tr>
                <tr valign="top">

                    <th scope="row"><h3>Optional Settings:</h3></th>
                </tr>
                <tr valign="top">
                    <th scope="row">Element ID:</th>
                        <td>
                            <input type="text" name="element_id" value="<?php echo get_option('element_id');?>" />
                            <label class="description" for="element_id">The ID of the HTML element you want the offering table appended to.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Theme:</th>
                        <td>
                            <input type="text" name="theme" value="<?php echo get_option('theme');?>" />
                            <label class="description" for="theme">The CSS class for the pricing table.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Custom CSS Url:</th>
                        <td>
                            <input type="text" name="css_url" value="<?php echo get_option('css_url');?>" />
                            <label class="description" for="css_url">The ABSOLUTE Url to the custome CSS file to be used.</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Select Url:</th>
                        <td><input type="text" name="select_url" value="<?php echo get_option('select_url');?>" />
                            <label class="description" for="select_url">Url prefix for plan links.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Select Callback:</th>
                        <td><input type="text" name="select_callback" value="<?php echo get_option('select_callback');?>" />
                            <label class="description" for="select_callback">Callback function executed when a plan is selected.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Label Price:</th>
                        <td><input type="text" name="label_price" value="<?php echo get_option('label_price');?>" />
                            <label class="description" for="label_price">Label in the price column.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Label Select:</th>
                        <td><input type="text" name="label_select" value="<?php echo get_option('label_select');?>" />
                            <label class="description" for="label_select">Label on the select buttons.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Label Feature On:</th>
                        <td><input type="text" name="label_feature_on" value="<?php echo get_option('label_feature_on');?>" />
                            <label class="description" for="label_feature_on">Text to render for features that are on. Can be HTML.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Label Feature Off:</th>
                        <td><input type="text" name="label_feature_off" value="<?php echo get_option('label_feature_off');?>" />
                            <label class="description" for="label_feature_off">Text to render for features that are off. Can be HTML.</label>
                        </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Price Prefix:</th>
                        <td><input type="text" name="label_before_price" value="<?php echo get_option('label_before_price');?>" />
                            <label class="description" for="lable_before_price">Price preffix (ie $ for $1.00).</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Price Suffix:</th>
                        <td><input type="text" name="label_after_price" value="<?php echo get_option('label_after_price');?>" />
                            <label class="description" for="">Price suffix (ie $ for 1.00$).</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Loading Timeout:</th>
                        <td><input type="text" name="time_out" value="<?php echo get_option('time_out');?>" />
                            <label class="description" for="time_out">The amount of time in milliseconds to wait before timing out when loading an offering.</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Loading Class:</th>
                        <td><input type="text" name="loading_class" value="<?php echo get_option('loading_class');?>" />
                            <label class="description" for="loading_class">CSS class for loading block.</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Error Class:</th>
                        <td><input type="text" name="error_class" value="<?php echo get_option('error_class');?>" />
                            <label class="description" for="error_class">CSS class for error block.</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Warning Class:</th>
                        <td><input type="text" name="warning_class" value="<?php echo get_option('warning_class');?>" />
                            <label class="description" for="warning_class">CSS class for warning block.</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Empy Class:</th>
                        <td><input type="text" name="empty_class" value="<?php echo get_option('empty_class');?>" />
                            <label class="description" for="empty_class">CSS class for an empty block.</label>
                        </td>
                </tr>
                 <tr valign="top">
                    <th scope="row">Price Class::</th>
                        <td><input type="text" name="price_class" value="<?php echo get_option('price_class');?>" />
                        <label class="description" for="price_class">CSS class for price block.</label></td>
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
