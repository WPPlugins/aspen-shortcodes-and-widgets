<?php
// Aspen Theme Works Slider

define ('ATW_SLIDER_VERSION','0.1');

function atw_slider_header($video = false) {
     // bxSlider

     $at_end = true;

    if (aspen_sw_getopt('slider_easing'))
        wp_enqueue_script('atw-bxSlider-easing',
            aspen_sw_plugins_url('/includes/bxslider/plugins/jquery.easing.1.3', ASPEN_SW_MINIFY . '.js'),array('jquery'),
            ATW_SLIDER_VERSION, $at_end);

    if (aspen_sw_getopt('slider_fitvids') && !aspen_sw_getopt('video_fitvids'))
        wp_enqueue_script('atw-bxSlider-fit-vids',
            aspen_sw_plugins_url('/includes/bxslider/plugins/jquery.fitvids', ASPEN_SW_MINIFY . '.js'),array('jquery'),
            ASPEN_SW_VERSION, $at_end);

    wp_enqueue_script('atw-bxSlider',
        aspen_sw_plugins_url('/includes/bxslider/jquery.bxslider', ASPEN_SW_MINIFY . '.js'),array('jquery'),
        ATW_SLIDER_VERSION, $at_end);

    wp_register_style('atw-bxslider-sheet',
        aspen_sw_plugins_url('/includes/bxslider/jquery.bxslider', ASPEN_SW_MINIFY. '.css'),null,ATW_SLIDER_VERSION,'all');

    wp_enqueue_style('atw-bxslider-sheet');
}

function atw_slider_footer() {

    if ( isset($GLOBALS['atw_slider_num']) )   // we had some sliders...
        return;

    if (aspen_sw_getopt('slider_fitvids') && !aspen_sw_getopt('video_fitvids'))
        wp_dequeue_script('atw-bxSlider-fit-vids');
    wp_dequeue_script('atw-bxSlider-easing');
    wp_dequeue_script('atw-bxSlider');          // don't need to queue this script now.
}

function atw_slider_gen_script($opts, $id) {
    $options = array(
// GENERAL
        'mode' => '~!',         // horizontal, vertical, or fade (default: horizontal)
        'speed' => '~!',        // slide transition duration (ms) (default: 500)
        'slideMargin' => '~!',  // Margin between each slide   (default: 0)
        'startSlide' => '~!',   // Starting slide index (zero-based, default: 0)

        'randomStart' => '~!',  // Start slider on a random slide (true/false) (default: false)
        'infiniteLoop' => '~!', // If true, clicking "Next" while on the last slide will transition to the first
                                //   slide and vice-versa (default: true)
        'hideControlOnEnd' => '~!', // If true, "Next" control will be hidden on last slide and vice-versa
                                    // Note: Only used when infiniteLoop: false
        'easing' => '~!',       // The type of "easing" to use during transitions.
                                // Options: 'linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)'
        'captions' => '~!',     // Include image captions. Captions are derived from the image's title attribute
                                //   (true/false) (default: false)
        'ticker' => '~!',       // Use slider in ticker mode (similar to a news ticker) (true/false) (default: false)
        'tickerHover' => '~!',
        'adaptiveHeight' => '~!', // Dynamically adjust slider height based on each slide's height (true/false) (default: false)
        'adaptiveHeightSpeed' => '~!',
        'video' => '~!',        // If any slides contain video, set this to true.  (true/false) (default: false)
                                // See http://fitvidsjs.com/ for more info
        'useCSS' => '~!',       // use CSS, false. use animate()
        'preloadImages' => '~!', // If 'all', preloads all images before starting the slider. If 'visible',
                                //   preloads only images in the initially visible slides before starting the
                                //   slider (tip: use 'visible' if all slides are identical dimensions) (default: visible)

// PAGER

        'pager' => '~!',        // If true, a pager will be added  (true/false)
        'pagerCustom' => '~!',  // ID of associated pager - include leading #, MUST be in both slider and pager
        'pagerType' => '~!',    // If 'full', a pager link will be generated for each slide.
                                //   If 'short', a x / y pager will be used (ex. 1 / 5) (default: full)
        'pagerShortSeparator' => '~!',  // If pagerType: 'short', pager will use this value as the separating character (default: ' / ')

// CONTROLS

        'controls' => '~!',     // If true, "Next" / "Prev" controls will be added  (true/false) (default: true)
        'nextSelector' => '~!',  // next selector id
        'prevSelector' => '~!',  // prev selector id
        'nextText' => '~!',     // Text to be used for the "Next" control (default: 'Next')
        'prevText' => '~!',     // Text to be used for the "Prev" control (default: 'Prev')
        'autoControls' => '~!', // If true, "Start" / "Stop" controls will be added  (true/false) (default: false)
        'startText' => '~!',    // Text to be used for the "Start" control (default: 'Start')
        'stopText' => '~!',     // Text to be used for the "Stop" control (default: 'Stop')
        'autoControlsCombine' => '~!', // When slideshow is playing only "Stop" control is displayed and
                                //         vice-versa  (true/false) (default: false)

// AUTO

        'auto' => '~!',         // Slides will automatically transition  (true/false) (default: false)
        'pause' => '~!',        // The amount of time (in ms) between each auto transition (default: 4000)
        'autoStart' => '~!',    // Auto show starts playing on load. If false, slideshow will start when the "Start" control is clicked  (true/false) (default: true)
        'autoDirection' => '~!', // The direction of auto show slide transitions ('next' or 'prev') (default : 'next')
        'autoHover' => '~!',    // Auto show will pause when mouse hovers over slider (true/false) (default: false)
        'autoDelay' => '~!',    // Time (in ms) auto show should wait before starting (default: 0)

// CAROUSEL

        'minSlides' => '~!',    // The minimum number of slides to be shown. Slides will be sized down if carousel
                                //   becomes smaller than the original size. (default: 1)
        'maxSlides' => '~!',    // The maximum number of slides to be shown. Slides will be sized up if carousel
                                //   becomes larger than the original size. (default: 1)
        'moveSlides' => '~!',   // The number of slides to move on transition. This value must be >= minSlides,
                                //   and <= maxSlides. If zero (default), the number of fully-visible slides will be used. (default: 0)
        'slideWidth' => '~!'    // The width of each slide. This setting is required for all horizontal carousels!
                                //  (default: 0, recommended: 940)

);

    $code = "<script type=\"text/javascript\">jQuery(document).ready(function($){\n";

    $code .= '$(' . "'#" . $id . "').bxSlider({\n";

    foreach ($options as $name => $def) {       // only echo options that are valid for bxSlider
        $index = strtolower($name); // shortcode opts force lower case....
            if (isset($opts[$index])) {
            $val = $opts[$index];
            if ($val != 'false' && $val != 'true' && !is_numeric($val)) {
                $val = "'" . $val . "'";
            }
            $code .= $name . ':' . $val . ', ';
        }
    }

    $code .= "});\n});</script>\n";   // end of call for this slider

    return $code;
}

function atw_sc_slider($args = '', $content) {
    extract(shortcode_atts(array(
        'id' => '~!',       // id for this slider set - default: generated bxslider-n, where n is generated per slider on a page/post
        'noborder' => '', // no borders...
        'style' => '',
        'css' => '~!'       // alternate CSS
    ), $args));

    if ($id == '~!') {
        $id = 'atw_slider_' . rand();
    }

    $code = '';

    if ($css != '~!')
        $code .= atw_slider_gen_css($css, $id);

    $retval = trim($content);

    $leadbr = strpos($retval, '<br />');
    if ($leadbr !== false && $leadbr == 0) {
        $retval = substr($retval, 6);
    }
    $retval = str_replace('slide]<br />','slide]',$retval);     // strip all the <br />s added by autop
    $retval = str_replace('slider_index]<br />','slider_index]',$retval);


    $code .= atw_slider_gen_script($args,$id);

    $after = '';
    $before = '';

    if ($noborder) {
        $before .= '<span class="atw-slider-noborder">';
        $after .= '</span>';
    }

    if ($style != '') {
        $before = '<div style="' . $style . '">' . $before;
        $after = $after . '</div>';
    }

    if (!isset($GLOBALS['atw_slider_num']))
        $GLOBALS['atw_slider_num'] = 1;
    else
        $GLOBALS['atw_slider_num']++;

    $code .= "$before<ul id=\"$id\" class=\"atw-slider atw-cf\">\n" . do_shortcode($retval)  . "</ul>$after <!-- slider -->\n";
    return $code;
}

function atw_sc_slide($args = '', $content) {
    $class = '';
    $slide = trim($content);
    if (strpos($slide,'<img') !== false) {      // treat plain images differently than other content
        $class = ' class="atw-slide-img"';
    }

    return "<li" . $class . '>' . do_shortcode($slide) . "</li> <!-- slide -->\n";
}

function atw_slider_gen_css($css, $id) {
    // inline css
    $style = "\n<style type=\"text/css\" media=\"all\">\n";
    $style .= $css;
    $style .= "\n</style>\n <!-- $id -->\n";
    return $style;
}

function atw_sc_slider_pager($args = '', $content) {
    extract(shortcode_atts(array(
        'id' => '~!',
        'pagercustom' => '~!'   // id for this slider set - default: generated bxslider-n, where n is generated per slider on a page/post
    ), $args));

    if ($id == '~!' || $pagercustom == '~!') {
        return '<strong>WARNING! You must define corresponding "id" (slider id) and "pagerCustom" (pager id) values.</strong>';
    }

    $code = '';

    if ($pagercustom[0] != '#')
        $code = '<br /><b>WARNING! pagerCustom must start with \'#\' (id).</b><br />';
    else
        $pagercustom = substr($pagercustom,1);


    $GLOBALS['atw_slider_index_num'] = '0';
    $retval = trim($content);

    $leadbr = strpos($retval, '<br />');
    if ($leadbr !== false && $leadbr == 0) {
        $retval = substr($retval, 6);
    }
    $retval = str_replace('slider_index]<br />','slider_index]',$retval);

    $code .= "<div id=\"$pagercustom\" class=\"atw-slider-pager atw-cf\">\n" . do_shortcode($retval) . "</div> <!-- pager -->\n";

    unset($GLOBALS['atw_slider_index_num']);
    return $code;
}

function atw_sc_pager_index($args = '',$content) {

    $retval = trim($content);
    $num = $GLOBALS['atw_slider_index_num']++;

    return '<a data-slide-index="' . $num . '" href="">' . do_shortcode($retval) . "</a>\n";
}

function atw_sc_slider_options($args = '') {

    if (!is_array($args))
        return '<strong>WARNING! You must provide options for <em>slider_options<em>.</strong>';
    extract(shortcode_atts(array(
        'css' => '~!'       // alternate CSS
    ), $args));

    if (!isset($args['id']) || $args['id'] == '~!')
        return '<strong>WARNING! You must provide id of corresponding <em>slider</em> shortcode or &lt;ul&gt; to <em>slider_options<em> shortcode.</strong>';

    $id = $args['id'];
    $code = '';
    if ($css != '~!')
        $code .= atw_slider_gen_css($css, $id);

    if (!isset($GLOBALS['atw_slider_num']))
        $GLOBALS['atw_slider_num'] = 1;
    else
        $GLOBALS['atw_slider_num']++;

    $code .= atw_slider_gen_script($args,$id);

    return $code . "\n<!-- Aspen Slider Options ($id) -->\n";
}
?>
