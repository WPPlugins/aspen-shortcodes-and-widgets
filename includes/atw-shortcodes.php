<?php
/*
 Aspen/Weaver/Generic shortcodes
 Part of the Aspen Plus plugin
*/

function atw_setup_shortcodes() {
    // we setup all of our shortcodes only after the theme has been loaded...

    $codes = array(						// list of shortcodes
	array('all' => array('div' => 'atw_sc_div',
			     'aspen_div' => 'atw_sc_div',
                             'weaver_div' => 'atw_sc_div' )),           // [div]
	array('all' => array('html' => 'atw_sc_html',
			    'aspen_html' => 'atw_sc_html',
                            'weaver_html' => 'atw_sc_html')),		// [html]
	array('all' => array('span' => 'atw_sc_span',
			     'aspen_span' => 'atw_sc_span',
                             'weaver_span' => 'atw_sc_span')),	       	// [span]

	array('all' => array('aspen_hide_if_logged_in' => 'atw_sc_hide_if_logged_in',
                                'weaver_hide_if_logged_in' => 'atw_sc_hide_if_logged_in',
                                'aspen_show_if_logged_in' => 'atw_sc_show_if_logged_in',
                                'weaver_show_if_logged_in' => 'atw_sc_show_if_logged_in'
                            )),	      		// [aspen/weaver_show/hide_if_logged_in]

	array('all' => array('aspen_hide_if_mobile' => 'atw_sc_hide_if_mobile',
                                'weaver_hide_if_mobile' => 'atw_sc_hide_if_mobile',
                                'aspen_show_if_mobile' => 'atw_sc_show_if_mobile',
                                'weaver_show_if_mobile' => 'atw_sc_show_if_mobile'
                            )),      		// [aspen/weaver_show/hide_if_mobile]

	array('all' => array('aspen_bloginfo' => 'atw_sc_bloginfo',
				'weaver_bloginfo' => 'atw_sc_bloginfo')),      // [aspen/weaver_bloginfo]

	array('all' => array('aspen_breadcrumbs' => 'atw_sc_breadcrumbs',
                            'weaver_breadcrumbs' => 'atw_sc_breadcrumbs')),      // [aspen/weaver_breadcrumbs]

	array('all' => array('aspen_header_image' => 'atw_sc_header_image',
                            'weaver_header_image' => 'atw_sc_header_image')),      // [aspen/weaver_header_image]

	array('all' => array('aspen_pagenav' => 'atw_sc_pagenav',
                            'weaver_pagenav' => 'atw_sc_pagenav')),      // [aspen/weaver_pagenav]

	array('all' => array('aspen_iframe' => 'atw_sc_iframe',
                            'weaver_iframe' => 'atw_sc_iframe')),      // [aspen/weaver_iframe]

	array('all' => array('aspen_site_desc' => 'atw_sc_site_desc',
                            'weaver_site_desc' => 'atw_sc_site_desc')),     // [aspen/weaver_site_desc]

	array('all' => array('aspen_site_title' => 'atw_sc_site_title',
                            'weaver_site_title' => 'atw_sc_site_title')),     // [aspen/weaver_site_title]

	array('all' => array('aspen_tab_group' => 'atw_sc_tab_group',
                            'aspen_tab' => 'atw_sc_tab')),     		// [aspen_tab_group], [aspen_tab] - new, no weaver version

	array('all' => array('aspen_user_can' => 'atw_sc_user_can')),      // [aspen_user_can]

	array('all' => array('aspen_vimeo' => 'atw_sc_vimeo',
                            'weaver_vimeo' => 'atw_sc_vimeo')),      // [aspen/weaver_vimeo]

	array('all' => array('aspen_youtube' => 'atw_sc_youtube',
                            'weaver_youtube' => 'atw_sc_youtube')),  // [aspen/weaver_youtube]

	array('all' => array('aspen_info' => 'atw_aspen_sc_info',
                             'weaver_info' => 'atw_aspen_sc_info')),     // [aspen/weaver_info]


	array('aspen' => array('aspen_show_posts' => 'atw_aspen_show_posts_sc',     // [aspen/weaver_show_posts]
                            'weaver_show_posts' => 'atw_aspen_show_posts_sc'),
            'wii' => array('aspen_show_posts' => 'atw_wii_show_posts_sc',     // [aspen/weaver_show_posts]
                            'weaver_show_posts' => 'atw_wii_show_posts_sc'),
            'generic' => array('aspen_show_posts' => 'atw_generic_show_posts_sc',     // [aspen/weaver_show_posts]
                            'weaver_show_posts' => 'atw_generic_show_posts_sc')),

	array('aspen_slider' => array('aspen_slider' => 'atw_sc_slider',
			     'aspen_slider_pager' => 'atw_sc_slider_pager',
			     'aspen_slide' => 'atw_sc_slide',
			     'aspen_slider_index' => 'atw_sc_pager_index',
			     'aspen_slider_options' => 'atw_sc_slider_options'))           // [aspen_slider]

    );

   foreach ($codes as $code) {
	atw_set_shortcodes($code);
   }
}

add_action('init', 'atw_setup_shortcodes');  // allow shortcodes to load after theme has loaded so we know which version to use

if (function_exists('aspen_sw_has_bxslider'))
    require_once(dirname( __FILE__ ) . '/atw-bxslider.php');		// the slider

function atw_wii_show_posts_sc($args = '') {
    /* implement [*_show_posts]  */
    if (!atw_is_wii()) return '<strong>[ weaver_show_posts ] not supported.</strong>';
    require_once(dirname( __FILE__ ) . '/atw-showposts-wii.php');
    return atw_wii_show_posts_shortcode($args);
}

function atw_aspen_show_posts_sc($args = '') {
    /* implement [*_show_posts]  */
    if (!atw_is_aspen()) return '<strong>[ weaver_show_posts ] not supported.</strong>';
    require_once(dirname( __FILE__ ) . '/atw-showposts-aspen.php');
    return atw_aspen_show_posts_shortcode($args);
}

function atw_generic_show_posts_sc($args = '') {
    /* implement [*_show_posts]  */
    require_once(dirname( __FILE__ ) . '/atw-showposts-generic.php');
    return atw_generic_show_posts_shortcode($args);
}

// ===============  [weaver_header_image style='customstyle'] ===================
function atw_sc_header_image($args = ''){
    extract(shortcode_atts(array(
	    'style' => '',	// STYLE
	    'h' => '',
	    'w' => ''
    ), $args));

    $width = $w ? ' width="' . $w . '"' : '';
    $height = $h ? ' height="' . $h . '"' : '';
    $st = $style ? ' style="' . $style . '"' : '';

    if (function_exists('weaverii_use_mobile') && weaverii_use_mobile('mobile') && weaverii_getopt('_wii_mobile_header_url')) {
	$hdrimg = '<img src="' . esc_attr(apply_filters('weaverii_css',weaverii_getopt('_wii_mobile_header_url'))) .
	    '" width="100%" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ' .  $st . $width . $height . ' />' ;
    } else {
	$hdrimg = '<img src="' . get_header_image() . '"' . $st . $width . $height
	 . ' alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />' ;
    }
    return $hdrimg;
}

// ===============  [weaver_bloginfo arg='name'] ======================
function atw_sc_bloginfo($args = '') {
    extract(shortcode_atts(array(
	    'arg' => 'name',		// a WP bloginfo name
	    'style' => ''		// wrap with style
    ), $args));

    $code = '';
    if ($style != '') $code = '<span style="' . $style . '">';
    $code .= esc_attr( get_bloginfo( $arg ));
    if ($style != '') $code .= '</span>';
    return $code;
}

// ===============  [weaver_site_title style='customstyle'] ======================
function atw_sc_site_title($args = '') {
    extract(shortcode_atts(array(
	    'style' => ''		/* styling for the header */
    ), $args));
    $title = esc_attr( get_bloginfo( 'name', 'display' ));
    if (function_exists('weaverii_use_mobile')) {
        if (weaverii_getopt('_wii_mobile_site_title') && weaverii_use_mobile('mobile') )
		$title = esc_html(weaverii_getopt('_wii_mobile_site_title'));
    }

    if ($style) {
	return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;

}

// ===============  [weaver_site_title style='customstyle'] ======================
function atw_sc_site_desc($args = '') {
    extract(shortcode_atts(array(
	    'style' => ''		/* styling for the header */
    ), $args));
    $title = get_bloginfo( 'description' );

    if ($style) {
	return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;
}

// ===============  [weaver_breadcrumbs style='customstyle'] ======================
function atw_sc_breadcrumbs($args = '') {
    extract(shortcode_atts(array(
	    'style' => '',
	    'class' => 'breadcrumbs' /* styling for the header */
    ), $args));

    require_once(dirname( __FILE__ ) . '/atw-breadcrumbs.php'); // NOW - load the admin stuff

    $title = atw_breadcrumb(false, $class);

    if ($style) {
	return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;

}


// ===============  [weaver_pagenav style='customstyle'] ======================
function atw_sc_pagenav($args = '') {

    return "<strong>Sorry, the 'pagenav' shortcode is not supported...</strong>\n";
}

// ===============  [weaver_iframe src='address' height=nnn] ======================
function atw_sc_iframe($args = '') {
    extract(shortcode_atts(array(
	    'src' => '',
	    'height' => '600', /* styling for the header */
	    'percent' => 100,
	    'style' => 'border:1px;'
    ), $args));

    $sty = $style ? ' style="' . $style . '"' : '';

    if (!$src) return '<h4>No src address provided to [iframe].</h4>';
    return "\n" . '<iframe src="' . $src . '" height="' .  $height . 'px" width="' . $percent . '%"' . $sty . '></iframe>' . "\n";
}

// ===============  [weaver_show_if_mobile style='customstyle'] ======================
function atw_sc_show_if_mobile($args = '',$text) {
    extract(shortcode_atts(array(
	    'type' => 'mobile'		// mobile, smalltablet, tablet, any
    ), $args));

    if ( function_exists('weaverii_smart_mode') && weaverii_smart_mode() ) {
	if ( weaverii_use_mobile($type) ) {
	    return do_shortcode($text);
	} else {
	    return '';
	}
    } else {
	if ($type == 'touch') $type = 'mobile';
	return '<span class="atw-show-mobile-' . $type . '">' . do_shortcode($text) . '</span>';
    }

    return '';
}

function atw_sc_hide_if_mobile($args = '',$text) {
    extract(shortcode_atts(array(
	    'type' => 'mobile'		// mobile, touch, tablet, any
    ), $args));

    if (function_exists('weaverii_smart_mode') && weaverii_smart_mode() ) {
	if ( !weaverii_use_mobile($type) ) {
	    return do_shortcode($text);
	} else {
	    return '';
	}
    } else {
	if ($type == 'touch') $type = 'mobile';
	return '<span class="atw-hide-mobile-' . $type . '">' . do_shortcode($text) . '</span>';
    }

    return '';
}

// ===============  [weaver_show_if_logged_in] ======================
function atw_sc_show_if_logged_in($args = '',$text) {

    if (is_user_logged_in()) {
	return do_shortcode($text);
    }
    return '';
}

function atw_sc_hide_if_logged_in($args = '',$text) {

    if (!is_user_logged_in()) {
	return do_shortcode($text);
    }
    return '';
}


// ===============  [aspen_tab_group ] ======================
function atw_sc_tab_group( $args, $content ) {
    extract( shortcode_atts( array(
	'border_color' => '',		// tab and pane bodder color - default #888
	'tab_bg' => '',			// normal bg color of tab (default #CCC)
	'tab_selected_color' => '',	// color of tab when selected (default #EEE)
	'pane_min_height' => '',	// min height of a pane to help make all even if needed
	'pane_bg' => ''			// bg color of pane
    ), $args ) );

    if (isset($GLOBALS['atw_in_tab_container']) && $GLOBALS['atw_in_tab_container']) {
	return '<strong>Sorry, you cannot nest tab_containers.</strong>';
    }

    $css = '';	// default styles
    $add_style = '';
    if ($border_color != '')
	$css .= '.atw-tabs-style .atw-tabs-pane,
	.atw-tabs-style .atw-tabs-nav span {border-color:' . $border_color . ";}\n";

    if ($pane_min_height != '')
	$css .= '.atw-tabs-style .atw-tabs-pane {min-height:' . $pane_min_height . ";}\n";

    if ($pane_bg != '')
	$css .= '.atw-tabs-style .atw-tabs-pane {background-color:' . $pane_bg . ";}\n";

    if ($tab_bg != '')
	$css .= '.atw-tabs-style .atw-tabs-nav span {background-color:' . $tab_bg . ";}\n";

    if ($tab_selected_color != '')
	$css .= '.atw-tabs-style .atw-tabs-nav span.atw-tabs-current,
.atw-tabs-style .atw-tabs-nav span:hover {background-color:' . $tab_selected_color . ";}\n";

    if ($css != '') {	// specified some style...
	$add_style = "<style type=\"text/css\">\n" . $css . "</style>\n";
    }

    $GLOBALS['atw_in_tab_container'] = true;
    $GLOBALS['atw_num_tabs'] = 0;

    do_shortcode( $content );	// process the tabs on this

    if ( is_array( $GLOBALS['atw_tabs'] ) ) {
	foreach ( $GLOBALS['atw_tabs'] as $tab ) {
		$tabs[] = '<span>' . $tab['title'] . '</span>'. "\n";
		$panes[] = "\n" .'<div class="atw-tabs-pane">' . $tab['content'] . '</div>';
	}
	$out = '<div class="atw-tabs atw-tabs-style"> <!-- tab_group -->' . "\n"
	    . '<div class="atw-tabs-nav">' . "\n"
	    . implode( '', $tabs ) . '</div>' . "\n"
	    . '<div class="atw-tabs-panes">'
	    . implode( '', $panes ) . "\n"
	    . '</div><div class="atw-tabs-clear"></div>' . "\n"
	    . '</div> <!-- end tab_group -->' . "\n";
    }

    // Forget globals we generated
    unset( $GLOBALS['atw_in_tab_container'],$GLOBALS['atw_tabs'],$GLOBALS['atw_num_tabs']);

    return $add_style . $out;
}

function atw_sc_tab( $args, $content ) {
    extract( shortcode_atts( array(
	'title' => 'Tab %d'
    ), $args ) );
    $cur = $GLOBALS['atw_num_tabs'];
    $GLOBALS['atw_tabs'][$cur] = array(
	'title' => sprintf( $title, $GLOBALS['atw_num_tabs'] ),		// the title with number
	'content' => do_shortcode( $content ) );
    $GLOBALS['atw_num_tabs']++;

}



// =============== [aspen_user_can] ===================
function atw_sc_user_can($args = '',$content='') {
    extract( shortcode_atts( array(
	'role' => '',
	'alttext' => '',
    'not' => false
    ), $args ) );

    $code = '';
    if ($role != '' && (!$not && current_user_can($role)) ) {
        $code = do_shortcode($content);
    } else {
        $code = $alttext;
    }
    return $code;
}

// ===============  [weaver_youtube id=videoid sd=0 hd=0 related=0 https=0 privacy=0 w=0 h=0] ======================
function atw_sc_youtube($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
	$share = trim($args[0]);

    // http://code.google.com/apis/youtube/player_parameters.html
    // not including: enablejsapi, fs,playerapiid,

    extract(shortcode_atts(array(
        'id' => '',
        'sd' => false,
        'related' => '0',
        'https' => false,
        'privacy' => false,
        'ratio' => false,
        'center' => '1',
        'autohide' => '~!',
        'autoplay' => '0',
        'border' => '0',
        'color' => false,
        'color1' => false,
        'color2' => false,
        'controls' => '1',
        'disablekb' => '0',
        'egm' => '0',
        'fs' => '1',
        'fullscreen' => 1,
        'hd' => '0',
        'iv_load_policy' => '1',
        'loop' => '0',
        'modestbranding' => '0',
        'origin' => false,
        'percent' => 100,
        'playlist' => false,
        'rel' => '0',
        'showinfo' => '1',
        'showsearch' => '1',
        'start' => false,
        'theme' => 'dark',
        'w' => '~!',
        'wmode' => 'transparent'

    ), $args));

    if (!$share && !$id) return '<strong>No share or id values provided for youtube shortcode.</strong>';
    if ($share)	{	// let the share override any id
        $share = str_replace('http://youtu.be/','',$share);
        if (strpos($share,'youtube.com/watch') !== false) {
            $share = str_replace('http://www.youtube.com/watch?v=', '', $share);
            $share = str_replace('&amp;','+',$share);
            $share = str_replace('&','+',$share);
        }
        if ($share) $id = $share;
    }

    $opts = $id . '%%';

    $opts = atw_add_url_opt($opts, $hd != '0', 'hd=1');
    $opts = atw_add_url_opt($opts, $autohide != '~!', 'autohide='.$autohide);
    $opts = atw_add_url_opt($opts, $autoplay != '0', 'autoplay=1');
    $opts = atw_add_url_opt($opts, $border != '0', 'border=1');
    $opts = atw_add_url_opt($opts, $color, 'color='.$color);
    $opts = atw_add_url_opt($opts, $color1, 'color1='.$color1);
    $opts = atw_add_url_opt($opts, $color2, 'color2='.$color2);
    $opts = atw_add_url_opt($opts, $controls != '1', 'controls=0');
    $opts = atw_add_url_opt($opts, $disablekb != '0', 'disablekb=1');
    $opts = atw_add_url_opt($opts, $egm != '0', 'egm=1');
    $opts = atw_add_url_opt($opts, true, 'fs='.$fs);
    $opts = atw_add_url_opt($opts, true, 'iv_load_policy='.$iv_load_policy);
    $opts = atw_add_url_opt($opts, $loop != '0', 'loop=1');
    $opts = atw_add_url_opt($opts, $modestbranding != '0', 'modestbranding=1');
    $opts = atw_add_url_opt($opts, $origin, 'origin='.$origin);
    $opts = atw_add_url_opt($opts, $playlist, 'playlist='.$playlist);
    $opts = atw_add_url_opt($opts, true, 'rel='.$rel);
    $opts = atw_add_url_opt($opts, true, 'showinfo=' . $showinfo);
    $opts = atw_add_url_opt($opts, $showsearch != '1', 'showsearch=0');
    $opts = atw_add_url_opt($opts, $start, 'start='.$start);
    $opts = atw_add_url_opt($opts, $theme != 'dark', 'theme=light');
    $opts = atw_add_url_opt($opts, $wmode, 'wmode='.$wmode);

    if ($https) $url = 'https://';
    else $url = 'http://';
    if ($privacy) $url .= 'www.youtube-nocookie.com';
    else $url .= 'www.youtube.com';

    $opts = str_replace('%%+','%%?', $opts);
    $opts = str_replace('%%','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= '/embed/' . $opts;

    $vert = $sd ? 0.75 : 0.5625;
    if ($ratio) $vert = $ratio;
    if (function_exists('weaverii_use_mobile'))
        if (weaverii_use_mobile('mobile') && $percent < 90) $percent = 99;

    $allowfull = $fullscreen ? ' allowfullscreen' : '';
    $cntr1 = $center ? '<div style="text-align:center">' : '';
    $cntr2 = $center ? '</div>' : '';

    if (aspen_sw_getopt('video_fitvids') && $w == '~!') {	// fitvids forces override of percent, etc
	$w = 640;	// a reasonable number
    }

    if ($w != '~!' && $w != 0) {
	$h = ($w * $vert) + 5;
	$ret ="\n" . $cntr1 . '<iframe src="' . $url
     . '" frameborder="0" width="'.$w.'" height="' . $h . '"></iframe>'
     . $cntr2 . "\n";

    } else {
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" frameborder="0" width="'.$percent.'%" height="0" onload="atw_fixVideo(this,'.$vert.');"></iframe>'
     . $cntr2 . "\n";
    }

    return $ret;
}

// ===============  [weaver_vimeo id=videoid sd=0 w=0 h=0 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1] ======================
function atw_sc_vimeo($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
	$share = trim($args[0]);

    extract(shortcode_atts(array(
	'id' => '',
	'sd' => false,
	'color' => '',
	'autoplay' => false,
	'loop' => false,
	'portrait' => true,
	'title' => true,
	'byline' => true,
	'ratio' => false,
	'percent' => 100,
	'center' => '1',
	'w' => '~!'
    ), $args));

    if (!$share && !$id) return '<strong>No share or id values provided for vimeo shortcode.</strong>';

    if ($share)	{	// let the share override any id
	$share = str_replace('http://vimeo.com/','',$share);
	if ($share) $id = $share;
    }

    $opts = $id . '##';

    $opts = atw_add_url_opt($opts, $autoplay, 'autoplay=1');
    $opts = atw_add_url_opt($opts, $loop, 'loop=1');
    $opts = atw_add_url_opt($opts, $color, 'color=' . $color);
    $opts = atw_add_url_opt($opts, !$portrait, 'portrait=0');
    $opts = atw_add_url_opt($opts, !$title, 'title=0');
    $opts = atw_add_url_opt($opts, !$byline, 'byline=0');

    $url = 'http://player.vimeo.com/video/';

    $opts = str_replace('##+','##?', $opts);
    $opts = str_replace('##','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= $opts;

    if (function_exists('weaverii_use_mobile'))
        if (weaverii_use_mobile('mobile')) $percent = 100;

    $vert = $sd ? 0.75 : 0.5625;
    if ($ratio) $vert = $ratio;
    $cntr1 = $center ? '<div style="text-align:center">' : '';
    $cntr2 = $center ? '</div>' : '';

    if (aspen_sw_getopt('video_fitvids') && $w = '~!') {	// fitvids forces override of percent, etc
	$w = 640;	// a reasonable number
    }

    if ($w != '~!' && $w != 0) {
        $h = ($w * $vert) + 5;
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="'.$w.'" height="'. $h . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen "></iframe>'
     . $cntr2 . "\n";

    } else {
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="'.$percent.'%" height="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen onload="atw_fixVideo(this,'.$vert.');"></iframe>'
     . $cntr2 . "\n";
    }

    return $ret;
}

// ===== video utils =====

function atw_add_url_opt($opts, $add, $add_val) {
    if ($add) {
	$opts = $opts . '+' . $add_val;
    }
    return $opts;
}



function atw_sc_html($vals = '') {           //  [html style='customstyle'] - all ======================
    $tag = 'span';
    if ( isset ( $vals[0] ) )
	$tag = trim( $vals[0]);

    extract(shortcode_atts(array(
	'args' => ''
    ), $vals));
    if ($args) $args = ' ' . $args;
    return '<' . $tag . $args .  '>';
}

function atw_sc_div($vals = '',$text) {              // [div] - all  ===================
    extract(shortcode_atts(array(
	'id' => '',
	'class' => '',
	'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<div' . $args . '>' . do_shortcode($text) . '</div>';
}

function atw_sc_span($vals = '',$text) {     // [span] - all ==================
    extract(shortcode_atts(array(
	'id' => '',
	'class' => '',
	'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<span' . $args . '>' . do_shortcode($text) . '</span>';
}

function atw_aspen_sc_info() {           // [aspen_info] - aspen, generic ======================
    global $current_user;
    $out = '<strong>Theme/User Info</strong><hr />';

    get_currentuserinfo();
    if (isset($current_user->display_name)) {
	$out .= '<em>User:</em> ' . $current_user->display_name . '<br />';
    }
    $out .= '&nbsp;&nbsp;' . wp_register('','<br />',false);
    $out .= '&nbsp;&nbsp;' . wp_loginout('',false) . '<br />';

    $agent = 'Not Available';
    if (isset($_SERVER["HTTP_USER_AGENT"]) )
	$agent = $_SERVER['HTTP_USER_AGENT'];
    $out .= '<em>User Agent</em>: <small>' . $agent . '</small>';
    $out .= '<div id="example"></div>
<script type="text/javascript">
var txt = "";
var myWidth;
if( typeof( window.innerWidth ) == "number" ) {
//Non-IE
myWidth = window.innerWidth;
} else if( document.documentElement &&
( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
//IE 6+ in "standards compliant mode"
myWidth = document.documentElement.clientWidth;
} else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
//IE 4 compatible
myWidth = document.body.clientWidth;
}
txt+= "<em>Browser Width: </em>" + myWidth + " px</br>";
document.getElementById("example").innerHTML=txt;
</script>';

    $out .= '<em>Feed title:</em> ' . get_bloginfo_rss('name') . '<br />' . get_wp_title_rss();

    $out .= '<br /><em>You are using</em> WordPress ' . $GLOBALS['wp_version'] . '<br /><em>PHP Version:</em> ' . phpversion();
    $out .= '<br /><em>Memory:</em> ' . round(memory_get_usage()/1024/1024,2) . 'M of ' .  (int)ini_get('memory_limit') . 'M <hr />';
    return $out;
}


function atw_generic() {
    echo "<h3>*** SHORTCODE NOT IMPLEMENTED ***<h3>";
}

function atw_set_shortcodes($sc_list) {
    foreach ($sc_list as $sc_theme => $sc_list) {
        switch ($sc_theme) {
        case 'all':
            atw_add_shortcodes($sc_list);
            break;
        case 'aspen':
            if (atw_is_aspen()) atw_add_shortcodes($sc_list);
            break;
        case 'wii':
            if (atw_is_wii()) atw_add_shortcodes($sc_list);
            break;
        case 'generic':
            if (atw_is_generic()) atw_add_shortcodes($sc_list);
            break;
	case 'aspen_slider':					// allow aspen slider plugin to override
	    if (function_exists('aspen_sw_has_bxslider'))
		atw_add_shortcodes($sc_list);
	    break;
        }
    }
}

function atw_add_shortcodes($sc_list) {
    foreach ($sc_list as $sc => $func) {
	if ( aspen_sw_getopt('generic_shortcodes') ) {		// make generic
	    $sc = str_replace('aspen_','',$sc);
	}
	remove_shortcode($sc);
	add_shortcode($sc,$func);
    }
}

// ===============  Utilities ======================

function atw_is_aspen() {
    return function_exists( 'aspen_setup' );
}

function atw_is_wii() {
    return function_exists( 'weaverii_setup' );
}

function atw_is_generic() {
    // version for a generic theme
    return !function_exists( 'aspen_setup' ) && !function_exists( 'weaverii_setup' );
}
?>
