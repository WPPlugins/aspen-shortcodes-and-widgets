<?php

// # Aspen SW Globals ==============================================================
$aspen_pro_opts_cache = false;  // internal cache for all settings
$aspen_fonts_defs = array(

	array('label' => 'OVERALL FONTS', 'tag'=>'', 'id' => '_overall', 'info' =>'Fonts for Titles/Content.'),

	array('label'=>'Content Font',
		'tag' => 'body',
		'id' => 'ap_fonts_content', 'info' =>'Font used for most content and widget text.'),

	array('label'=> 'Titles Font', 'tag' =>
		'h3#comments-title,h3#reply-title,.menu_bar,
#author-info,#infobar,#nav-above, #nav-below,#cancel-comment-reply-link,.form-allowed-tags,
#site-info,#site-title,#wp-calendar,#comments-title,.comment-meta,.comment-body tr th,.comment-body thead th,
.entry-content label,.entry-content tr th,.entry-content thead th,.entry-format,.entry-meta,.entry-title,
.entry-utility,#respond label,.navigation,.page-title,.pingback p,.reply,.widget-title,
.wp-caption-text,input[type=submit]',
		'id' => 'ap_fonts_title', 'info' =>'Font used for post, page, and widget titles, info labels, and menus.'),

	array('label' => 'MENU FONTS', 'tag'=>'', 'id' => '_menus', 'info' =>'Fonts used on menus'),
	array('label'=> 'Menu Bars', 'tag' =>
		'.menu_bar',
		'id' => 'ap_fonts_menubar', 'info' =>'Font used for main menu bars.'),
	array('label' => 'Extra Vertical Menu', 'tag'=>'.menu-vertical', 'id' => 'ap_fonts_menu_vertical', 'info' =>'Basic Rollover Vertical Menu (.menu-vertical)'),
	array('label' => 'Extra Horizontal Menu', 'tag'=>'.menu-horizontal', 'id' => 'ap_fonts_menu_horizontal', 'info' =>'Simple Horizontal One Level Menu (.menu-horizontal)'),
	array('label' => 'Info Bar', 'tag'=>'#infobar', 'id' => 'ap_fonts_info_bar', 'info' =>'The Info Bar (#infobar)'),


	array('label' => 'TITLES & HEADINGS', 'tag'=>'yyy', 'id' => '_titles-headings', 'info' =>'Titles and Headings'),
	array('label' => 'Headings',
		'tag'=>'#content h1, #content h2, #content h3, #content h4, #content h5, #content h6, #content dt, #content th,
		h1, h2, h3, h4, h5, h6,.page-title,.page-link,#entry-author-info h2,h3#comments-title, h3#reply-title,
		.comment-author cite,.entry-content fieldset legend',
		'id' => 'ap_fonts_titles-headings', 'info' =>'Content are headings and other labels (h1, h2, etc.). Includes Titles if not specified otherwise below.'),
	array('label' => 'Site Title', 'tag'=>'#site-title', 'id' => 'ap_fonts_site_title', 'info' =>'Main Site Title'),
	array('label' => 'Site Tagline', 'tag'=>'#site-description', 'id' => 'ap_fonts_site_desc', 'info' =>'Site Tagline'),
	array('label' => 'Page Title', 'tag'=>'#content .entry-title', 'id' => 'ap_fonts_page_title', 'info' =>'Title on Pages'),
	array('label' => 'Post Entry Titles', 'tag'=>'#content .entry-title a', 'id' => 'ap_fonts_post_entry_title', 'info' =>'Titles for posts'),
	array('label' => 'Post Format Title', 'tag'=>'#content .entry-format', 'id' => 'ap_fonts_entry_format', 'info' =>'Pre-Title for posts with Post Format specified'),
	array('label' => 'Widget Title', 'tag'=>'.widget-title,.widget_search label,#wp-calendar caption', 'id' => 'ap_fonts_wdg_title', 'info' =>'Widget titles and labels'),


	array('label' => 'OTHER FONTS', 'tag'=>'yyy', 'id' => '_otherfonts', 'info' =>'Content and other fonts'),
	array('label' => 'Page Content Text', 'tag'=>'#content, #content input, #content textarea', 'id' => 'ap_fonts_page_content', 'info' =>'Main Content'),
	array('label' => 'Post Content Text', 'tag'=>'#content .post, #content .post input, #content .post textarea', 'id' => 'ap_fonts_post_content', 'info' =>'Post Content (same as Main unless otherwise specified here)'),
	array('label' => 'Widget Area Text', 'tag'=>'.widget-area', 'id' => 'ap_fonts_wdg_content', 'info' =>'Widget area content'),
	array('label' => 'Post Info text', 'tag'=>'.entry-meta, .entry-content label, .entry-utility', 'id' => 'ap_fonts_post_info', 'info' =>'Post information text'),
	array('label' => 'Navigation', 'tag'=>'.navigation', 'id' => 'ap_fonts_navigation', 'info' =>'Next/Previuos posts links'),
	array('label' => 'Captions', 'tag'=>'.wp-caption p.wp-caption-text, #content .gallery .gallery-caption', 'id' => 'ap_fonts_captions', 'info' =>'Captions, e.g., below media images'),
	array('label' => 'Standard Links', 'tag'=>'a', 'id' => 'ap_fonts_links', 'info' =>'Most links'),
	array('label' => 'Post Info links', 'tag'=>'.entry-meta a, .entry-utility a', 'id' => 'ap_fonts_meta_links', 'info' =>'inks in post information lines'),
	array('label' => 'Widget Links', 'tag'=>'yyy', 'id' => 'ap_fonts_wdg_links', 'info' =>'Links in widgets'),


	array('label' => 'CUSTOM FONT RULES', 'tag'=>'', 'id' => '_menus', 'info' =>'Specify fonts for other CSS elements'),
	array('label' => 'Custom 1', 'tag'=>'+++', 'id' => 'ap_fonts_custom1', 'info' =>'Custom font - include rule name in edit box'),
	array('label' => 'Custom 2', 'tag'=>'+++', 'id' => 'ap_fonts_custom2', 'info' =>'Custom font - example: ".my-class {font-style:italic;}"'),
	array('label' => 'Custom 3', 'tag'=>'+++', 'id' => 'ap_fonts_custom3', 'info' =>'Custom font'),
	array('label' => 'Custom 4', 'tag'=>'+++', 'id' => 'ap_fonts_custom4', 'info' =>'Custom font')
  );



// ===============================  options =============================

function aspen_pro_getopt($opt) {
	global $aspen_pro_opts_cache;
	if (!$aspen_pro_opts_cache)
		$aspen_pro_opts_cache = get_option('aspen_pro_settings' ,array());

	if (!isset($aspen_pro_opts_cache[$opt]))    // handles changes to data structure
	  {
		return false;
	  }
	return $aspen_pro_opts_cache[$opt];
}

function aspen_pro_setopt($opt, $val, $save = true) {
	global $aspen_pro_opts_cache;
	if (!$aspen_pro_opts_cache)
		$aspen_pro_opts_cache = get_option('aspen_pro_settings' ,array());

	$aspen_pro_opts_cache[$opt] = $val;
	if ($save)
		aspen_pro_wpupdate_option('aspen_pro_settings',$aspen_pro_opts_cache);
}

function aspen_pro_save_all_options() {
	global $aspen_pro_opts_cache;
	aspen_pro_wpupdate_option('aspen_pro_settings',$aspen_pro_opts_cache);
}

function aspen_pro_delete_all_options() {
	global $aspen_pro_opts_cache;
	$aspen_pro_opts_cache = false;
	if (current_user_can( 'manage_options' ))
		delete_option( 'aspen_pro_settings' );
}

function aspen_pro_wpupdate_option($name,$opts) {
	if (current_user_can( 'manage_options' )) {
		update_option($name, $opts);
	}
}

// =============================== transient options =============================

if (!function_exists('aspen_pro_globals')) {
	function aspen_pro_globals($glb) {
	return isset($GLOBALS[$glb]) ? $GLOBALS[$glb] : '';
}
}

if (!function_exists('aspen_pro_t_set')) {
	function aspen_pro_t_set($opt, $val) {
	$GLOBALS['aspen_temp_opts'][$opt] = $val;
}
}

if (!function_exists('aspen_pro_t_get')) {
	function aspen_pro_t_get($opt) {
	return isset($GLOBALS['aspen_temp_opts'][$opt]) ? $GLOBALS['aspen_temp_opts'][$opt] : '';
}
}

if (!function_exists('aspen_pro_t_clear')) {
	function aspen_pro_t_clear($opt) {
	unset($GLOBALS['aspen_temp_opts'][$opt]);
}
}

if (!function_exists('aspen_pro_t_clear_all')) {
	function aspen_pro_t_clear_all() {
	unset($GLOBALS['aspen_temp_opts']);
}
}

//======================================== runtime support filteres and actions ===============

add_action('get_header','aspen_pro_get_header_action');

function aspen_pro_get_header_action() {

    if ( function_exists('aspen_getopt') ) {
        $code = aspen_getopt('_phpactions');

        if ($code)
            eval($code);
    }
}

add_action( 'widgets_init', 'aspen_pro_widgets_init', 11 );

function aspen_pro_widgets_init() {
	// Header Horizontal Widget area
	register_sidebar( array(
		'name' => '&#149; ' . 'Header Horizontal Widget Area',  /* the &#149; makes our names closer to unique */
		'id' => 'header-widget-area',
		'description' => 'This horizontal widget area is placed right before the standard Header Image. See options on Main Options:Header tab. Be sure to set width for each widget added.',
		'before_widget' => "\t\t" . '<div id="%1$s" class="header-widget %2$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<span class="header-widget-title">',
		'after_title' => '</span>',
	) );
}

?>
