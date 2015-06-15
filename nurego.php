<?php
/*
Plugin Name: Nurego
Description: Nurego WP plugin

Version: 0.1
Author: Doron Gour
*/

if( !is_admin() ) {
	/*add_action('wp_print_scripts', 'copyrights_filter_footer');*/
	//add_action('wp_footer','nurego_filter_footer');
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
	$nurego_js_base =  get_option('nurego_js_base');
	if($nurego_js_base == ""){
		$nurego_js_base = "//js.nurego.com/latest/bin.js";
	}
	wp_enqueue_script( 'modernizr', $nurego_js_base , 'nurego-js', false );
}
//lp3f65e0-80a2-95f8-076b-1c5722a46aa2
add_action('admin_menu', 'nurego_config_page');
add_shortcode('nurego', 'drawWidgets' );


//BASE URL 

function drawWidgets($atts){
	$nurego_api =  get_option('nurego_api');
	$widget_type = "";
	$widget_height = "";
	extract(
		shortcode_atts(array(),$atts)
	);
	

	//wp_enqueue_script('copyrightsAlert', plugins_url('//js.nurego.com/latest/bin.js', __FILE__), false, false, true );

	echo "<nurego-api-baseurl url=\"https://api.nurego.com/v1\"> </nurego-api-baseurl>";
	echo "<meta property=\"nrg:nurego-public-customer-id\" content=\"".$nurego_api."\"/>";
	
	$html_attrs = " ";

	if (is_array($atts) || is_object($atts)){
		foreach ($atts as $key => $value){
			if($key != "y" && $key != "widget"){
				$html_attrs.=$key."=".$value." ";
			}
			else{
				if($key == "y"){
					$widget_height = $value;
				}
				if($key == "widget"){
					$widget_type = $value;
				}
			}
			
		}
	}

	$html = "<nurego-widget name='".$widget_type."'";
	$html.= $html_attrs." style=height:".$widget_height."px>";
	$html.="</nurego-widget>";
	return $html;

}


function nurego_config_page() {
	add_submenu_page('options-general.php', __('Nurego'), __('Nurego'), 'manage_options', 'nurego-key-config', 'nurego_config');
}

function nurego_config() {
	$nurego_enabled = get_option('nurego_enabled');
	$nurego_js_base =  get_option('nurego_js_base');
	$nurego_api =  get_option('nurego_api');
	if ( isset($_POST['submit']) ) {
		if (isset($_POST['nurego_api'])){
			$nurego_api = $_POST['nurego_api'];
		}

		if (isset($_POST['nurego_js_base'])){
			$nurego_js_base = $_POST['nurego_js_base'];
		}
		
		if (isset($_POST['nurego_enabled']))
		{
			if ($_POST['nurego_enabled'] == 'on')
			{
				$nurego_enabled = 1;
			}
			else
			{
				$nurego_enabled = 0;
			}
		}
		else
		{
			$nurego_enabled = 0;
		}
		
		update_option('nurego_enabled', $nurego_enabled);
		update_option('nurego_api', $nurego_api);
		update_option('nurego_js_base', $nurego_js_base);
		echo "<div id=\"updatemessage\" class=\"updated fade\"><p>Nurego settings updated.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";
			
	}
	?>
	<div class="wrap" style="width:99%;">
		<h2>Nurego for WordPress Configuration</h2>
		<div class="postbox-container" style="width:100%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<form action="" method="post" id="">
					<div id="" class="postbox" style="padding:16px;">
						<h3>Nurego settings</h3>
						<br/>
						<div class="inside">
								<div>
									<label for="enabled">Nurego API</label>
									<input type="text" id="" style="min-width:300px" name="nurego_api" value="<?php echo ($nurego_api); ?>" />
								</div>
								</br>
								<div>
									<label for="enabled">Nurego JS base URL</label>
									<input type="text" id="" style="min-width:300px" name="nurego_js_base" value="<?php echo ($nurego_js_base); ?>" /> <small>(Leave empty if you are not sure)</small>
								</div>
								<br/>
						</div>
						</div>
					</div>
					<div class="submit"><input type="submit" class="button-primary" name="submit" value="Update &raquo;" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
} 
?>