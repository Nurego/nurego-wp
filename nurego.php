<?php
	/*
	Plugin Name: Nurego
	Description: Nurego WP plugin

	Version: 0.1
	Author: Doron Gour
	*/
	//lp3f65e0-80a2-95f8-076b-1c5722a46aa2
	$decoratorAdded = false;

	add_action('admin_menu', 'nurego_config_page');
	add_shortcode('nurego', 'drawWidgets' );

	//BASE URL 

	function addNuregoDecorators(){
			if(!$decoratorAdded){
				$nurego_js_base =  get_option('nurego_js_base');
				$nurego_api =  get_option('nurego_api');
				
				if($nurego_js_base == ""){
					$nurego_js_base = "//js.nurego.com/latest/bin.js";
				}

				wp_enqueue_script( 'nurego', $nurego_js_base , 'nurego-js', false );
				echo "<nurego-api-baseurl url=\"https://api.nurego.com/v1\"> </nurego-api-baseurl>";
				echo "<meta property=\"nrg:nurego-public-customer-id\" content=\"".$nurego_api."\"/>";

				$decoratorAdded = true;
		}
	}

	function drawWidgets($atts){
		addNuregoDecorators();
		$widget_type = "";
		$widget_height = "";
		extract(
			shortcode_atts(array(),$atts)
		);

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
		$html.= $html_attrs." style='height:".$widget_height."px'>";
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
			
			
			update_option('nurego_api', $nurego_api);
			update_option('nurego_js_base', $nurego_js_base);
			echo "<div id=\"updatemessage\" class=\"updated fade\"><p>Nurego settings updated.</p></div>\n";
			echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";
	}
?>
	<div class="wrap" style="width:99%;">
		<div class="postbox-container" style="width:100%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<form action="" method="post" id="" style="text-align:center;">
					<div id="" class="postbox" style="padding:16px;">
						<?php
							echo '<a style="display:inline-block;" href="//www.nurego.com" target="_new"><img src="' . plugins_url( 'resources/logo.png', __FILE__ ) . '" /> </a>';
						?>
						<br/>
						<div class="inside">
								<div>
									<label style="display:block;" for="nurego_api">Nurego API</label>
									<input type="text" id="" style="min-width:300px" name="nurego_api" value="<?php echo ($nurego_api); ?>" />
								</div>
								</br>
								<div>
									<label style="display:block;" for="nurego_js_base">Nurego JS base URL</label>
									<input type="text" id="" style="min-width:300px" placeholder="Default: (https://js.nurego.com/latest/bin.js)" name="nurego_js_base" value="<?php echo ($nurego_js_base); ?>" /> <small style="display:block;">(Leave empty if you are not sure)</small>
								</div>
								<br/>
								<div class="submit"><input type="submit" class="button-primary" name="submit" value="Update &raquo;" /></div>
						</div>
						</div>
					</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
} 
?>