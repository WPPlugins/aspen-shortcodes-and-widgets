<?php
/*
Aspen SW - BX Slider - admin code

This code is Copyright 2011 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/


function aspen_sw_bxslider_admin() {
?>
<span style="color:blue;font-weight:bold; font-size: larger;"><b>Slider - [aspen_slider]</b></span>&nbsp;
<?php aspen_sw_help_link('help.html#slider','Help for Aspen Slider');
?>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_slider ...], [slider ...], and the same for the other components for this shortcode</code>
<p>The Aspen [aspen_slider] shortcode is based on the <em>bxSlider jQuery</em> slider script. This elegant and
powerful tool allows you to generate sliders of almost any size, with any content - images, videos, even
arbitrary HTML. Because it is so flexible, you should read the Help file tutorial on just how to use this shortcode.</p>

<p>For quick reference, this is a simple example of a horizontal slider with images from the Aspen Theme banners.</p>
<pre>
[aspen_slider id=bxslider]
    [aspen_slide]&lt;img alt="" src="/wp-content/themes/aspen/images/headers/aspen-grove.jpg" /&gt;[/aspen_slide]
    [aspen_slide]&lt;img alt="" src="/wp-content/themes/aspen/images/headers/maroon-bells.jpg" /&gt;[/aspen_slide]
    [aspen_slide]&lt;img alt="" src="/wp-content/themes/aspen/images/headers/mountain-stream.jpg" /&gt;[/aspen_slide]
    [aspen_slide]&lt;img alt="" src="/wp-content/themes/aspen/images/headers/mum.jpg" /&gt;[/aspen_slide]
    [aspen_slide]&lt;img alt="" src="/wp-content/themes/aspen/images/headers/sopris.jpg" /&gt;[/aspen_slide]
[/aspen_slider]
</pre>

<p>Notes: You can specify any option supported by <em>bxSlider</em> to the [aspen_slider] shortcode. The standard desktop
size of the slider is determined by the widest and tallest items in the slider. For the best looking image slider,
all images should be the same size. The slider automatically resizes for smaller screens.
You can specify a thumbnail
index using the [aspen_slider_pager] and [aspen_slider_index] shortcodes. See the Help file for an example. You
can use the [aspen_slider_options] shortcode to specify bxSlider options while using &lt;ul&gt; and &lt;li&gt;
elements to define the slider, as found in the examples on the bxSlider.com website. Since slider content may be HTML, you can create
a blog post slider using the [aspen_show_posts] shortcode. You can add &lt;a&gt; links around images, or almost
any other html code you need.</p>

<p>For best display of videos in a slider, use either the embedded iframe code provided by YouTube or Vimeo, and check the "Support
Videos in Sliders" option below. You can also use [aspen_youtube] or [aspen_vimeo] for videos in a slider, but you
will have to specify a specific width (e.g., <em>w='640'</em>) so that the slider responsive resizing is used instead
of the Aspen plugin resizing. Note that WordPress automatic recognition of video links does not work inside the slider shortcode.</p>

    <h3 style="color:blue;">Options for Slider Shortcode</h3>
    <form name="aspen_sw_options_form2" method="post">
        <p>
<?php
    aspen_sw_form_checkbox('slider_fitvids',
        '<b>Support Videos in Sliders</b> - Enable videos in sliders. Will use an additional
script to make videos fit the slider, and responsively resize. This auto-resize script will
apply to all videos on pages with sliders. You will get best results using the embed code
provided by the video host (e.g., YouTube, Vimeo). If you use [aspen_youtube] or [aspen_vimeo],
you must specify a width (e.g., w=940) to allow this feature to work. <strong style="color:red;">
IMPORTANT:</strong> Be sure to specify "video=true" for the [aspen_slider] shortcode. If you
have checked <em>Use FitVids Script for Videos</em> on the Videos tab, then you do not need to
add "video=true" to [aspen_slider].');
    aspen_sw_form_checkbox('slider_easing',
        '<b>Use Alternate Easing Animation</b> - If you use the useCSS=false option, you need
to check this option to load the proper easing animation script. See the bxSlider website for details.');
?>
        </p>
        <input type="hidden" name="aspen_sw_save_slider_opts" value="Slider Options Saved" />

        <input class="button-primary" type="submit" name="aspen_sw_save_options" value="Save Slider Options"/>
<?php
        aspen_sw_nonce_field('aspen_sw_save_options');
?>
    </form>
<?php
}

function aspen_sw_save_slider_opts() {
    // global options
    $checkboxes = array('slider_fitvids','slider_easing');

    foreach ($checkboxes as $opt) {
        if (isset($_POST[$opt])) aspen_sw_setopt($opt, true);
        else aspen_sw_setopt($opt, false, false);
    }
    aspen_sw_save_all_options();    // and save them to db
    aspen_sw_save_msg('Slider Options saved');
}
?>
