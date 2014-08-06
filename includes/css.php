<?php
/**
 * Dynamically created CSS file for the nurego-wp plugin
 *
 * This file takes saved settings out of the DB and 
 * places them in the CSS.
 */

 // Relative pathing for this file
 if(!defined('NUREGO_BASE_CSS_URL')) {
     define('NUREGO_BASE_CSS_URL', plugin_dir_url(__FILE__));
 }

global $nwp_display_options;
?>


<?php echo '<style>';?>
.nr-default {
    font-family: <?php echo $nwp_display_options['font'];?>,"Lato",Helvetica,Arial,sans-serif;
}
.nr-default table {
    width: 100%;
    border-collapse: collapse;
    background: <'#'.?php echo $nwp_display_options['background'];?>;
    <?php if ($nwp_display_options['template'] == '3') {
        echo 'border: none;';
    };?>
}
.nr-default td {
    border-bottom: 0;
    border-top: 0;
    vertical-align: middle;
}
.nr-default th {
border: <?php echo (($nwp_display_options['template'] != '1')) ? '0px' : '1px';?> solid #e8e8e8;
    background-color: <?php echo '#'.$nwp_display_options['plan_background_color'];?>;
    color: <?php echo '#'.$nwp_display_options['plan_font_color'];?>;
    vertical-align: middle;
    text-align: center;
}
.nr-default td {
    font-size: 14px;
    line-height: 18px;
}
.nr-default thead th,
.nr-default tfoot th {
    //border: none;
}
.nr-default thead td {
    height: 30px;
    background: #fff;
    font-size: 11px;
    color: #9799a2;
    text-transform: uppercase;
    text-align: center;
    font-weight: bold;
    padding: 0 10px;
}
.nr-default tbody th {
    text-align: left;
    font-size: 12px;
    padding: 10px 20px;
    font-weight: normal;
}
.nr-default tbody td {
    text-align: center;
    padding-top: 2px;
    padding-bottom: 5px;
}
.nr-default tfoot td {
    text-align: center;
    padding: 12px 0;
}

.nr-default .nr-empty-th {
    <?php if ($nwp_display_options['template'] == 3) echo 'background: '.$nwp_display_options['nwp_background'].';'; ?>;
    border-top: none;
    border-left: none;
    border-bottom: none;
}
.nr-default th.nr-price {
    height: 32px;
    background-color: <?php echo '#'.$nwp_display_options['plan_background_color'];?>; //#fff;
    text-align: left;
    font-weight: normal;
}
.nr-default td.nr-price {
    color: <?php echo '#'.$nwp_display_options['price_color'];?>;
    font-size: 24px;
    font-weight: bold;
}
.nr-default tfoot a {
    display: inline-block;
    color: <?php echo ($nwp_display_options['button_text_color'] != '') ? '#'.$nwp_display_options['button_text_color'] : '#fff';?>;
    background: <?php echo ($nwp_display_options['button_color'] != '') ? '#'.$nwp_display_options['button_color'] : '#959595';?>;
    height: 32px;
    line-height: 32px;
    text-align: center;
    padding: 0 15px;
    margin-left: 5px;
    margin-right: 5px;
    font-size: 10px;
    text-transform: uppercase;
    font-weight: bold;
    text-decoration: none;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.nr-default tfoot a:hover {
    background: #959595;
}
.nr-default .nr-check {
    width: 16px;
    height: 16px;
    display: block;
    margin: 0 auto;
    background: url("<?php echo NUREGO_BASE_CSS_URL . '../includes/images/ico-sprite.gif';?>") 0 0 no-repeat;
}
.nr-default .nr-check.nr-yes { background-position: 0 0; }
.nr-default .nr-check.nr-no { background-position: -16px 0; }
.nr-default .nr-notify {
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    line-height: 18px;
    padding: 20px;
    margin: 0 0 15px;
    font-family: Tahoma, Verdana, Segoe, sans-serif;
    letter-spacing: 1px;
}
.nr-default .nr-notify.nr-red {
    background: #f2dede;
    color: #a94442;
}
.nr-default .nr-notify.nr-yellow {
    background: #fcf8e3;
    color: #986d3b;
}
.nr-default .nr-container {
    height: 304px;
    margin: 0 auto 10px;
}
.nr-default .nr-container.nr-loading {
    background: url(<?php echo '"'.NUREGO_BASE_CSS_URL.'"' . '"../includes/images/loader.gif"';?> ) 50% 50% no-repeat;
}
.nr-default .nr-container.nr-empty {
    background: url(<?php echo '"'.NUREGO_BASE_CSS_URL.'"'.'"../images/includes/empty.gif"';?>) 50% 50% no-repeat;
}

.nr-signup-div {
    margin: 20px auto;
    width: 55%;
}
.nr-signup {
    text-decoration: none;
    background: transparent;
    border: 2px solid #dfe1e6;
    min-width: 120px;
    font-weight: 400;
    margin-top: 0.5em;
    color: #565a6b;
    text-transform: uppercase;
    padding: 0.625em 1.125em;
    font-size: 0.857em;
    margin-left: 5px;
}

.nr-signup:hover {
    color: white;
    background: #565a6b;
    border: 2px solid white;
}

.nr-default .nr-plan-selected {
    background: #f26522; 
}

.nr-default .nr-plan-selected:hover {
    background: #f26522; 
}

.nr-discount {
  text-transform:uppercase;
  padding: 10px 10px 10px 10px !important;
  background-color: #<?php echo $nwp_display_options['background'];?>;
  color: <?php echo '#'.$nwp_display_options['price_color'];?>;
}
.nr-trial-days {
  font-size: 10px;
}

<?php echo '</style>';?>
