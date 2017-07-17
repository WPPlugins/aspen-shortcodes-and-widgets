<?php
// Runtime actions and filters
//

add_action('aspen_pro','aspen_pro_actions');

function aspen_pro_actions( $action ) {

    switch ($action) {
	// do_action('aspen_pro','footer');    // right after inject post-footer in footer.php, outside #wrapper
	// do_action('aspen_pro','head');       // stuff like other style files, in <head> block, near top (header.php)
	// do_action('aspen_pro','header_area_top'); // after inject header, right before header_image (header.php)
	// do_action('aspen_pro','header_area_bottom'); // right before </header>, after header_image (header.php)
	//

	case 'head':
	    aspen_pro_do_head();
	    break;

	case 'header_area_top':
	    aspen_pro_header_widget_area('top');
	    break;

	case 'header_area_bottom':
	    aspen_pro_header_widget_area('bottom');
	    break;

	default:
	    //echo '<h2 style="background-color:red; padding:10px; border:2px solid black;">Aspen Pro: ' . $action . '</h2>';
	    break;
    }
}

// ==========================================  PRO CSS ========================================

add_action('aspen_pro_css','aspen_pro_css_action'); // output css
function aspen_pro_css_action($sout) {
    aspen_f_write($sout,sprintf("\n/* Aspen  CSS Styles - Version %s */\n",ASPEN_PRO_VERSION));
    // === HEADER HORIZONTAL WIDGET AREA

//_hdr_widg_hide_mobile
// '_hdr_widg_hide_normal'
// <div id="sidebar_header" class="sidebar-header">

    aspen_f_write($sout,
'.sidebar-header {clear:both;height:auto;margin:0;padding:0;max-width:100%;overflow:hidden;}
.sidebar-header .header-widget {float:left;height:100%;max-width:100%;padding-bottom:100%;margin-bottom:-100%;width:auto;}
');

    aspen_put_bgcolor($sout,'_hdr_widg_bgcolor','.sidebar-header');
    aspen_css_style_val($sout, '.sidebar-header', '{height:%dpx;}',
			   '_hdr_widg_h_int');
    aspen_css_style_val($sout, '.sidebar-header', '{font-size:%d%%;}',
			   '_hdr_widg_fontsize');

    $threshold = aspen_getopt('mobile_slide_threshold');
    $threshold = $threshold != '' ? $threshold : '640';

    if (aspen_getopt('_hdr_widg_hide_normal')) {     // hide header widget area on desltop
        aspen_f_write($sout,'@media only screen and (min-width:'. ($threshold + 1) . 'px) {
.sidebar-header{display:none;}}'."\n");
    }
    aspen_f_write($sout,'@media only screen and (min-width:'. ($threshold + 1) . 'px) {
#inject_mobile_header{display:none;}}'."\n");   // hide inject_mobile_header on desktops

    for ($i = 1; $i < 5 ; $i++) {
        aspen_put_bgcolor($sout,'_hdr_widg_' . $i .'_bgcolor','.sidebar-header .header-widget-' . $i);
        // standard rules
        if (($val = aspen_getopt('_hdr_widg_' . $i .'_w_int')) != '') {
                // I don't know why these need important: #sidebar_header .header-widget-n worked before, but adding the shortcoe
                // support required the change from #sidebar_header to the class, and .sidebar-header .header-widget-n fails...
            if ($val == '0')
                aspen_f_write($sout, sprintf(".sidebar-header .header-widget-%d {display:none !important;}\n", $i));
            else {
                aspen_f_write($sout, sprintf(".sidebar-header .header-widget-%d {width:%d%% !important;}\n", $i, $val));
            }
        }
    }

    // mobile rules...
    aspen_f_write($sout,'@media only screen and (max-width:'. ($threshold) . 'px) { /* header widget area mobile rules */' . "\n");
    aspen_f_write($sout,'#inject_desktop_header {display:none;}'."\n");   // hide inject_desktop_header on desktops
    if (aspen_getopt('_hdr_widg_hide_mobile')) {
        aspen_f_write($sout,".sidebar-header{display:none;}\n");
    } else {
        for ($i = 1; $i < 5 ; $i++) {
            if (($valm = aspen_getopt('_hdr_widg_' . $i .'_w_mobile_int')) != '') {
            if ($valm == '0')
                aspen_f_write($sout, sprintf(".sidebar-header .header-widget-%d {display:none !important;}\n", $i));
            else
                aspen_f_write($sout, sprintf(".sidebar-header .header-widget-%d {width:%d%% !important;}\n", $i, $valm));
            }
        }
    }
    aspen_f_write($sout,"} /* end mobile rules */\n");

// ========================= WIDE HEADER/FOOTER ==================================

    if (aspen_getopt('header_first')) {     // wants a wide footer area
        $themew = aspen_getopt('theme_width_int');   // need here and for layout below
        if (!$themew) $themew = 940;    // nothing will work right if this doesn't have a value

        $h_width = aspen_getopt('header_area_width_int');
        $h_width_code = $h_width ? $h_width . 'px' : '100%';

        $h_content_width = aspen_getopt('header_first_content') ? $h_width_code : $themew . 'px';
        aspen_f_write($sout, '#wrap-header {max-width:' . $h_width_code . ';margin:auto;}
    #branding-content {max-width:' . $h_content_width . '; margin-left:auto;margin-right:auto;}
    ');
        if (! aspen_getopt('header_first_content')
            && (aspen_getopt('title_over_header') || aspen_getopt('desc_over_header') ||aspen_getopt('header_html_over_header'))) {
            aspen_f_write($sout,'#branding-content {position:relative;}' . "\n");
        }

        if ( !aspen_getopt('header_first_menus')) {   // constrained menus
            aspen_put_bgcolor($sout,'menubar_bgcolor','#wrap-header #wrap-top-menu,#wrap-header #wrap-bottom-menu');
            aspen_f_write($sout,'#wrap-header #wrap-top-menu,#wrap-header #wrap-bottom-menu {width:100%;float:left;}
    ');
            aspen_f_write($sout,'#wrap-header #mobile-bottom-nav,#wrap-header #mobile-top-nav{background-color:transparent;}
    ');
            aspen_f_write($sout, '#wrap-header #nav-bottom-menu, #wrap-header #nav-top-menu {max-width:' . $h_width_code . ';margin-left:auto;margin-right:auto;}
    ');
        aspen_f_write($sout, '#wrap-header .menu_bar{background-color:transparent;float:none;max-width:' . $themew . 'px;margin-left:auto;margin-right:auto;}' . "\n");
        aspen_f_write($sout, '#wrap-header .menu-vertical li a, #wrap-header .menu-vertical.menu-vertical a:visited {background-color:transparent;}' . "\n");
        } else {
            aspen_f_write($sout, '#wrap-header .menu_bar {max-width:100%;}');
        }

        if (aspen_getopt_checked('menu_shadow')) {
            aspen_f_write($sout,'#wrap-header #nav-bottom-menu, #wrap-header #nav-top-menu {-webkit-box-shadow: rgba(0, 0, 0, 0.4) 2px 4px 6px;
-moz-box-shadow: rgba(0, 0, 0, 0.4) 2px 4px 6px; box-shadow: rgba(0, 0, 0, 0.4) 2px 4px 6px;}
.menu_bar {-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
');
            aspen_f_write($sout, '#wrap-header #nav-bottom-menu {margin-bottom:4px;}
    ');
        }
    }

    if (aspen_getopt('footer_last')) {     // wants a wide footer area
        $f_width = aspen_getopt('footer_width_int');
        $f_width_code = $f_width ? $f_width . 'px' : '100%';

        $f_content_width = aspen_getopt('footer_wide_content') ? $f_width_code : $themew . 'px';

        aspen_f_write($sout, '#colophon {max-width:' . $f_width_code . ';margin-left:auto;margin-right:auto;}
#sidebar_wrap_footer, #inject_footer, #site-ig-wrap {max-width:' . $f_content_width . ';margin-left:auto;margin-right:auto;}
');

    }

    if (aspen_getopt('header_actual_size')) {

        $layout = aspen_getopt('header_layout');
        $rule = '{width:auto;margin-left:auto;margin-right:auto;}';
        switch ($layout) {
            case 'right':
                $rule = '{width:auto;margin-right:0;margin-left:auto;}';
                break;
            case 'left':
                $rule = '{width:auto;margin-right:auto;margin-left:0;}';
                break;
            default:
                break;
        }
        aspen_f_write($sout, '#branding #header_image img, #ie8 #branding #header_image img' . $rule . "\n");
    }

    if (aspen_getopt('wide_main_bg')) {
        aspen_put_bgcolor($sout,'main_bgcolor','#main:before, #main:after');
        aspen_f_write($sout,'#main {position:relative;overflow:visible;}
#main:before, #main:after {content: ""; position: absolute; top: 0; bottom: 0; width: 100%;}
#main:before {right: 100%;}
#main:after {left: 100%;}
html {overflow-x:hidden}
');
    }

// ----------------- FONTS -----------------
    aspen_f_write($sout,"/* Aspen Fonts */\n");

    global $aspen_fonts_defs;
    foreach ($aspen_fonts_defs as $option => $val) {
        $fonts = aspen_getopt($val['id']);
        if ($fonts) {
            $rule = $val['tag'] != '+++' ? $val['tag'] : '';
            aspen_f_write($sout,$rule . $fonts . "\n");
        }
    }

// ======================= background areas ============================
    aspen_f_write($sout,"/* Aspen Background Images */\n");
   $val = aspen_getopt('_bg_fullsite_url');
   if ($val != '') {
	aspen_f_write($sout,
"html {background: url($val) no-repeat center center fixed; -webkit-background-size: cover;
-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
body {background-color:transparent;}\n");
	aspen_f_write($sout,
"#ie8 html, #ie7 html {background:none;}
#ie8 body ,#ie7 body { background-image: url('$val'); background-attachment: fixed; }\n");
// #ie8 body, #ie7 body {background-image: url($val)}\n");
    /* IE8, IE7 scaling - doesn't look good, but here it is...
	  -ms-filter:\"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='$val', sizingMethod='scale')\";
filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='$val', sizingMethod='scale');
    */

   }
   aspen_bgimg_style($sout,'_bg_wrapper_url','#wrapper');
   aspen_bgimg_style($sout,'_bg_header_url','#branding');
   aspen_bgimg_style($sout,'_bg_main_url','#main');
   aspen_bgimg_style($sout,'_bg_container_url','#container_wrap');
   aspen_bgimg_style($sout,'_bg_content_url','#content');
   aspen_bgimg_style($sout,'_bg_page_url','#container .page');
   aspen_bgimg_style($sout,'_bg_post_url','#container .post');
   aspen_bgimg_style($sout,'_bg_widgets_left_url','#sidebar_wrap_left');
   aspen_bgimg_style($sout,'_bg_widgets_right_url','#sidebar_wrap_right');
   aspen_bgimg_style($sout,'_bg_footer_url','#colophon');

}

function aspen_bgimg_style($sout,$id,$name) {
    $val = aspen_getopt($id);
    if ($val != '') {
        $fixid = str_replace('_url','',$id);
        $rpt = aspen_getopt($fixid . '_rpt');
        if (strlen($rpt) < 6) $rpt = 'repeat';  // set to default
        aspen_f_write($sout, $name . '{background-image:url('. apply_filters('aspen_css',parse_url($val,PHP_URL_PATH)) . ');background-repeat:' . $rpt . ';}' . "\n");
    }
}

/* INJECTION AREAS: (add UI with html_insertion action)
 *
 * footer - free
 * postfooter - free
 * prewrapper - free
 * preheader - free
 * header - free
 * -------------
 * premain
 * precontent
 * precomments
 * postcomments
 * postpostcontent
 * prefooter
 * premain
 * precontent
 * presidebar_left
 * presidebar_right
 */

//============================================================= THE CODE ========================================================
//
// -- CONTENT AREA ACTIONS
//

function aspen_pro_header_widget_area($where = 'top') {
    /**
 * The Header widget area.
 *
 */
    if ($where != 'shortcode' && aspen_getopt('_hdr_widg_shortcode_only'))
        return;
    $show_bottom = aspen_getopt('_hdr_widg_afterimg');
    if ( ('top' == $where && $show_bottom)
	|| ('bottom' == $where && !$show_bottom))
        return;

    $harea = 'header-widget-area';

if (is_active_sidebar($harea)
     && !(!is_front_page() && !is_home() && aspen_getopt_checked('_hdr_widg_frontpage')) ) {
?>
	<div class="sidebar-header">
<?php
    // here, we duplicate the functionality of dynamic_sidebar so we can add our own styling
    for (;;) {          // so we can break instead of return
        global $wp_registered_sidebars, $wp_registered_widgets;
        $index = sanitize_title($harea);
        foreach ( (array) $wp_registered_sidebars as $key => $value ) {
            if ( sanitize_title($value['name']) == $index ) {
                $index = $key;
                break;
            }
        }
        // ok, got our index

        $sidebars_widgets = wp_get_sidebars_widgets();
        if ( empty( $sidebars_widgets ) )
            break;          // break the for (;;)

        if ( empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $sidebars_widgets)
            || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]) )
            break;

        $sidebar = $wp_registered_sidebars[$index];

        $did_one = false;
        $widget_num = 0;
        foreach ( (array) $sidebars_widgets[$index] as $id ) {

            if ( !isset($wp_registered_widgets[$id]) )
                continue;

            if ($widget_num > 0 && ($widget_num % 4) == 0) {        // new row every 4 widgets
                echo '<br style="clear:both;"/>';
            }

            $params = array_merge(
                array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
                (array) $wp_registered_widgets[$id]['params']
            );

            // Substitute HTML id and class attributes into before_widget
            $classname_ = '';
            foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
                if ( is_string($cn) )
                    $classname_ .= '_' . $cn;
                elseif ( is_object($cn) )
                    $classname_ .= '_' . get_class($cn);
            }
            $classname_ = ltrim($classname_, '_');

            $classname_ .= ' header-widget-' . (($widget_num % 4) + 1);     // also add unique class to apply styling
            $classname_ .= ' header-widget-num-' . ($widget_num  + 1);              // also add unique class for each one

            $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_ );

            $callback = $wp_registered_widgets[$id]['callback'];
            do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

            if ( is_callable($callback) ) {
                call_user_func_array($callback, $params);
                $did_one = true;
            }
            echo '<span style="clear:both;"></span>';
            $widget_num++;
        } // do each widget
        break;  // get out of the for (;;)
    }
?>
	</div><div style="clear:both;"></div><!-- .sidebar-header -->
<?php
}
}

// ------------------------------------------- <head> ----------------------------
function aspen_pro_do_head() {
// === include Google Fonts links
    $google = aspen_getopt('fonts_google_font_list');
    if ($google) {
        echo ("<!-- Aspen Google Fonts -->\n");
        echo $google . "\n";
    }
}

// ------------------------------------------- Post Meta Info Lines -----------------

add_filter('aspen_posted_in','aspen_pro_posted_in_filter',10,2);
add_filter('aspen_posted_on','aspen_pro_posted_on_filter',10,2);


function aspen_pro_posted_on_filter($po, $type) {

    if (($my_on = aspen_getopt('_custom_posted_on_single')) != '' && $type == 'single') {
        return aspen_pro_post_info_line($my_on);
    }

    if (($my_on = aspen_getopt('_custom_posted_on')) != '' && $type != 'single') {
        return aspen_pro_post_info_line($my_on);
    }
    return $po;
}

function aspen_pro_posted_in_filter($pi, $type) {

    if (($my_in = aspen_getopt('_custom_posted_in_single')) != '' && $type == 'single') {
        $in = aspen_pro_post_info_line($my_in);
        $in .= aspen_edit_link('noecho');
        return $in;
    }
    if (($my_in = aspen_getopt('_custom_posted_in')) != '' && $type != 'single') {
        $in = aspen_pro_post_info_line($my_in);
        $in .= aspen_edit_link('noecho');
        return $in;
    }

    return $pi;
}


if ( ! function_exists( 'aspen_pro_post_info_line' ) ) {
function aspen_pro_post_info_line($info) {
    // build a custom info line based on template in info
/*
%date%, %date-icon%, %author%, %author-icon%, %author-avatar%, %tag%, %tag-icon%, %tag:Label-if-are-tags%, %category%, %category-icon%,
%comments%, %comments-icon%, %permalink%, %permalink-icon% (just the icon) $permalink:Permalink-text% %title% %post-format%
*/

    $out = $info;
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( __( ', ','weaver-ii') );
    $cats = '';
    if ( $categories_list ) {
        $cats .= '<span class="cat-links">' . $categories_list . '</span>';
    } // End if categories

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', __( ', ','weaver-ii') );
    $tags = '';
    if ( $tags_list ) {
        $tags .= '<span class="tag-links">' . $tags_list . '</span>';
    } // End if categories

    $date = sprintf('<a href="%s" title="%s" rel="bookmark"><time class="entry-date" datetime="%s" pubdate>%s</time></a>',
	esc_url( get_permalink() ),
	esc_attr( get_the_time() ),
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ));

    $author = sprintf('<span class="author vcard by-author"><a class="url fn n" href="%s" title="%s" rel="author">%s</a></span></span>',
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	sprintf( esc_attr( __( 'View all posts by %s','weaver-ii')), get_the_author() ),
	esc_html( get_the_author()));

    $author_name = esc_html( get_the_author() );

    $avatar = '<span class="post-avatar post-avatar-tiny"> ' .
	    get_avatar( get_the_author_meta('user_email') ,22,null,'avatar') . '</span>';

    $author_email = '<a href="mailto:' . esc_html(get_the_author_meta('user_email')) . '">'. esc_html(get_the_author()) . '</a>';

    $comments = '';
    $comments_icon = '';
    // need to strip these
    $com0 = aspen_pro_get_info_arg('comments0',$out);
	$out = aspen_pro_replace_info_text('comments0',$out,false);     // strip it out now
	if (!$com0) $com0 = apply_filters('aspen_pro_comment_reply', __( 'Leave a reply','weaver-ii'));

	$com1 = aspen_pro_get_info_arg('comments1',$out);
	$out = aspen_pro_replace_info_text('comments1',$out,false);     // strip it out now
	if (!$com1) $com1 = apply_filters('aspen_pro_comment_reply', __( '<b>1</b> Reply','weaver-ii'));

	$com2 = aspen_pro_get_info_arg('comments2',$out);
	$out = aspen_pro_replace_info_text('comments2',$out,false);     // strip it out now
	if (!$com2) $com2 = apply_filters('aspen_pro_comment_reply', __( '<b>%</b> Replies','weaver-ii')) ;
    if ( comments_open() ) {    // fix with custom wording...

	// -------------------------------------------------------

	global $wpcommentspopupfile, $wpcommentsjavascript;
	$clink = '';
	$id = get_the_ID();
	$number = get_comments_number( $id );

	if ( post_password_required() ) {
	    $clink .=  __('Enter your password to view comments.','weaver-ii');
	} else {
	    $clink .= '<a href="';
	    if ( $wpcommentsjavascript ) {
            if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
            else
            $home = get_option('siteurl');
            $clink .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id .
            '" onclick="wpopen(this.href); return false"';
	    } else { // if comments_popup_script() is not in the template, display simple comment link
            if ( 0 == $number )
                $clink .= get_permalink() . '#respond';
            else
                $clink .= get_comments_link();
            $clink .= '"';
	    }

	    $title = the_title_attribute( array('echo' => 0 ) );

	    $clink .= ' title="' . esc_attr( sprintf( __('Comment on %s','weaver-ii'), $title ) ) . '">';
	    if ( $number > 1 ) {
            $ltext = $com2;
	    }
	    elseif ( $number == 0 ) {
            $ltext = $com0;
	    } else  {   // must be one
            $ltext = $com1;
	    }
	    $ltext = str_replace('#','%',$ltext);
	 $clink .= str_replace('%', number_format_i18n($number), $ltext) . '</a>';
	}

	// ========================================================

	$comments .= '<span class="comments-link-text">' . $clink . '</span>';

	$comments_icon = str_replace('comments-link-text','comments-link-icon',$comments);
	$out = aspen_pro_replace_info_text('comments',$out,true);       // add conditional text for tags
    } // End if comments_open()

    $out = aspen_pro_replace_info_text('comments',$out,false);  // strip comments: if still there

    $title = esc_html(get_the_title());

    $permalink_text = aspen_pro_get_info_arg('permalink',$out); // alt permalink wording
    if (!$permalink_text) $permalink_text = __('permalink','weaver-ii');

    $out = aspen_pro_replace_info_text('permalink',$out,false); // strip it out now

    $permalink = '<span class="permalink"><a href="' . esc_url( get_permalink() ) . '" title="Permalink to ' .
	$title . '" rel="bookmark">' . $permalink_text . '</a></span>';
    $permalink_icon = '<span class="permalink-icon"><a href="' . esc_url( get_permalink() ) . '" title="Permalink to ' .
	$title . '" rel="bookmark">' . $permalink_text . '</a></span>';

    $out = str_replace('%date%',$date,$out);
    $out = str_replace('%date-icon%','<span class="entry-date-icon">&nbsp;</span>',$out);
    if ($author) {
        $out = str_replace('%author%',$author,$out);
        $out = str_replace('%author-icon%','<span class="by-author-icon">&nbsp;</span>',$out);
    } else {
        $out = str_replace('%author%','',$out);
        $out = str_replace('%author-icon%','',$out);
    }
    if ($author_name)
        $out = str_replace('%author-name%',$author_name,$out);
    else
        $out = str_replace('%author-name%','',$out);
    if ($cats) {
        $out = str_replace('%category%',$cats,$out);
        $out = str_replace('%category-icon%','<span class="cat-links-icon">&nbsp;</span>',$out);
    } else {
        $out = str_replace('%category%','',$out);
        $out = str_replace('%category-icon%','',$out);
    }
    if ($tags) {
        $out = str_replace('%tag%',$tags,$out);
        $out = str_replace('%tag-icon%','<span class="tag-links-icon">&nbsp;</span>',$out);
        $out = aspen_pro_replace_info_text('tag',$out,true);    // add conditional text for tags
    } else {
        $out = str_replace('%tag%','',$out);
        $out = str_replace('%tag-icon%','',$out);
        $out = aspen_pro_replace_info_text('tag',$out,false);   // clean if no tags
    }
    $out = str_replace('%avatar%',$avatar,$out);
    $out = str_replace('%author-email%',$author_email,$out);
    $out = str_replace('%permalink%',$permalink,$out);
    $out = str_replace('%permalink-icon%',$permalink_icon,$out);
    $out = str_replace('%comments%',$comments,$out);
    $out = str_replace('%comments-icon%',$comments_icon,$out);
    $out = str_replace('%title%',$title,$out);
    $out = str_replace('%post-format%', get_post_format(),$out);
    $out = str_replace('%day%',esc_attr(get_the_date('j')),$out);
    $out = str_replace('%day0%',esc_attr(get_the_date('d')),$out);
    $out = str_replace('%weekday%',esc_attr(get_the_date('l')),$out);
    $out = str_replace('%month%',esc_attr(get_the_date('F')),$out);
    $out = str_replace('%month0%',esc_attr(get_the_date('m')),$out);
    $out = str_replace('%month3%',esc_attr(get_the_date('M')),$out);
    $out = str_replace('%month-num%',esc_attr(get_the_date('n')),$out);
    $out = str_replace('%year%',esc_attr(get_the_date('Y')),$out);

    return do_shortcode($out);
}
}

if (!function_exists('aspen_pro_replace_info_text')) {
function aspen_pro_replace_info_text($name,$text,$do_replace) {
    // replace with text or delete
    $out = $text;
    $start = strpos($out, '%'. $name .':');
    if ($start === false)
        return $out;            // nothing to do
    $rest = substr($out,$start + strlen($name) + 2 );   // rest of the string
    $endmark = strpos($rest,'%');               // where the % ends
    $string = substr($rest,0,$endmark);         // the string
    $rep = ($do_replace) ? $string : '';
    return str_replace('%'.$name.':'.$string.'%',$rep,$out);
}
}

if (!function_exists('aspen_pro_get_info_arg')) {
function aspen_pro_get_info_arg($name,$text) {
    // get the value
    $out = $text;
    $start = strpos($out, '%'. $name .':');
    if ($start === false) {
        return '';              // nothing to do
    }
    $rest = substr($out,$start + strlen($name) + 2 );   // rest of the string
    $endmark = strpos($rest,'%');               // where the % ends
    $string = substr($rest,0,$endmark);         // the string
    return $string;
}
}

?>
