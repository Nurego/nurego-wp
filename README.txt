=== Nurego-WP ===
Contributors: erik.barzdukas
Donate link: 
Tags: nurego
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically push pricing plans created in Nurego to your WordPress generated site.

== Description ==

This plugin allows users have pricing plans from their Nurego accounts  automatically pushed to their WordPress generated sites. It loads the Nurego javascript library and configures it to work with WordPress. Additionally, the plugin provides a settings page where the user can specify site-wide settings for how the pricing plans are displayed. 

Get started right away by providing your Nurego API key to the [nurego] shortcode, or enter in settings in the Nurego WordPress Settings submenu and render the correct environment's pricing data by calling [nurego-live] or [nurego-test]. Learn more about Nurego at [nurego.com](http://www.nurego.com/). 

== Installation ==

1. Upload the `nurego-wp/` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Customize the settings in Settings/Nurego WordPress and render pricing data for a specific environment with  the parameters you set using [nurego-live] or [nurego-test].

== Frequently asked questions ==

= Where do I find my API keys? =

Under "Settings" in your Nurego account.

= My table doesn't look pretty yet? =

Customize your colors by entering hex values in the color fields in the settings menu.

= How do I make the buttons go to the right place? =

Enter the full URL to the page you want linked to the buttons. The table will automatically append the plan guid to it, but you must include the '?plan_id='. Example: 'https://example.com/signup?plan_id='

= Which shortcode should I use? =

It's best to enter your settings and use the [nurego-live] or [nurego-test] shortcode for plug-and-play functionality.

The [nurego] shortcode is included for passing parameters unique to a specific pricing table without changing site-wide plugin settings. Only use it if you need to do this.

= The pricing table is showing up in unexpected places =

Please get in touch, and include your theme information.

