<?php
//
// Aspen Pro Admin Actions and Fiters
//

add_action('aspen_pro_admin','aspen_pro_admin_actions');

function aspen_pro_admin_actions( $action ) {

	switch ($action) {
		// do_action('aspen_pro_admin','head_section');    // (admin-advancedopts.php) Advanced Opts: Advanced Opt: <HEAD> section, at bottom
		// do_action('aspen_pro_admin','html_insertion');  // (admin-advancedopts.php) HTML Insertion - at bottom
		// do_action('aspen_pro_admin','site_opts');       // (admin-advancedopts.php) Site Opts - at bottom
		// do_action('aspen_pro_admin','mobile_opts');     // (admin-advancedopts.php) - Mobile tab, at bottom
		// do_action('aspen_pro_admin','help');            // (admin-help.php) - Help tab, above Aspen Help list
		// do_action('aspen_pro_admin','general_appearance');  // (admin-mainopts.php) - General Appearance tab, at bottom
		// do_action('aspen_pro_admin','header_opts');     // (admin-mainopts.php) - at bottom of Main Options:Header
		// do_action('aspen_pro_admin','menu_bar');        // (admin-mainopts.php) - Menu tab, at bottom
		// do_action('aspen_pro_admin','links');           // (admin-mainopts.php) - Links tab, at bottom
		// do_action('aspen_pro_admin','content_areas');   // (admin-mainopts.php) - Content areas, at bottom
		// do_action('aspen_pro_admin','post_specifics');  // (admin-mainopts.php) - Post Specifics tab, at bottom
		// do_action('aspen_pro_admin','footer_opts');     // (admin-mainopts.php) - Footer tab, above Site Copyright
		// do_action('aspen_pro_admin','widget_areas');    // (admin-mainopts.php) - widget areas tab, at bottom
		// do_action('aspen_pro_admin','layout');          // (admin-mainopts.php) - Layout tab, at bottom
		// do_action('aspen_pro_admin','aspen_pro_admin'); // (admin-pro.php) - only called if pro installed, at bottom of Aspen Pro page
		// do_action('aspen_pro_admin','save_restore');    // (admin-saverestore.php) - Save/Restore tab, near bottom, above Reset to default
		// do_action('aspen_pro_admin','show_subthemes');  // (admin-subthemes.php) - on Aspen Subthemes tab before visit our website
		// do_action('aspen_pro_admin','process_options'); // (admin-top.php) - to handle processing of options
		// do_action('aspen_pro_admin','admin_options');   // (admin-top.php) - Admin Opts, at bottom


		case 'aspen_pro_admin':
			aspen_pro_admin();
			break;

		case 'footer_opts':
			aspen_pro_footeropts();
			break;

		case 'fonts':
			aspen_pro_fonts_pro_admin();
			break;

		case 'general_appearance':
			aspen_pro_general_apperarance();
			break;

		case 'header_opts':
			aspen_pro_mainopts_header();
			break;

		case 'head_section':
			aspen_pro_actions_filters();       // Add aribitrary PHP to the
			break;

		case 'post_specifics':
			aspen_pro_post_specifics();
			break;

		case 'process_options':
			aspen_pro_process_options();
			break;


		// cases with no Pro extensions

		case 'admin_options':
		case 'content_areas':
		case 'help':
		case 'html_insertion':      // use filter aspen_pro_html_inject_filter
		case 'layout':
		case 'links':
		case 'menu_bar':
		case 'mobile_opts':
		//case 'process_options':     // process submitted options
		case 'save_restore':
		case 'show_subthemes':
		case 'site_opts':
		case 'widget_areas':
			break;

		default:
			// echo '<h3 style="background-color:#afa;border:2px solid green;"><strong>Aspen Pro Extra Admin: ' . $action . '</strong></h3>';
			break;
	}
}

// =========================== filters ============================

add_filter('aspen_pro_html_inject', 'aspen_pro_html_inject_filter');

function aspen_pro_html_inject_filter($areas) {
	$new_areas = array (
		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array('name' => 'Additional Insertion Areas' . aspen_pro_pro_stamp(2), 'id' => 'pro_insert', 'info' => '', 'help' => ''),

		array ('name'=>'<span style="color:#070;">Mobile: Header Insert Code</span>', 'id'=>'+mobile_header', 'info' =>
			'This HTML code will be inserted into the #branding div header area right above where the standard site header image goes, but displayed only on mobile devices (small tablets and smaller screens.)',
			'help' => ''),

		array ('name'=>'<span style="color:#070;">Desktop: Header Insert Code</span>', 'id'=>'+desktop_header', 'info' =>
			'This HTML code will be inserted into the #branding div header area right above where the standard site header image goes, but displayed only on desktop devices (large tablets and desktop browsers)',
			'help' => ''),

		array ('name'=>'Pre-Main Code', 'id'=>'+premain', 'info' =>
			'This code will be inserted after the #branding div and before the #main div.',
			'help' => ''),

		array ('name'=>'Pre-Container Code', 'id'=>'+precontent', 'info' =>
			'This code will be inserted inside the #container div that wraps content, including before the top widget areas. It will have the same width as the container area.',
			'help' => ''),

		array ('name'=>'Post-Post Content Code', 'id'=>'+postpostcontent', 'info' =>
			'This code will be inserted after the content area of each post.',
			'help' => ''),

		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array ('name'=>'Pre-Comments Code', 'id'=>'+precomments', 'info' =>
			'This code will be inserted just before the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.precomments-comments</em>, if closed <em>.precomments-nocomments</em>.',
			'help' => ''),

		array ('name'=>'Post-Comments Code', 'id'=>'+postcomments', 'info' =>
			'This code will be inserted right after the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.postcomments-comments</em>, if closed <em>.postcomments-nocomments</em>.',
			'help' => ''),
		array ('name'=>'Pre-Footer Code', 'id'=>'+prefooter', 'info' =>
			'This code will be inserted just before the footer #colophon div.',
			'help' => ''),

		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array ('name'=>'Pre-Left Sidebar', 'id'=>'+presidebar_left',
'info' => 'This code will be inserted just before the left sidebar area.',
			'help' => ''),
		array ('name'=>'Pre-Right Sidebar', 'id'=>'+presidebar_right', 'info' =>
			'This code will be inserted just before the right sidebar area.',
			'help' => '')

	);
	return array_merge($areas,$new_areas);
}

//============================================================= THE CODE ========================================================
//
// -- Actions and Filters
//
function aspen_pro_actions_filters() {
?>
	<br />
<br />

	<div class="atw-option-header">Actions and Filters  <?php echo aspen_pro_pro_stamp(2); ?>
<?php aspen_pro_help_link('help.html#ActionsFilters','Help for Actions and Filters');?></div><br />
	<p><strong>This Option for Advanced Users!</strong> You can add arbitrary PHP code here. This option is intended to allow
	you to add WordPress Actions and Filters to the Visitor View of your site. This PHP code is executed at the very
	beginning of the theme's header.php template file before any HTML is emitted.
	Do NOT bracket the code with &lt;?php and ?&gt; at the beginning and end. See the Help file for more technical details.</p>

	<textarea name="<?php aspen_sapi_main_name('_phpactions'); ?>" rows=2 style="width: 95%"><?php echo stripslashes(wp_check_invalid_utf8(addslashes(aspen_getopt('_phpactions')))); ?></textarea>
<?php
}

// ========================================== MAIN OPTIONS : FOOTER =======================================
function aspen_pro_footeropts() {
	$atw = 'Control width of footer area' . aspen_pro_pro_stamp(2,true);
	$opts = array (
	array('name' => 'Footer Width', 'type' =>'=subheader', 'info' => $atw),
	array('name' => 'Wide Footer Area BG', 'id' => 'footer_last', 'type' => '+checkbox',        //code
			'info' => 'Make Footer Area Background full screen width
			(or width specified below).'),
	array('name' => '<small>Wide Footer Content</small>', 'id' => 'footer_wide_content', 'type' => '+checkbox', //code
			'info' => 'Also make Footer Content (Widget Areas, Footer Insert Code, Copyright/Powered By) use full screen width.
			If not checked, then content will be constrained to Theme Width.'),

	array('name' => '<small>Footer Width</small>', 'id' => 'footer_width_int', 'type' => '+val_px',
			'info' => 'For wide footer area, set the maximum width of the Footer Area. Can be less than theme width. If blank, full screen width used.')
	);
	aspen_form_show_options($opts);
	echo "<br />\n";
}

// ========================================== MAIN OPTIONS : GENERAL APPEARANCE =======================================

function aspen_pro_general_apperarance() {

// ==================   BACKGROUND IMAGES ====================
?>
		<div class="atw-row-header" style="font-weight:bold;font-size:larger;width:90%;" >Background Images
		<?php aspen_pro_help_link('help.html#BackgroundImages','Help on Background Images'); echo aspen_pro_pro_stamp(2); ?></div>
		<br />

		<table class="optiontable">
<?php

		aspen_bgimg_widerow('Full Screen Site BG Image','_bg_fullsite_url','Full screen centered auto-sized BG image.','250px');

		aspen_bgimg_widerow('Wrapper BG Image','_bg_wrapper_url','Background image for outer wrapper (#wrapper)');

		aspen_repeat_row('_bg_wrapper_rpt');

		aspen_bgimg_widerow('Header BG Image','_bg_header_url','Background image for header (#branding)');
		aspen_repeat_row('_bg_header_rpt');

		aspen_bgimg_widerow('Main BG Image','_bg_main_url','Background image for main area - wraps everything after header (#main)');
		aspen_repeat_row('_bg_main_rpt');

		aspen_bgimg_widerow('Container BG Image','_bg_container_url','Background image for Container - (#container_wrap)');
		aspen_repeat_row('_bg_container_rpt');

		aspen_bgimg_widerow('Content BG Image','_bg_content_url','Background image for Content - wraps page/post area (#content)');
		aspen_repeat_row('_bg_content_rpt');

		aspen_bgimg_widerow('Page content BG Image','_bg_page_url','Background image for Page content area (#container .page)');
		aspen_repeat_row('_bg_page_rpt');

		aspen_bgimg_widerow('Post BG Image','_bg_post_url','Background image for Post content area (#container .post)');
		aspen_repeat_row('_bg_post_rpt');

		aspen_bgimg_widerow('Left Sidebar Areas BG Image','_bg_widgets_left_url','Background image for widget areas on left (#sidber_wrap_left)');
		aspen_repeat_row('_bg_widgets_left_rpt');

		aspen_bgimg_widerow('Right Sidebar Areas BG Image','_bg_widgets_right_url','Background image for widget areas on right (#sidber_wrap_right)');
		aspen_repeat_row('_bg_widgets_right_rpt');

		aspen_bgimg_widerow('Footer BG Image','_bg_footer_url','Background image for Footer area (#colophon)');
		aspen_repeat_row('_bg_footer_rpt');

	echo "</table>\n";
}

// ========================================== UI code for bg images ==========================================
function aspen_bgimg_widerow($th,$rid,$desc,$width='') {
	$style = '';
	$style_desc = 'style="padding-left: 10px"';
	if ($width != '') {
		$style = ' style="width:' . $width . ';"';
	}
?>
	<tr>
		<th scope="row" align="right"<?php echo $style . '>' . $th; ?>:&nbsp;</th>
		<td>
			<input name="<?php aspen_sapi_main_name($rid); ?>" type="text" style="width:240px;height:22px;" class="regular-text"
				id="<?php echo $rid; ?>" value="<?php echo (esc_textarea(aspen_getopt($rid))); ?>" />
<?php           aspen_media_lib_button($rid); ?>
		</td>
		<td <?php echo $style_desc;?>><small><?php echo $desc; ?></small></td>
	</tr>
<?php

}

function aspen_repeat_row($rid) {
?>
	<tr>
		<th scope="row" align="right">&nbsp;</th>
		<td colspan="2" style="font-size:80%;">
			<input type="radio" name="<?php aspen_sapi_main_name($rid); ?>"
				value="repeat" <?php echo(aspen_getopt($rid) == 'repeat' ? 'checked' : ''); ?> /> repeat &nbsp;
			<input type="radio" name="<?php aspen_sapi_main_name($rid); ?>"
				value="repeat-x" <?php echo(aspen_getopt($rid) == 'repeat-x' ? 'checked' : ''); ?> /> repeat-x &nbsp;
			<input type="radio" name="<?php aspen_sapi_main_name($rid); ?>"
				value="repeat-y" <?php echo(aspen_getopt($rid) == 'repeat-y' ? 'checked' : ''); ?> /> repeat-y &nbsp;
			<input type="radio" name="<?php aspen_sapi_main_name($rid); ?>"
				value="no-repeat" <?php echo(aspen_getopt($rid) == 'no-repeat' ? 'checked' : ''); ?> /> no-repeat
		</td>
	</tr>
<?php
}

// ========================================== MAIN OPTIONS : HEADER =======================================
function aspen_pro_mainopts_header() {
	$atw = 'Settings for Header Horizontal Widget Area' . aspen_pro_pro_stamp(2);
	$atw2 = 'Settings for widgets within Header Widget Area (Entire section: &diams;)' . aspen_pro_pro_stamp(2);
	$atw3 = 'Control Width of Header Area' . aspen_pro_pro_stamp(2);
	$opts = array(
	array('name' => 'Header Widget Area ', 'id' => 'a_headerwidgetarea', 'type' =>'subheader',
		  'info' => $atw,
		  'help' => 'help.html#HeaderWidgetArea'),
	array('name' => 'Area BG', 'id' => '_hdr_widg_bgcolor', 'type' => 'ctext',
		'info' => 'Background for the header horizontal widget area. &diams;'),
	array('name' => 'Area Font Size', 'id' => '_hdr_widg_fontsize', 'type' => 'val_percent',
		'info' => 'Header Widget Area font size (default: 100%). &diams;'),
	array('name' => 'Area Height', 'id' => '_hdr_widg_h_int', 'type' => 'val_px',
			'info' => 'Header widget area height. (default:tallest widget) &diams;'),
    array('name' => '<small>Show Only via Shortcode</small>', 'id' => '_hdr_widg_shortcode_only', 'type' => '=checkbox',
			'info' => 'Display the horizontal header widget area using the [aspen_hoizontal_widget_area] shortcode. (After Header Image option ignored.) &diams;'),
	array('name' => '<small>Show on Front Page Only</small>', 'id' => '_hdr_widg_frontpage', 'type' => '=checkbox',
			'info' => 'Display the header widget area on the front page only. (Also see Hide Header Image on Front Page.) &diams;'),
	array('name' => '<small>Display After Header Image</small>', 'id' => '_hdr_widg_afterimg', 'type' => '=checkbox',
			'info' => 'Display the header widget area after (under) the header image. &diams;'),

	array('name' => '<small>Hide Widget Area for Normal View</small>', 'id' => '_hdr_widg_hide_normal', 'type' => '=checkbox',
		  'info' => 'Hide entire header widget area on all pages for normal (desktop) view (will show on narrow desktop and mobile views). &diams;' ),
	array('name' => '#070<small>Hide Widget Area for Mobile View</small>', 'id' => '_hdr_widg_hide_mobile', 'type' => '=checkbox',
		  'info' => 'Hide entire header widget area for mobile devices. &diams;' ),
	array( 'type' => 'submit'),

	array('name' => 'Header Widget Area Widgets', 'type' =>'subheader', 'info' => $atw2),

	array('name' => 'First', 'id' => '_hdr_widg_1', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => '<span style="color:red;">IMPORTANT!</span>', 'id' => 'headern4', 'type' => '=note',
			'info' => 'You must specify a width for each widget you use in this area for proper layout on all browsers.'),

	array('name' => 'Second', 'id' => '_hdr_widg_2', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => 'Third', 'id' => '_hdr_widg_3', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => 'Fourth', 'id' => '_hdr_widg_4', 'type' => 'hdr_widget',
		  'info' => '' ),

	array('name' => 'Header Widget Padding:', 'id' => 'headern2', 'type' => '=note',
			'info' => 'To add padding to a widget, use widget\'s BG "CSS+" and add "{padding:5px 5px 5px 5px;}" - adjust values as needed.'),

	// bg color, font size, min height, max-width; margins?, 1: bg, %, 2:bg, %, 3: bg, %, 4: bg, % bg-image?

	array('name' => 'Header Width', 'id' => 'a_hdr_advanced', 'type' =>'=subheader',
		  'info' => $atw3),
	array('name' => 'Make Header Area BG Wide', 'id' => 'header_first', 'type' => '+checkbox', //code
			'info' => 'Make Header Area Background full screen width
			(or width specified below). <em>This applies to BG color only!</em> See next option below.'),
	array('name' => '<small>Wide Header Content</small>', 'id' => 'header_first_content', 'type' => '+checkbox', //code
			'info' => 'Also make Header Content (Title, tagline, image, Header Insert Code) use full screen width.
			If not checked, then content will be constrained to Theme Width.'),
	array('name' => '<small>Wide Menus</small>', 'id' => 'header_first_menus', 'type' => '+checkbox', //code
			'info' => 'Make menus wide. You can also use <em>Center Menu</em> on <em>Menus</em> tab in conjunction with this option.'),
	array('name' => 'Note:', 'id' => 'headern0', 'type' => 'note',
			'info' => 'See Header Image section above for more options about sizing the header image.'),
	array('name' => '<small>Header Area Width</small>', 'id' => 'header_area_width_int', 'type' => '=val_px',
			'info' => 'For wide header area, set the maximum width of the Header Area. If blank, full screen width used. Most effective if more than Theme Width.'),
	array('name' => '<small>Wide Main Area BG</small>', 'id' => 'wide_main_bg', 'type' => '+checkbox',
			'info' => "Extend Main Area BG to edges. Most useful with Wide Header and Footer Areas."),


);
	aspen_form_show_options($opts);
}

function aspen_pro_post_specifics() {
	$atw = 'Replace Info Lines with custom info line templates. Advanced options: see help file' . aspen_pro_pro_stamp(1);
	$opts = array (
		array( 'type' => 'submit'),
		array('name' => 'Post Meta Custom Info Lines', 'type' => '=subheader_alt',
		  'info' => $atw, 'help' => 'help.html#CustomInfo'),
		array('name' => '<small>Top Post Info Line<small>', 'id' => '_custom_posted_on', 'type' => '+textarea',
		  'info' => 'Custom template for top post info line. See help file! &diams;'),
		array('name' => '<small>Bottom Post Info Line<small>', 'id' => '_custom_posted_in', 'type' => '+textarea',
		  'info' => 'Custom template for bottom post info line. &diams;'),
		array('name' => '<small>Top Post Info Line (Single)<small>', 'id' => '_custom_posted_on_single', 'type' => '+textarea',
		  'info' => 'Custom template for top post info line on single pages. &diams;'),
		array('name' => '<small>Bottom Post Info Line (Single)<small>', 'id' => '_custom_posted_in_single', 'type' => '+textarea',
		  'info' => 'Custom template for bottom post info line on single pages. &diams;')
	);
	aspen_form_show_options($opts);
}

/* =========================== fonts admin code =========================== */

function aspen_pro_fonts_pro_admin() {

	global $aspen_fonts_defs;

	$aspen_std_fonts = array( '','Google Web Font',
		'"Helvetica Neue", Helvetica, sans-serif',
		'Arial,Helvetica,sans-serif',
		'Verdana,Arial,sans-serif',
		'Tahoma, Arial,sans-serif',
		'"Arial Black",Arial,sans-serif',
		'"Avant Garde",Arial,sans-serif',
		'"Comic Sans MS",Arial,sans-serif',
		'Impact,Arial,sans-serif',
		'"Trebuchet MS", Helvetica, sans-serif',
		'"Century Gothic",Arial,sans-serif',
		'"Lucida Grande",Arial,sans-serif',
		'Univers,Arial,sans-serif',
		'"Times New Roman",Times,serif',

		'"Bitstream Charter",Times,serif',
		'Georgia,Times,serif',
		'Palatino,Times,serif',
		'Bookman,Times,serif',
		'Garamond,Times,serif',

		'"Courier New",Courier',
		'"Andale Mono",Courier'
	);
?>
<script language="javascript" type="text/javascript">

  function aspen_copy_google_3_4()
  {
	var cur = jQuery('#fonts_google_font_list').val();
	var g3 = jQuery('#font_google_link').val();
	var g4 = jQuery('#font_google_font_code').val();
	var add = g3 + '<!-- ' + g4 + " -->";
	if (cur && cur.indexOf(add) >= 0) {
		alert("That Google Font Definition already added.");
		return;
	}
	var fix = cur + add + "\n";
	jQuery('#fonts_google_font_list').val(fix);
  }

  function aspen_generate_font_css() {
	var font_font_family = jQuery("#font_font_family").val();
	var font_font_weight = jQuery("#font_font_weight").val();
	var font_font_style = jQuery("#font_font_style").val();
	var font_font_variant = jQuery("#font_font_variant").val();
	var font_font_size = jQuery("#font_font_size").val();
	var font_font_size_value = jQuery("#font_font_size_value").val();
	var font_font_size_units = jQuery("#font_font_size_units").val();
	var g3 = jQuery('#font_google_link').val();
	var g4 = jQuery('#font_google_font_code').val();

	var css = '{';
	if (g4 && g3 && font_font_family == 'Google Web Font' ) {
		css += g4;
	} else if (font_font_family) {
		css += 'font-family:' + font_font_family + ';';
	}

	if (font_font_weight) css += 'font-weight:' + font_font_weight + ';';
	if (font_font_style) css += 'font-style:' + font_font_style + ';';
	if (font_font_variant) css += 'font-variant:' + font_font_variant + ';';

	if (font_font_size_value) css += 'font-size:' + font_font_size_value + font_font_size_units + ';';
	else if (font_font_size) css += 'font-size:' + font_font_size + ';';

	css += '}';
	jQuery('#font_generate_font_code').val(css);
  }
  function aspen_copy_font_css(destinationid)
  {
	var css = jQuery('#font_generate_font_code').val();
	var cur = jQuery("#"+destinationid).val();
	var paste = cur + css;
	jQuery("#"+destinationid).val(paste);
  }
</script>


	<div><a id="fonts_top" name="fonts_top"></a>
	<div class="atw-row-header" style="font-weight:bold;font-size:larger;width:90%;" >Aspen Font Control <?php echo aspen_pro_pro_stamp(2); ?></div>
	<br />
<?php
	/* <p class='atw-option-section'>Aspen Pro - Font Control <?php aspen_help_link('pro-help.html#font_control','Font control help'); ?></p>
	 */

	echo ('&nbsp;|&nbsp;');
	$count = 0;
	foreach ($aspen_fonts_defs as $option => $row) {
		if ($row['id'][0] == '_') {
			echo('<a href="#' . $row['id'] . '">' . $row['label'] . '</a>&nbsp;|&nbsp;');
		} else {
			$count++;
		}
	}

	$tdir = aspen_relative_url('') . 'includes/pro/';
	$readme = $tdir . 'pro-help.html';
?>
<a href="<?php echo $readme; ?>#font_control" target="_blank"><strong>Font Control Help</strong></a>&nbsp;|
<br />
	<p>The Aspen Font Control panel gives you fine tuned control over the fonts various elements of your site will use.
	You can use a set of standard Web fonts, or for total flexibility, you can use <em>any</em> of the free
	<?php aspen_site('/webfonts', 'http://www.google.com','Google Web Fonts'); ?><strong>Google Web Fonts</strong></a>. Once you
	get the hang of using this interface, it is quite easy to specify fonts. However, there is a small learning curve,
	and you really should read the complete instructions in the
	<a href="<?php echo $readme; ?>#font_control" target="_blank">Aspen Features Help document</a>!
	</p>
	<p>For best results, <strong>please</strong> follow <span style="color:red;">Steps 1, 2, 3, and 4</span> for each font you want to use. Read
	the instructions for each step carefully.</p>
	<hr />

		<fieldset class="options">
			<span style="font-weight:bold; color:blue;">Aspen Font Style Generator</span>
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $readme; ?>#font_control" target="_blank"><strong>Font Control Help</strong></a><br />
			<h3><span style="color:red; text-decoration:underline;font-weight:bold;font-size:larger;">Step 1.</span> Specify Font Family and Attributes</h3>
		   <p>You may specify a standard Web font by using the "Specify Standard Font Family" pull-down on the left below,
		   or you may use any Google font by first selecting "Google Web Font" on the left, then filling in 3 and 4 in the
		   Google box on the right. You can use the Font-Weight, Font Style, etc., for either a standard or a Google Font.
		   Then follow Steps 2, 3, and 4 for either standard or Google fonts. You can repeat this process (Steps 1 to 4) to specify
		   different fonts for different elements.</p>

		<div style="float:left;"><span style="font-weight:bold; color:green;">Specify Standard Font Family</span><br />
			&nbsp;&nbsp;
<?php
			aspen_select('font_font_family',$aspen_std_fonts);
?>
			<span style="font-weight:bold;color:red;">&nbsp;-OR-&nbsp;</span><br /><hr />
			<span style="font-weight:bold; color:green;">Font-Weight: </span>
<?php
			aspen_select('font_font_weight',array('', 'normal', 'bold', 'bolder', 'lighter',
			  '100', '200', '300', '400', '500', '600', '700', '800', '900'));
?>
			<br />
			<span style="font-weight:bold; color:green;">Font Style: &nbsp;&nbsp;</span>
<?php
			aspen_select('font_font_style',array('', 'normal', 'italic', 'oblique'));
?>
			<br />
			<span style="font-weight:bold; color:green;">Font Variant: </span>
<?php
			aspen_select('font_font_variant',array('', 'normal', 'small-caps'));
?>
			<br />

			<span style="font-weight:bold; color:green;">Font Size: &nbsp;&nbsp;&nbsp;</span>
<?php
			aspen_select('font_font_size',array('', 'Specify value', 'xx-small', 'x-small', 'small', 'medium',
				'large', 'x-large', 'xx-large', 'smaller', 'larger'));
?>
			<br />
			Font Size value:
			<input type="text" style="width:34px;height:24px;" class="regular-text" name="<?php aspen_sapi_main_name('font_font_size_value'); ?>"
				id="font_font_size_value" value="<?php aspen_esc_textarea(aspen_getopt('font_font_size_value')); ?>" />
<?php
			aspen_select('font_font_size_units',array('em','pc','pt','px','%'));
?>
		</div>
		<div style="float:left;border:1px solid #aaa;padding:4px;">
	&nbsp;<span style="font-weight:bold; color:green;">Specify Google Web Font Family</span>
	<br /><ol>
		<li><strong>&larr;</strong> Select "Google Web Font" from "<strong>Specify Standard Font Family</strong>" pull-down list on the left.</li>
		<li>Go to <?php aspen_site('/webfonts', 'http://www.google.com','Google Web Fonts'); ?><strong>Google Web Fonts</strong></a> site to select a font.
		Open the font's <strong><em>Quick-use</em></strong> page.</li>
		<li>Paste Quick-use <strong>#3 &lt;link&gt;</strong> code here:
		<textarea name="<?php aspen_sapi_main_name('font_google_link'); ?>" id="font_google_link" rows=2 style="width: 300px"><?php
			  aspen_esc_textarea(aspen_getopt('font_google_link')); ?></textarea></li>
		<li>Paste Quick-use <strong>#4 CSS</strong> code here: &nbsp;&nbsp;
		<textarea name="<?php aspen_sapi_main_name('font_google_font_code'); ?>" id="font_google_font_code" rows=1 style="width: 300px"><?php
			  aspen_esc_textarea(aspen_getopt('font_google_font_code')); ?></textarea></li>
		<li>Click the<em>Generate Font CSS Definition</em> button,<br /> then click the<em>Paste current Google #3 and #4 to list of Available Google fonts</em> and <em>Save Settings</em> <br />if you plan to use this Google Web Font on your site.</li>
	</ol>
	</div><div style="clear:both;"></div>
	<br /><div></div>
	<div>
	<h3><span style="color:red; text-decoration:underline;font-weight:bold;font-size:larger;">Step 2.</span> &nbsp;<input id="generate_css" class= "js_button" type="button" value="Click Here to Generate Font CSS Definition" onclick="aspen_generate_font_css()" /> &nbsp;
	<small>&larr; Click this button to generate a CSS definition you can paste into the different font areas below.</small></h3>
	<textarea name="<?php aspen_sapi_main_name('font_generate_font_code');?>" id="font_generate_font_code" readonly rows=1 style="width: 800px;background:#eee;"><?php
			  aspen_esc_textarea(aspen_getopt('font_generate_font_code')); ?></textarea><br/>
	<strong style="color:#a04;">Paste above CSS code into style boxes in the  Aspen Font Options section below.</strong> <small>No need to Copy, just click the Paste CSS button. Getting just "{}"? <strong>Re-read</strong> the Step 1 directions!</small></div>
	<br />
	</fieldset>
		<?php aspen_sapi_submit('','',false); ?>
		The above Font Style Generator settings will be saved when you Save Settings, but they generally are used
		on a one-shot basis.
		<hr />

	<fieldset class="options">
		<span style="font-weight:bold; color:blue;">Aspen Font Options</span><br />
		<h3><span style="color:red; text-decoration:underline;font-weight:bold;font-size:larger;">Step 3.</span> Define font definition load path for Google Fonts you use</h3>
		<p><strong>If</strong> you are using any Google Fonts, you <strong><em>MUST</em></strong> add the definitions you pasted into #3 and #4 above
		to the "Available Google Fonts" box below so that your site will be able to load the Google Fonts. If you are just using
		standard web font families, then you can skip this step.</p>


		<p><input id="copy_google" class= "js_button" type="button" value="Click Here to Paste current Google #3 and #4 to Available Google fonts list" onclick="aspen_copy_google_3_4()" />&nbsp;&nbsp;<strong style="color:red;">Important!</strong> You still must click the "Save Settings" button to save the Google Font definitions in the Available Google Fonts setting!</p>

		<table class="optiontable">
			<tr>
			<th scope="row" align="right"><span style="color:green;">Available Google Fonts:</span><br />
			<small style="font-weight:normal;">List of Google fonts that will be available for use on your site.
			You can also Copy/Paste CSS the "font-family:&nbsp;..." portion of any available font into any of the font sections below if you need to later.</small></th>
			<td ><textarea name="<?php aspen_sapi_main_name('fonts_google_font_list'); ?>" id='fonts_google_font_list' rows=4 style="width: 620px"><?php
			  aspen_esc_textarea(aspen_getopt('fonts_google_font_list')); ?></textarea></td>
			</tr>
		</table>

		<h3><span style="color:red; text-decoration:underline;font-weight:bold;font-size:larger;">Step 4.</span> Paste Font CSS Defintions into Boxes of items you want to specify</h3>
		<p>You can now use the "Paste CSS" buttons next to specific text items to use the currently defined font in the "Step 2"
		Font CSS Definition. You need to change that definition for each different font you use. The same applies to "Step 3" if
		your are using Google Fonts.</p>
		<table class="optiontable">

<?php
		foreach ($aspen_fonts_defs as $option => $val) {
			aspen_fonts_row($val);
		}
?>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<th scope="row" align="right" style="color:green;">Fonts Box Lines:&nbsp;</th>
		<td>
			<input type="text" style="width:30px;height:22px;" class="regular-text" name="<?php aspen_sapi_main_name('fonts_edit_lines'); ?>"
				id="fonts_edit_lines" value="<?php aspen_esc_textarea(aspen_getopt('fonts_edit_lines')); ?>" />
			<small>Number of lines to display in each edit box on this page.</small>
		</td>
	</tr>
		</table>
		</fieldset>
		<br />
	<hr />
	</div>
<?php

}

function aspen_fonts_row($row) {
	// echo a Fonts row
	if ($row['id'][0] == '_') {         // row title  - needs name linked, not sapi id
?>
	<tr><th scope="row" align="left" style="color:blue"><br /><a name="<?php echo $row['id'];?>"></a><?php aspen_esc_textarea($row['label']); ?>&nbsp;&nbsp;</th>
		<td><br /><?php aspen_esc_textarea($row['info']); ?>&nbsp;&nbsp;&nbsp;<a href="#total_fonts_top"><strong>Top</strong></a>
		<td><span style="float:none;"><?php aspen_sapi_submit('','',false); ?></span>
		</td>
	</tr>
<?php
	} else {
		$rows = aspen_getopt('fonts_edit_lines');
		if (!$rows) $rows = 2;
?>
	<tr><th scope="row" align="right" style="width:220px"><?php aspen_esc_textarea($row['label']); ?>:&nbsp;</th>
		<td ><textarea name="<?php aspen_sapi_main_name($row['id']); ?>" id=<?php echo $row['id']; ?> rows=<?php echo $rows; ?> style="width: 300px"><?php
			  aspen_esc_textarea(aspen_getopt($row['id'])); ?></textarea></td><td>
			  <input id="paste_css" class= "js_button" type="button" value="&larr;Paste CSS&nbsp;" onclick="aspen_copy_font_css('<?php echo $row['id']; ?>')" />
			  <small>Click button to paste current Font CSS Definition defined above to this element.</small>
			  <br><small><?php aspen_esc_textarea($row['info']); ?></small></td>
	</tr>
<?php
	}
}

function aspen_select($id, $list) {
?>
	<select name="<?php aspen_sapi_main_name($id); ?>" id="<?php echo $id; ?>">
<?php foreach ($list as $option) { ?>
		<option<?php if ( aspen_getopt( $id ) == $option) { echo ' selected="selected"'; }?>><?php aspen_esc_textarea($option); ?></option>
<?php } ?>
	</select>
<?php
}

// ================================== aspen_pro_admin ==================================
function aspen_pro_admin() {
?>
<h2 style="color:blue;">Formerly Aspen Pro Features now included free with <em>Aspen Shortcodes and Widgets Plugin!</em></h2>
<p>Because so few people have adopted Aspen Pro, we've decided to make it a free option automatically included
with the Aspen Shortcodes and Widgets Plugin.</p>
<p>If you never had Aspen Pro, you should notice that many new options are now available to you. All for free!
If you have been an Aspen Pro user, you should see no changes in how your sites work as long as you have the
new <em>Aspen Shortcodes and Widgets Plugin</em> installed. (Note: for some time, there may be references
here and there to Aspen Pro. Eventually, these should be eliminated, but as long as you have a new version
of <em>Aspen Shortcodes and Widgets</em>, everything will work just like Aspen Pro used to.</p>
<p>Part of the reason for the switch is we've introduced a brand new theme: Weaver Xtreme. If you are just gettign started,
we highly recommend that you try <a href="http://weavertheme.com/weaver-xtreme/" target="_blank"><strong>Weaver Xtreme</strong></a> instead.</p>
<?php
}

function aspen_pro_process_options() {
	// if (aspen_submitted('whatever')) {}
}

/*
	================= general helpers =====================
*/

function aspen_pro_pro_stamp($left = 0) {
	$ap =  '<strong style="margin-left:' . $left . 'em;color:#c00;">(Formerly Aspen Pro Feature Now Free)</strong>';
	return $ap;
}

function aspen_pro_help_link( $ref, $label) {

	if (function_exists('aspen_help_link'))
		aspen_help_link($ref,$label);
	else
		echo '<em>Help not available - activate Aspen Theme<em>';
}

?>
