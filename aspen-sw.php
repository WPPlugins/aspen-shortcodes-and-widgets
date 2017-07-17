<?php
/*
Plugin Name: Aspen Shortcodes and Widgets
Plugin URI: http://aspentheme.com/plugins/aspen-shortcodes-and-widgets/
Description: Aspen Shortcodes and Widgets - a package of useful shortcodes and widgets for the Aspen Theme. It will integrate closely with the Aspen and Weaver II themes.
Author: wpweaver
Author URI: http://weavertheme.com/about/
Version: 2.0.5

License: GPL

Aspen Shortcodes and Widgets
Copyright (C) 2013, Bruce E. Wampler - aspen@aspenthemeworks.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/* CORE FUNCTIONS
*/

define ('ASPEN_SW_VERSION','2.0.5');
define ('ASPEN_PRO_VERSION','2.0.5');
define ('ASPEN_SW_MINIFY','.min');		// '' for dev, '.min' for production

function aspen_sw_installed() {
    return true;
}

function aspen_sw_admin() {
    require_once(dirname( __FILE__ ) . '/includes/atw-sw-admin-top.php'); // NOW - load the admin stuff
    aspen_sw_admin_page();
}

function aspen_sw_admin_menu() {
    $page = add_theme_page(
	  'Aspen Shortcodes and Widgets by Aspen ThemeWorks','&nbsp;<span style="color:orange;">&spades;</span>[Aspen Shortcodes]','manage_options','aspen_sw', 'aspen_sw_admin');
	/* using registered $page handle to hook stylesheet loading for this admin page */
    add_action('admin_print_styles-'.$page, 'aspen_sw_admin_scripts');
}

add_action('admin_menu', 'aspen_sw_admin_menu', 6);

function aspen_sw_admin_scripts() {
    /* called only on the admin page, enqueue our special style sheet here (for tabbed pages) */
    wp_enqueue_style('atw_sw_Stylesheet', aspen_sw_plugins_url('/atw-admin-style', ASPEN_SW_MINIFY . '.css'), array(), ASPEN_SW_VERSION);

    wp_enqueue_style ("thickbox");	// @@@@ if we use media browser...
    wp_enqueue_script ("thickbox");

    wp_enqueue_script('atw_Yetii', aspen_sw_plugins_url('/js/yetii/yetii',ASPEN_SW_MINIFY.'.js'), array(),ASPEN_SW_VERSION);
    wp_enqueue_script('atw_Hide', aspen_sw_plugins_url('/js/theme/hide-css', ASPEN_SW_MINIFY.'.js'), array(),ASPEN_SW_VERSION);
    wp_enqueue_script('atw_MediaLib', aspen_sw_plugins_url('/js/theme/media-lib'.ASPEN_SW_MINIFY,'.js'), array(),ASPEN_SW_VERSION);
}

function aspen_sw_plugins_url($file,$ext) {
    return plugins_url($file,__FILE__) . $ext;
}

function aspen_sw_enqueue_scripts() {	// action definition

    if (function_exists('atw_slider_header')) atw_slider_header();

    //-- Aspen PLus js lib - requires jQuery...

    wp_enqueue_script('aspenswJSLib', aspen_sw_plugins_url('/js/aspenswjslib', ASPEN_SW_MINIFY . '.js'),array('jquery'),ASPEN_SW_VERSION);
    if (aspen_sw_getopt('video_fitvids'))
        wp_enqueue_script('atw-fit-vids', aspen_sw_plugins_url('/js/fitvids/jquery.fitvids', ASPEN_SW_MINIFY . '.js'),array('jquery'),ASPEN_SW_VERSION,true);

    // add plugin CSS here, too.

    wp_register_style('aspen-sw-style-sheet',aspen_sw_plugins_url('aspen-sw-style', ASPEN_SW_MINIFY.'.css'),null,ASPEN_SW_VERSION,'all');
    wp_enqueue_style('aspen-sw-style-sheet');
}

add_action('wp_enqueue_scripts', 'aspen_sw_enqueue_scripts' );

function aspen_sw_footer() {
    echo "<!-- Aspen Shortcodes and Widgets footer code -->\n";
    if (function_exists('atw_slider_footer')) atw_slider_footer();
    if (aspen_sw_getopt('video_fitvids')) {
	$selector = 'body';	// body works on all themes...
	if (function_exists( 'aspen_setup' ) || function_exists( 'weaverii_setup' ))
	    $selector = '#wrapper';
	echo "<script type=\"text/javascript\">jQuery(document).ready(function($){
	$(\"" . $selector . "\").fitVids();
	});</script>\n";
    }
}

add_action('wp_footer','aspen_sw_footer', 9);	// make it 9 so we can dequeue bxSlider script

function aspen_has_bxsliderxxx() {
}

if (!function_exists('aspen_has_bxslider')) {
    function aspen_sw_has_bxslider() {
    // admin in atw-bxslider-admin.php
    return true;
}
}

require_once(dirname( __FILE__ ) . '/includes/atw-runtime-lib.php'); // NOW - load the basic library
require_once(dirname( __FILE__ ) . '/includes/atw-widgets.php'); 		// widgets runtime library

require_once(dirname( __FILE__ ) . '/includes/atw-shortcodes.php'); // load the shortcode definitions

// Now add former Pro stuff...

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$mydir = plugin_dir_path(__FILE__);
$mydir = str_replace('/aspen-shortcodes-and-widgets/', '', $mydir );

$pro_installed = file_exists($mydir . '/aspen-pro/aspen_pro.php');


if ($pro_installed || function_exists('aspen_pro_plugin_installed') ) {
    echo "<script> alert('You have the recently discontinued version of the Aspen Pro plugin installed and/or activated.
The Aspen Pro Plugin has been replaced with this new version of Aspen Shortcodes and Widgets. (You should continue to use the
existing version of the Aspen Theme.) You MUST deactivate and delete your existing version of the Aspen Pro plugin.
All your settings will be perserved and are now handled by this plugin. DEACTIVATE and DELETE Aspen Pro.
Please refresh the WP admin pages until this message stops displaying.'); </script>";

} else {

$template_dir = wp_get_theme()->get_template_directory();        // path to root template directory
if ( stripos( $template_dir, 'themes/aspen') !== false ) {

function aspen_pro_plugin_installed() {
	return true;
}

//===============================================================
// connect plugin to WP
// Set up Admin
// 1. Add Admin Menu and Admin scripts
// 2. Add runtime scripts

// no admin needed...


// =============================== utility functions =============================

if (!function_exists('aspen_pro_plugins_url')) {      // this must be in the plugin root to work right
function aspen_pro_plugins_url( $file,$ext ) {
	return plugins_url($file,__FILE__) . $ext;
}
}

add_action('aspen_pro_add_admin','aspen_pro_add_admin_action');
function aspen_pro_add_admin_action() {
require_once(dirname( __FILE__ ) . '/includes/aspen_pro_admin_actions.php'); // NOW - load the plugin admin actions
}

add_action('aspen_pro_add_per_page','aspen_pro_add_per_page_action');
function aspen_pro_add_per_page_action() {
require_once(dirname( __FILE__ ) . '/includes/aspen_pro_per_page_actions.php'); // NOW - load the plugin admin actions
}

require_once(dirname( __FILE__ ) . '/includes/atw_fileio.php'); // NOW - load the plugin
require_once(dirname( __FILE__ ) . '/includes/aspen_pro_runtime_lib.php'); // NOW - load the plugin
require_once(dirname( __FILE__ ) . '/includes/aspen_pro_actions.php'); // NOW - load the plugin
require_once(dirname( __FILE__ ) . '/includes/aspen_pro_extramenu.php'); // NOW - load the plugin
}   // end of load only if aspen template
}   // pro active already?
?>
