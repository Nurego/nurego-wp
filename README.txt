=== Nurego-WP ===
Contributors: nurego
Donate link: 
Tags: nurego
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 2.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically push pricing plans created in Nurego to your WordPress generated site.

== Description ==

This plugin allows users have pricing plans from their Nurego accounts  automatically pushed to their WordPress generated sites. It loads the Nurego javascript library and configures it to work with WordPress. Additionally, the plugin provides a settings page where the user can specify site-wide settings for how the pricing plans are displayed. 

Get started right away by entering your settings in the Nurego WordPress Settings submenu and using the [nurego] shortcode. You can also use the [nurego-custom] shortcode to render a table with settings other than the site-wide ones. Learn more about Nurego at [nurego.com](http://www.nurego.com/). 

== Installation ==

1. Upload the `nurego-wp/` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Customize the settings in Settings/Nurego WordPress and render pricing data for a specific environment with  the parameters you set using [nurego-live] or [nurego-test].

== Frequently asked questions ==

= Where do I find my API keys? =

Under "Settings" in your Nurego account.

= My table doesn't look pretty yet? =

You can use your theme's default table settings, specify the url of a stylesheet to use, or set options in the Nurego-WP settings page. The plugin first looks to see if you've chosen to use your theme's style settings. If no, it looks for a custom CSS url. If none is provided, then the options from the settings page are used. 

= How do I make the buttons go to the right place? =

Enter the full URL to the page you want linked to the buttons. The plugin will automatically append the plan guid to it, but you must include the '?plan_id=' in order to correctly pass the plan id parameter to the URL. Example: 'https://example.com/signup?plan_id='

= Which shortcode should I use? =

It's best to enter your settings and use the [nurego] shortcode for plug-and-play functionality.

The [nurego-custom] shortcode is included for passing parameters unique to a specific pricing table without changing site-wide plugin settings. Only use it if you need to do this.

= The pricing table is showing up in unexpected places =

Please get in touch, and include your theme information.

== Screenshots ==
Template 1:
1
Template 2:
2
Template3:
3
Matching plan in Nurego account:
4
