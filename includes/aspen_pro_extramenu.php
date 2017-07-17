<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
Aspen Pro Extra Menus - Version 1.0

EXTRAMENU
CODE

This code is Copyright 2013 by Bruce Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.html.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/* ============================ aspen_pro_extra_menu =============================== */

function aspen_pro_has_extra_menu() { return true; }

	class aspen_pro_Widget_Vertical_Menu extends WP_Widget {

		function aspen_pro_Widget_Vertical_Menu() {
			$widget_ops = array( 'classname'=>'aspen_vertical_menu',
				'description' => 'Use this widget to add one of your custom menus as a widget.'
				. ' Use Aspen Menu Bar settings to display simple Rollover vertical menu.' );
			parent::WP_Widget( 'aspen_pro_nav_menu', 'Aspen Vertical Menu' , $widget_ops );
		}

		function widget($args, $instance) {
			// Get menu
			$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );

			$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			$type = $instance['menu_style'];
			if (!$type) $type='vertical';
			$wrap = 'menu_widget';
			$class = 'menu_bar';        // most will use menubar as the base style
			switch ($type) {
				case 'vertical':        // simple, no popoup vertical menu
					$class = 'menu-vertical';
					break;
				case 'left':            // pop-out to the left side
					$wrap = 'menu_pop_left';
					break;
				case 'right':           // pop-out to the right side
					$wrap = 'menu_pop_right';
					break;
				default:
					break;
			}


			echo $args['before_widget'];

			if ( !empty($instance['title']) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];

			echo aspen_pro_extra_menu_generate_code($nav_menu, $wrap, $class );

			echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance['menu_style'] = $new_instance['menu_style'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$menu_style = isset( $instance['menu_style'] ) ? $instance['menu_style'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		$styles = array ('Vertical' => 'vertical', 'Pop Out to Left' => 'left',
			'Pop Out to Right' => 'right', 'Horizontal' => 'horizontal');

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( 'No menus have been created yet. <a href="%s">Create some</a>.', admin_url('nav-menus.php') ) .'</p>';
			return;
		}
?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo('Title:' /*a*/ ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_textarea($title); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php echo('Select Menu:' /*a*/ ); ?></label>
		<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('menu_style'); ?>"><?php echo('Select Menu Style:' /*a*/ ); ?></label>
		<select id="<?php echo $this->get_field_id('menu_style'); ?>" name="<?php echo $this->get_field_name('menu_style'); ?>">
<?php
			foreach ( $styles as $style => $val) {
				$selected = $menu_style == $val ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="' . $val .'">'. $style .'</option>';
			}
?>
		</select>
		</p>
<?php
	   }
}

function aspen_pro_extra_menu_shortcode($args = '') {
	extract(shortcode_atts(array(
		'menu' => 'primary',      // default menu name
		'style' => 'menu-vertical', // default menu style id (should be class)
		'width' => '',
		'border_color' => '',
		'css' => '',
		'wrap' => 'extra_menu'
	), $args));

	return aspen_pro_extra_menu_generate_code($menu,$wrap , $style, $border_color,$css,$width);
}

function aspen_pro_extra_menu_generate_code($menu, $wrap = 'extra_menu', $style='menu-vertical', $border_color='',$css='',$width='',$id='') {

	$container_class = $wrap;

	if ($style[0] == '.') $style = substr($style,1);

	$wstyle = $width ? 'width:' . $width . ';' : '';

	if ($border_color == '') $bstyle = '';
	else $bstyle = 'border: 1px solid ' . $border_color .';';

	if ($bstyle != '' || $css != '' || $wstyle != '' ) $add_style = ' style="' . $bstyle . $css . $wstyle .'"';
	else $add_style = '';

	$out = '<div ' . $id . 'class="' . $container_class . '" role="navigation"' . $add_style . ">\n";

	//if (aspen_pro_getopt('wii_use_superfish') && $style == 'menu_bar')
	//   $out .= wp_nav_menu( array( 'container_class' => $style, 'echo' => false, 'menu' => $menu_id, 'menu_class' => 'sf-menu', 'fallback_cb' => '' ) );
	//else
	if (is_string($menu) && strpos($menu,'location:') !== false) {      // specified a theme location
		$nav_menu = str_replace('location:','',$menu);
		$the_menu = wp_nav_menu( array( 'container_class' => $style, 'echo' => false,
									   'theme_location' => $nav_menu ) );
		$out .= str_replace('<div class="menu">','<div class="menu ' . $style . '">',$the_menu);
	} else {
		$menu_id = wp_get_nav_menu_object($menu);
		$out .= wp_nav_menu( array( 'container_class' => $style, 'echo' => false, 'menu' => $menu_id,
								   'fallback_cb' => '' ) );
	}
	$out .= "</div><div class=\"aspen-clear\"></div>\n";
	return $out;
}

add_shortcode('aspen_extra_menu','aspen_pro_extra_menu_shortcode');

function aspen_pro_hoizontal_widget_area_sc($args = '') {
    extract(shortcode_atts(array(
		'id' => ''
	), $args));

    ob_start();
    if ($id != '') {
        echo "<div id='$id'>\n";
    }
    aspen_pro_header_widget_area('shortcode');
    if ($id != '') {
        echo "</div> <!-- #$id'-->\n";
    }
    $widget = ob_get_clean();
    return $widget;
}

add_shortcode('aspen_hoizontal_widget_area','aspen_pro_hoizontal_widget_area_sc');

add_action('widgets_init', "aspen_pro_load_menu_widget");
function aspen_pro_load_menu_widget() {
		register_widget("aspen_pro_Widget_Vertical_Menu");
}
?>
