<?php
/*
Aspen SW Shortcodes Admin - admin code

This code is Copyright 2011 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

function aspen_sw_headerimg_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Header Image - [aspen_header_image]</b></span>&nbsp;
<?php aspen_sw_help_link('help.html#headerimage','Help for Aspen Header Image');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_header_image], [header_image]</code>
<br />
<p>The <code>[aspen_header_image]</code> shortcode allows you display the current header image wherever you want.
For example, you can get the header image into the Header Widget Area by using this shortcode in a text widget.
The current standard or mobile header image will be displayed. Only the <code>&lt;img ... &gt;</code> is displayed --
the image will not be wrapped in a link to the site.</p>

<p><strong>Shortcode usage:</strong> <code>[aspen_header_image h='size' w='size' style='inline-style']</code>

<ol>
    <li><strong>w='size' h='size'</strong> - By default, no height or image properties are included with the
    header <code>&lt;img ... &gt;</code>, which will result in an image scaled to fit into whatever the natural
    width of the enclosing HTML container is (the content area, a text widget, etc.). You may specify an explicit
    value (usually in px) for the height and width of the image.
    </li>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
    </ol>
</p>
<?php
}

function aspen_sw_sc_html_admin() {

?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>HTML - [aspen_html]</b></span>&nbsp;
<?php aspen_sw_help_link('help.html#schtml','Help for HTML Shortcode');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_html], [html ...]</code>
<br />
<p>The Aspen <code>[aspen_html]</code> shortcode allows you to add arbitrary HTML to your post and page content. The
main purpose of this shortcode is to get around the auto paragraph and line break and other HTML stripping functionality
of the WordPress editor. See the Help document for more details.</p>

<p><strong>Shortcode usage:</strong> <code>[aspen_html html-tag args='parameters']</code>

<ol>
    <li><strong>html-tag</strong> - The first parameter to the shortcode must be present, and must be a standard
    HTML tag - <code>p</code>, <code>br</code>, or <code>span</code>, for example. You just supply the tag - no quotation
    marks, no '=', just the tag. The shortcode provides the &lt; and &gt;. If you need a wrapping HTML tag (e.g., <code>span</code> and <code>/span</code>), use
    two shortcodes:<br />
    <code>[aspen_html span args='style="color:red"']content to make red[aspen_html /span]</code>
    </li>
    <li><strong>args='parameters'</strong> - Allows you to specify arbitrary parameters for your HTML tag. See the example above.
    </li>
</ol>
</p>
<?php
}

function aspen_sw_sc_div_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>DIV - [div]text[/div]<br />SPAN - [span]text[/span]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#scdiv','Help for div Shortcode');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_div], [aspen_div]</code>
<br />
<p>The Aspen <code>[div]</code> and <code>[span]</code> shortcodes allow easily add HTML &lt;div&gt; and &lt;span&gt; tags
to your post and page content. The main purpose of these shortcodes is to get around need to switch to the HTML editor view when you need to
wrap your content in a &lt;div&gt; or &lt;span&gt;.</p>
<p>
	These will work exactly like a standard HMTL &lt;div&gt; or &lt;span&gt; tag. They support 'id', 'class',
    and 'style' parameters, which are the most useful. Instead of wrapping your text in &lt;div&gt; or &lt;span&gt; tags, wrap them like
    this (the Visual view will work just fine):<br />
    <code>[div style="font-size:20px;']This content will be large.[/div]</code> or <br />
    <code>[span style="font-size:20px;']This content will be large.[/span]</code> or <br />
</p>

<p><strong>Shortcode usage:</strong> <code>[div id='class_id' class='class_name' style='style_values']text[/div]</code>
<br /><code>[span id='class_id' class='class_name' style='style_values']text[/span]</code>
<br />
<ol>
    <li><strong>id='class_id' class='class_name' style='style_values'</strong> - Allows you to specify id, class, and style for the &lt;div&gt;. See the example above.
    </li>
</ol>
</p>
<?php
}

function aspen_sw_sc_iframe_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>iFrame - [aspen_iframe]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#sciframe','Help for Aspen iFrame');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_iframe], [iframe]</code>
<br />
<p>The <code>[aspen_iframe]</code> shortcode allows you easily display the content of an external site. You simply have to specify
the URL for the external site, and optionally a height. This shortcode automatically generates the correct HTML &lt;iframe&gt; code.</p>

<p><strong>Shortcode usage:</strong> <code>[aspen_iframe src='http://example.com' height=600 percent=100 style="style"]</code>
<br />
<ol>
    <li><strong>src='http://example.com'</strong> - The standard URL for the external site.
    </li>
    <li><strong>height=600</strong> - Optional height to allocate for the site - in px. Default is 600.
    </li>
    <li><strong>percent=100</strong> - Optional width specification in per cent. Default is 100%.
    </li>
    <li><strong>style="style"</strong> - Optional style values. Added to &lt;iframe&gt; tag as style="values" (shortcode adds double quotation marks).
    </li>
</ol>
</p>

<?php
}

function aspen_sw_showhide_mobile_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Show If Mobile - [aspen_show_if_mobile]</b></span>&nbsp;
<?php aspen_sw_help_link('help.html#showhidemobile','Help for Show/Hide if Mobile');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide If Mobile - [aspen_hide_if_mobile]</b></span></label>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_show/hide_if_mobile], [show/hide_if_mobile]</code>
<br />
<p>The <code>[aspen_show_if_mobile]</code> and <code>[aspen_hide_if_mobile]</code>shortcodes allow you to selectively
display content depending if the visitor is using a standard browser or a mobile device browser. You might want
to disable a video on for mobile devices, or even disable the Aspen Slider Menu on mobile devices, for example.</p>

<p><strong>Shortcode usage:</strong> <code>[aspen_show_if_mobile type='mobile']content to show[/aspen_show_if_mobile]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[aspen_show/hide_if_mobile]</code> and closing
<code>[/aspen_show/hide_if_mobile]</code> tags. That content can contain other shortcodes as needed.
</p>
<p>
The <code>type</code> argument can specify 'mobile' which includes all mobile devices (not tablets), 'touch' which includes
touch sensitive mobile devices (e.g., small screen phones),'smalltablet' for small screen tablets (e.g. Kindle Fire), 'tablet' which includes only tablets such as the iPad,
or 'any' which will include any mobile device. The default is 'mobile'.
</p>
<?php
}

function aspen_sw_showhide_logged_in_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show If Logged In - [aspen_show_if_logged_in]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#showhideloggedin','Help for Show/Hide if Logged In');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide If Logged In - [aspen_hide_if_logged_in]</b></span></label>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_show/hide_if_logged_in], [show/hide_if_logged_in]</code>
<br />
<p>The <code>[aspen_show_if_logged_in]</code> and <code>[aspen_hide_if_logged_in]</code>shortcodes allow you to selectively
display content depending if the visitor is logged in or not.</p>

<p><strong>Shortcode usage:</strong> <code>[aspen_show_if_logged_in]content to show[/aspen_show_if_logged_in]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[aspen_show_if_logged_in] or [aspen_hide_if_logged_in]</code>
and closing tags <code>[/aspen_show_if_logged_in]</code> or
<code>[/aspen_hide_if_logged_in]</code>. That content can contain other shortcodes as needed. </p>


<?php
}

function aspen_sw_show_posts_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show Posts - [aspen_show_posts]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#showposts','Help for Aspen Shortcodes'); ?>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_show_posts], [show_posts]</code>
<br />
<p>The Aspen <code>[aspen_show_posts]</code> shortcode allows you to display posts on your pages or in a text widget
in the sidebar. You can specify a large number of filtering options to select a specific set of posts to show.</p>
<p>
<strong>Summary of all parameters, shown with default values.</strong> You don't need to supply every
option when you add the [aspen_show_posts] to your own content. The options available for this short code allow
you a lot of flexibility id displaying posts. A full description of all the parameters
is included in the Help file - <em>please</em> read it to learn more about this shortcode. Just click the ? above.</p>
<p>
<em>[aspen_show_posts cats="" tags="" author="" author_id="" single_post="" post_type='' orderby="date" sort="DESC" number="5" paged=false show="full" hide_title=""
hide_top_info="" hide_bottom_info="" show_featured_image="" hide_featured_image="" show_avatar="" show_bio="" excerpt_length="" style=""
class="" header="" header_style="" header_class="" more_msg="" left=0 right=0 clear=0]</em>
</p>
<?php
}

function aspen_sw_sitetitle_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Title - [aspen_site_title]</b></span>&nbsp;
<?php aspen_sw_help_link('help.html#sitetitlesc','Help for Aspen Site Title and Tagline');
?>
<br />
<span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Tagline - [aspen_site_desc]</b></span>

<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_site_title/desc], [site_title/desc]</code>
<br />
<p>The <code>[aspen_site_title]</code> and <code>[aspen_site_desc]</code> shortcodes allow you display the current
site title and site tagline. (Site Tagline was formerly called Site Description.) This can be useful in a text widget in the Header Widget Area, for example.</p>
<p><em>Note:</em> If you want to position the content of a text widget within the a cell of the Header Widget Area, you could use the following
example:</p>
    <p><code>[aspen_site_title style='font-size:150%;position:absolute;padding-left:20px;padding-top:30px;']</code></p>

<p><strong>Shortcode usage:</strong> <code>[aspen_site_title style='inline-style'] [aspen_site_desc style='inline-style']</code>
<br />
<ol>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
</ol>
</p>

<?php
}

function aspen_sw_video_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Vimeo - [aspen_vimeo]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#video','Help for Aspen Video shortcodes');
?>
<br /><label><span style="color:blue;font-weight:bold; font-size: larger;"><b>YouTube - [aspen_youtube]</b></span></label>
<br />

<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_vimeo/youtube], [vimeo/youtube]</code>
<br />
<p>The Aspen Shortcodes and Widgets plugin supports specialized shortcodes to display video. While there are other ways to embed video, the Aspen versions have two important features. First, they will auto adjust to the width of your content, <em><strong>including</strong></em> the mobile view. Second, they use the latest iframe/HTML5 interface provided by YouTube and Vimeo.</p>
<h4>Vimeo</h4>
<strong>Shortcode usage:</strong> <code>[aspen_vimeo vimeo-url id=videoid sd=0 w=640/percent=100 ratio=.5625 center=1 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1]</code>

<p>This will display Vimeo videos. At the minimum, you can provide the standard http://vimeo.com/nnnnn link, or just the video ID number (which is part of the Vimeo Link). The other options are explained in the Help document</p>
<h4>YouTube</h4>
<strong>Shortcode usage:</strong> <code>[aspen_youtube youtube-url id=videoid sd=0 w=640/percent=100 ratio=.5625 center=1 rel=0 https=0 privacy=0  see_help_for_others]</code>
<p>This will display YouTube videos. At the minimum, you can provide the standard http://youtu.be/xxxxxx share link (including the options YouTube lets you specify), the long format share link, or just the video ID number (which is part of the YouTube Link). The other options are explained in the Help document</p>
<p>Specifying a percent will cause the video to be displayed using that percentage of the width of the containing element (content, widget).The videos will auto-resize as you shrink the browser width. If you specify a width (w=640), then that width will be used,
overriding any percent you may have specified, and
the videos will not auto-shrink. This setting is useful when used with an [aspen_slider].</p>

<h3 style="color:blue;">Options for Video Shortcodes</h3>
    <form name="aspen_sw_options_form2" method="post">
        <p>
<?php
    aspen_sw_form_checkbox('video_fitvids',
        '<b>Use FitVids Script for Videos</b> - Use alternative "FitVids" script for responsive display
of <b>all</b> videos. This script will work for any YouTube or Vimeo video - even if not specified by this
shortcode. If checked,
[aspen_youtube] and [aspen_vimeo] will automatically use a "w=nnn" option, and ignore the "percent" option.
Note: if you use [aspen_youtube] and [aspen_vimeo] for all your videos, then you will have better
appearance if you do <b>not</b> check this option.');
?>
        </p>
        <input type="hidden" name="aspen_sw_save_video_opts" value="Video Options Saved" />

        <input class="button-primary" type="submit" name="aspen_sw_save_options" value="Save Slider Options"/>
<?php
        aspen_sw_nonce_field('aspen_sw_save_options');
?>
    </form>
<?php
}

function aspen_sw_save_video_opts() {
    // video options
    $checkboxes = array('video_fitvids');

    foreach ($checkboxes as $opt) {
        if (isset($_POST[$opt])) aspen_sw_setopt($opt, true);
        else aspen_sw_setopt($opt, false, false);
    }
    aspen_sw_save_all_options();    // and save them to db
    aspen_sw_save_msg('Video Options saved');
}

function aspen_sw_horiz_widget_admin() {
?>
<p><strong>Aspen Vertical Menu Widget</strong> - This widget will display a simple rollover vertical menu in
the widget. This is essentially the same vertical menu you can get using the shortcode with the .menu-vertical style.
The widget lets you select the menu from the widget control box. <em>Note - Custom Sidebars:</em> If you have
customized your sidebar with extra padding or borders (e.g., the Kitchen Sink subtheme), the default vertical styling
may not have the correct width. You can fix this by adding <code>.menu-vertical {width:254px !important;}</code> to
the <em>&lt;HEAD> Section</em> in Advanced Options, and adjusting the '254px' to fit.

</p>
<hr />
<p class='atw-option-section'>Horizontal Widget Area - [aspen_hoizontal_widget_area]</p>
<p><code>[aspen_hoizontal_widget_area id='some_id']</code></p>
<p>
    This shortcode allows you to place the Aspen Header Horizontal Widget Area where ever you want - it doesn't even
    have to be in the header! You don't need the "id" paramater, but if you specify an id, the widget area will be wrapped
    in a <code>&lt;div id="some_id"&gt;</code>, and you can add additional CSS styling by using that id in a custom CSS rule.
    The size and background option found in the Header options will also be applied.</p>
<p>
    The shortcode is really intended to be used together with the <em>Aspen Admin : Main Options : Header : Header Widget Area</em>
    "Show Only via Shortcode" option. With that option checked, the Header Horizontal Widget Area will be displayed only when the shortcode is used.
    You can use it anywhere, but the HTML insertion areas are likely candidates.
</p>
<?php
}


function aspen_sw_extra_menu_admin() {
?>
    <p class='atw-option-section'>Extra Menu Shortcode - [aspen_extra_menu] + Vertical Menu Widget<?php aspen_help_link('help.html#extra_menus','Extra Menus help'); ?></p>

<p><code>[aspen_extra_menu wrap='wrap_class' menu='menuname' style='stylename' width='width_override' css='extra_css']</code></p>

<p>The <code>[aspen_extra_menu]</code> short code allows you to display a menu you've defined in the
<em>Appearance&rarr;Menus</em> panel almost any place in your site: in a sidebar text widget, on a post or page,
or in one of the <em>HTML Insertion</em> areas found on the <em>Aspen Admin&rarr;Advanced Options</em> tab.
Simply insert the shortcode with at least a menu name wherever you want the menu to appear.</p>

<ol>
	<li><strong>menu=</strong> - The 'menu' parameter allows you to specify which custom menu to display. The name of
	the menu can be a 'Menu Name' used in the tabbed menu definition area, or the slug name of one of the 'Theme Locations'
	box (a slug is all lower case with no spaces of the Navigation name). If you specify '0', then the default
	menu will be used.
	</li>
	<li><strong>wrap=</strong> - This is the name of a class to wrap your menu. The default is 'extra_menu'. This is
	useful for a couple of things. First, you can specify <code>#access</code> to add the bottom rounded corners (if set)
	of the Primary menu bar. Using <code>#access2</code> will get the top rounded corners of the upper Secondary menu bar.
	You could also specify your own name, and create additional rules to change attributes of the main <code>.menu_bar</code>
	class. For example, specifying <code>wrap='my_menu'</code> and adding a custom CSS
	rule like <code>.my_menu .menu_bar {background-color:transparent;}</code> to the <em>Custom CSS Rules</em> section would
	replace whatever the default menu bar background color was with transparent.
	</li>
	<li><strong>style=</strong> - The 'style' parameter is used to specify how the menu will look. You can use one of
	several pre-defined styles, or add your own custom menu styling in the <em>&lt;HEAD&gt; Section</em> on the
	<em>Advanced Options</em> tab. The pre-defined styles include:
	<ol>
		<li><code>menu_bar</code> - This is the style class name of the standard bottom and top menu bars.
		For example, using <code>[aspen_extra_menu menu='mymenu' style='menu_bar']</code> in the <em>Pre-Footer Code</em> area will
		display custom menu 'mymenu' right above the footer using the same styling as the top menu bar.
		</li>
		<li><code>menu-vertical</code> - Displays a simple Vertical Rollover menu in a width that matches the width of
		the primary sidebar. It will use the same colors as you've defined for your main menu bars. Simply add
		<code>[aspen_extra_menu menu='mymenu' style='menu-vertical']</code> to a standard text widget placed
		on a sidebar widget area.
		</li>
		<li><code>menu-horizontal</code> - Displays a very simple horizontal one-level menu. The links are styled
		using the standard link colors and styles of the section the menu is placed. This style is useful for placing
		a simple link menu right below your main menu, for example.
		</li>
		<li><code>menu-vertical-default</code> - Displays a simple vertical menu using standard list and default link
		formatting.
		</li>
	</ol>
	</li>
	<li><strong>width=</strong> - Allows you to specify the width of the outer box surrounding the menu. You could use
	it to make a narrower <code>.menu_bar</code> styled menu, for example. You can use px or % to specify the width.
	</li>
	<li><strong>css=</strong> - You can specify any CSS styling for the outer &lt;div&gt; that wraps the menu. This will
	be placed in a <code>style="css..."</code> parameter.
	</li>
	<li><strong>border_color=</strong> - You can add a border to your extra menu by specifying a color.
	</li>
</ol>
</p>
<?php
}


function aspen_sw_tabgroup_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Tab Group - [aspen_tab_group]</b></span></label>&nbsp;
<?php aspen_sw_help_link('help.html#tab_group','Help for Aspen [tab_group]'); ?>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_tab_group], [tab_group]</code>
<br />
<p>Show content displayed on tabbed pages.</p>
<p><strong>Shortcode usage:</strong><br>
<pre>
[aspen_tab_group border_color=black page_min_height=200px]
    [aspen_tab title='tab one']This is the content found on first tab.[/aspen_tab]
    [aspen_tab title='tab two']And we have more content for the second tab.[/aspen_tab]
    [aspen_tab title='last tab']And this is the last tab. There could be more.[/aspen_tab]
[/aspen_tab_group]
</pre>

</p>
<p>
<h4>Short code parameters</h4>
You can supply values for these parameters to control the look of the tabbed section.
<br />
<ul>
    <li><b>border_color:</b> tab and pane border color - default #888</li>
    <li><b>tab_bg</b>: normal bg color of tab (default #CCC)</li>
    <li><b>tab_selected_color</b>: color of tab when selected (default #EEE)</li>
    <li><b>pane_min_height</b>: min height of a pane to help make all even if needed</li>
    <li><b>pane_bg</b>: bg color of pane</li>
</ul>
</p>

<?php
}
?>
