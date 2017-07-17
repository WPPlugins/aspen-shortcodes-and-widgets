<?php
/*
Aspen SW - admin code

This code is Copyright 2011 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

require_once(dirname( __FILE__ ) . '/atw-admin-lib.php'); // NOW - load the admin stuff
require_once(dirname( __FILE__ ) . '/atw-shortcodes-admin.php'); // NOW - load the admin stuff

function aspen_sw_admin_page() {
    aspen_sw_submits();
?>

<div class="atw-wrap">
    <h2>Aspen Shortcodes and Widgets Plugin (Now including Aspen Pro) - Settings and Help - Version <?php echo ASPEN_SW_VERSION;?> </h2>
    <hr />
<p>This page shows all the shortcodes available with Aspen Shortcodes and Widgets.
Most of the shortcode tabs provide a brief summary of the shortcodes options.
The "Slider" shortcode includes some settings needed to enable some of its features.</p>

<p style="font-weight:bold;">You can get more complete help for any of these shortcodes by clicking the "Shortcode Help" tab.</p>

<div id="tabwrap_plus" style="padding-left:5px;">
    <div id="tab-container-plus" class='yetiisub'>
	<ul id="tab-container-plus-nav" class='yetiisub'>

    <li><a href="#mtabbx"  style="background:#D4FAC3;" title="Slider"><?php echo(aspen_sw_t_('Slider' /*a*/ )); ?></a></li>


    <li><a href="#sctabsp" style="background:#D4FAC3;" title="Show Posts Shortcode"><?php echo(aspen_sw_t_('Show Posts' /*a*/ )); ?></a></li>
    <li><a href="#ctabtab" style="background:#D4FAC3;" title="Tab Group"><?php echo(aspen_sw_t_('Tab Group' /*a*/ )); ?></a></li>

    <li><a href="#sctabmobile" style="background:#FCDEE4;" title="Show/Hide Mobile Shortcodes"><?php echo(aspen_sw_t_('Show/Hide Mobile' /*a*/ )); ?></a></li>
    <li><a href="#sctabloggedin" style="background:#FCDEE4;" title="Show/Hide Logged In Shortcodes"><?php echo(aspen_sw_t_('Show/Hide Logged In' /*a*/ )); ?></a></li>


    <li><a href="#sctabhdr" style="background:#FFCC33;" title="Header Image Shortcode"><?php echo(aspen_sw_t_('Header Img' /*a*/ )); ?></a></li>
    <li><a href="#sctabhtml" style="background:#FFCC33;" title="HTML Shortcode"><?php echo(aspen_sw_t_('HTML' /*a*/ )); ?></a></li>
    <li><a href="#sctabdiv" style="background:#FFCC33;" title="DIV Shortcode"><?php echo(aspen_sw_t_('div,span' /*a*/ )); ?></a></li>
    <li><a href="#sctabiframe" style="background:#FFCC33;" title="iframe Shortcode"><?php echo(aspen_sw_t_('iframe' /*a*/ )); ?></a></li>



    <li><a href="#sctabstitle" style="background:#FFCC33;" title="Site Title/Desc Shortcodes"><?php echo(aspen_sw_t_('Site Title/Desc' /*a*/ )); ?></a></li>
    <li><a href="#sctabvodep" style="background:#FFCC33;" title="Video Shortcodes"><?php echo(aspen_sw_t_('Video' /*a*/ )); ?></a></li>

    <li><a href="#sctabextramenu" style="background:#CCBB33;" title="Extra Menu Shortcodes"><?php echo(aspen_sw_t_('Extra Menus' /*a*/ )); ?></a></li>
    <li><a href="#sctabhorizwidget" style="background:#CCBB33;" title="Horizontal Widget Area"><?php echo(aspen_sw_t_('Horizontal Widget Area' /*a*/ )); ?></a></li>


    <li style="clear:both;margin-top:3px;margin-left:60px;"><a href="#mt-opts"  style="background:#DDDDFF;" title="Options"><?php echo(aspen_sw_t_('OPTIONS' /*a*/ )); ?></a></li>

    <li style="margin-top:3px;"><a href="#xtab5" style="background:#FFFF00;"><?php echo(aspen_sw_t_('Shortcode Help' /*a*/ )); ?></a></li>

	</ul>
        <hr />

<?php   /* IMPORTANT - in spite of the id's, these MUST be in the correct order - the same as the above list... */
?>

        <!-- ******* -->

        <div id="mtabbx" class="tab_plus" > <!-- Slider -->
<?php
            if (function_exists('aspen_sw_has_bxslider')) {
                require_once('atw-bxslider-admin.php');
                aspen_sw_bxslider_admin();
            }
            else if (function_exists('aspen_has_bxslider')) {
                echo '<b>Support for [aspen_slider] available from the Aspen Slider plugin.</b>';
            }
?>
	</div>

        <!-- ******* -->

        <div id="sctabbread" class="tab_plus" > <!-- Show Posts -->
<?php
        if (function_exists('aspen_sw_show_posts_admin')) {
            aspen_sw_show_posts_admin();
	}
 ?>
        </div>

        <div id="ctabtab" class="tab_plus" > <!-- Tab Group -->
<?php
            if (function_exists('aspen_sw_tabgroup_admin')) {
                aspen_sw_tabgroup_admin();
            }
?>
	</div>

        <!-- ******* -->

        <div id="sctabmobile" class="tab_plus" > <!-- Show/Hide Mobile -->
<?php
        if (function_exists('aspen_sw_showhide_mobile_admin')) {
            aspen_sw_showhide_mobile_admin();
	}
 ?>
        </div>

	<div id="sctabloggedin" class="tab_plus" > <!-- Show/Hide Logged In -->
<?php
        if (function_exists('aspen_sw_showhide_logged_in_admin')) {
            aspen_sw_showhide_logged_in_admin();
	}
 ?>
        </div>

        <!-- ******* -->

	<div id="sctabhdr" class="tab_plus" > <!-- Header Image -->
<?php
        if (function_exists('aspen_sw_headerimg_admin')) {
            aspen_sw_headerimg_admin();
	}
 ?>
        </div>


	<div id="sctabhtml" class="tab_plus" > <!-- HTML -->
<?php
        if (function_exists('aspen_sw_sc_html_admin')) {
            aspen_sw_sc_html_admin();
	}
 ?>
        </div>

	<div id="sctabdiv" class="tab_plus" > <!-- DIV -->
<?php
        if (function_exists('aspen_sw_sc_div_admin')) {
            aspen_sw_sc_div_admin();
	}
 ?>
        </div>

	<div id="sctabiframe" class="tab_plus" > <!-- iframe -->
<?php
        if (function_exists('aspen_sw_sc_iframe_admin')) {
            aspen_sw_sc_iframe_admin();
	}
 ?>
        </div>


	<div id="sctabstitle" class="tab_plus" > <!-- Site Title/Description -->
<?php
        if (function_exists('aspen_sw_sitetitle_admin')) {
            aspen_sw_sitetitle_admin();
	}
 ?>
        </div>


	<div id="sctabvodep" class="tab_plus" > <!-- Video -->
<?php
        if (function_exists('aspen_sw_video_admin')) {
            aspen_sw_video_admin();
	}
 ?>
        </div>


    <div id="sctabextramenu" class="tab_plus" > <!-- Extra Menus -->
<?php
        if (function_exists('aspen_sw_extra_menu_admin')) {
            aspen_sw_extra_menu_admin();
	}
 ?>
        </div>


    <div id="sctabhorizwidget" class="tab_plus" > <!-- Horizontal Widget Area -->
<?php
        if (function_exists('aspen_sw_horiz_widget_admin')) {
            aspen_sw_horiz_widget_admin();
	}
 ?>
        </div>

        <!-- ******* -->

        <div id="mt-opts" class="tab_plus" > <!-- OPTIONS -->
<?php
            aspen_sw_sc_options();
?>
	</div>

        <div id="xtab5" class="tab_plus" >      <!-- Help -->
            <span style="color:blue;font-weight:bold; font-size: larger;"><b>Aspen Short Codes Help</b></span>&nbsp;
<?php aspen_sw_help_link('help.html','Help for Aspen Shortcodes'); ?>
<br />
<h3 style="color:green;text-decoration:underline;">Shortcode Summary</h3>
<ul>
    <li><b>Slider - [aspen_slider]</b> - Display a slider with images, videos, or any HTML</li>
    <li><b>Tab Group - [aspen_tab_group]</b> - Display content on separate tabs</li>
    <li><b>Show Posts - [aspen_show_posts]</b> - Show posts, with many selection options</li>
    <li><b>Show If Mobile - [aspen_show_if_mobile]</b> - Show content on Mobile devices</li>
    <li><b>Hide If Mobile - [aspen_hide_if_mobile]</b> - Hide content on Mobile devices</li>
    <li><b>Show If Logged In - [aspen_show_if_logged_in]</b> - Show content only if logged in</li>
    <li><b>Hide If Logged In - [aspen_hide_if_logged_in]</b> - Hide content if logged in</li>
    <li><b>Header Image - [aspen_header_image]</b> - Display default header image</li>
    <li><b>HTML - [aspen_html]</b> - Wrap content in any HTML tag</li>
    <li><b>DIV - [div]text[/div]</b> - Wrap content in a &lt;div&gt; tag</li>
    <li><b>SPAN - [span]text[/span]</b> - Wrap content in a &lt;span&gt; tag</li>
    <li><b>iFrame - [aspen_iframe]</b> - Display external content in an iframe</li>
    <li><b>Site Title - [aspen_site_title]</b> - Display the site title</li>
    <li><b>Site Tagline - [aspen_site_desc]</b> - Display the site tagline</li>
    <li><b>User Can - [aspen_user_can role="role" alttext="text if can't'"] if has role[/aspen_user_can]</b> - Display content if user has given role</li>
    <li><b>Blog Info - [aspen_bloginfo]</b> - Display blog info as provided by WordPress bloginfo function</li>
    <li><b>Vimeo - [aspen_vimeo]</b> - Display video from Vimeo responsively, with options</li>
    <li><b>YouTube - [aspen_youtube]</b> - Display video from YouTube responsively, with options</li>
</ul>
<h3 style="color:green;text-decoration:underline;">Widget Summary</h3>
<ul>
    <li><b>Aspen Login Widget</b> - Simplified login widget</li>
    <li><b>Aspen Per Page Text</b> - Display text on a per page basis, based on a Custom Field value</li>
    <li><b>Aspen Text 2</b> - Display text in two columns - great for wide top/bottom widgets</li>
</ul>

    </div>
</div> <!-- #tabwrap_plus -->
<hr />
</div>

<script type="text/javascript">
	var tabber2 = new Yetii({
	id: 'tab-container-plus',
	tabclass: 'tab_plus',
	persist: true
	});
</script>


<?php
} // end aspen_sw_admin

// ========================================= FORM DISPLAY ===============================


function aspen_sw_t_($s) {
    return $s;
}


function aspen_sw_submits() {
    // process settings for plugin parts

    if (!aspen_sw_submitted('aspen_sw_save_options')) {		// did they submit anything?
	return;
    }

    $actions = array('aspen_sw_save_global_opts','aspen_sw_save_slider_opts','aspen_sw_save_video_opts'
        );

    if (isset($_POST['aspen_sw_save_slider_opts'])) {
        if (function_exists('aspen_sw_has_bxslider')) {
                require_once('atw-bxslider-admin.php');
            }
        else
            return;
    }

    foreach ($actions as $functionName) {
	if (isset($_POST[$functionName])) {
            if (function_exists($functionName)) {
		$functionName();
	    }
        }
    }
}

// ======================== options handlers ==========================

function aspen_sw_sc_options() {
?>
    <h3 style="color:blue;">Options for all Aspen Shortcodes</h3>
    <form name="aspen_sw_options_form" method="post">
        <p>
<?php
    aspen_sw_form_checkbox('generic_shortcodes',
        '<b>Generic Shortcode Names</b> - Enable "generic" shortcode names - e.g., [slider] instead of [aspen_slider]. Note that the generic names are more likely to conflict with other plugins.');
?>
        </p>
        <input type="hidden" name="aspen_sw_save_global_opts" value="Global Options Saved" />

        <input class="button-primary" type="submit" name="aspen_sw_save_options" value="Save Options"/>
<?php
        aspen_sw_nonce_field('aspen_sw_save_options');
?>
    </form>

<?php
}

function aspen_sw_save_global_opts() {
    // global options
    $checkboxes = array('generic_shortcodes');

    foreach ($checkboxes as $opt) {
        if (isset($_POST[$opt])) aspen_sw_setopt($opt, true);
        else aspen_sw_setopt($opt, false, false);
    }
    aspen_sw_save_all_options();    // and save them to db
    aspen_sw_save_msg('Global Options saved');
}

?>
