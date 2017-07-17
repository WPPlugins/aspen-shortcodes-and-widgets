<?php
/* Breadcrumbs

Breadcrumbs support for Aspen Theme Works shortcode package
License: GPL

GPL License: http://www.opensource.org/licenses/gpl-license.php

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE

 * Credit: Dimox
 *	http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */
if (!function_exists('atw_breadcrumb')) {
    define ('ATW_BC_HOME',__('Home','atw'));
    define ('ATW_BC_BLOG',__('Blog','atw'));

function atw_breadcrumb($echo = true, $wrap = 'breadcrumbs') {
    $bc = '';

    $containerBefore = '<span id="' . $wrap . '">';
    $containerAfter = '</span>';
    $containerCrumb = '<span class="crumbs">';
    $containerCrumbEnd = '</span>';
    $delimiter = '&rarr;'; //' &raquo; ';
    $name = ATW_BC_HOME; //text for the 'Home' link
    $blogname = ATW_BC_BLOG; //text for the 'Blog' link
    $baseLink = '';
    $hierarchy = '';
    $currentLocation = '';
    $currentBefore = '<span class="bcur-page">';
    $currentAfter = '</span>';
    $currentLocationLink = '';
    $crumbPagination = '';

    global $post;

    $bc = '';
    // Output the Base Link
    if (is_front_page() ) {
	$bc .= $currentBefore . $name . $currentAfter;
    } else {
	$home = home_url('/');
	$baseLink =  '<a href="' . $home . '">' . $name . '</a>';
	$bc .= $baseLink;
    }
    // If static Page as Front Page, and on Blog Posts Index
    if ( is_home() && ( 'page' == get_option( 'show_on_front' ) ) ) {
	$bc .= $delimiter . $currentBefore . $blogname . $currentAfter;
    }
    // Aspen mod: check 'page_for_posts' when using PwP without setting blog host page
    // If static Page as Front Page, and on Blog, output Blog link
    if ( ! is_home() && ! is_page() && ! is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) && get_option( 'page_for_posts' ) ) {
	$blogpageid = get_option( 'page_for_posts' );
	$bloglink = '<a href="' . get_permalink( $blogpageid ) . '">' .  $blogname . '</a>';
	$bc .= $delimiter . $bloglink;
    }

    // Define Category Hierarchy Crumbs for Category Archive
    if ( is_category() ) {
	global $wp_query;
	if (is_object($wp_query->get_queried_object())) {
	    $cat_obj = $wp_query->get_queried_object();
	    $thisCat = $cat_obj->term_id;
	    $thisCat = get_category($thisCat);
	    $parentCat = get_category($thisCat->parent);
	    if ($thisCat->parent != 0) {
		$hierarchy = ( $delimiter . __( 'Categories','atw') . ' ' . get_category_parents( $parentCat, TRUE, $delimiter ) );
	    } else {
		$hierarchy = $delimiter . __( 'Categories','atw') . ' ';
	    }
	} else {
	    $hierarchy = '';
	}
	// Set $currentLocation to the current category
	$currentLocation = single_cat_title( '' , FALSE );

    }
    // Define Crumbs for Day/Year/Month Date-based Archives
    elseif ( is_date() ) {
	// Define Year/Month Hierarchy Crumbs for Day Archive
	if  ( is_day() ) {
	    $date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
	    $date_string .= $delimiter . ' ';
	    $currentLocation = get_the_time('d');
	}
	// Define Year Hierarchy Crumb for Month Archive
	elseif ( is_month() ) {
	    $date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
	    $date_string .= $delimiter . ' ';
	    $currentLocation = get_the_time('F');
	}
	// Set CurrentLocation for Year Archive
	elseif ( is_year() ) {
	    $date_string = '';
	    $currentLocation = get_the_time('Y');
	}
	$hierarchy = $delimiter . __( 'Published','atw') . ' ' . $date_string ;
    }
    // Define Category Hierarchy Crumbs for Single Posts
    elseif ( is_single() && !is_attachment() ) {
	$cats = get_the_category();
	if ($cats)
	    $cur_cat = $cats[0];
	else
	    $cur_cat = '';
	foreach ($cats as $cat) {
	    $children = get_categories( array ('parent' => $cat->term_id ));
	    if (count($children) == 0) {
		$cur_cat = $cat;
		break;
	    }
	}
	if ($cur_cat) {
	    $hierarchy = $delimiter . get_category_parents( $cur_cat, TRUE, $delimiter );
	} else {
	    $hierarchy = $delimiter . '';
	}
	    // Note: get_the_title() is filtered to output a
	    // default title if none is specified
	    $currentLocation = get_the_title();

    }
	// Define Category and Parent Post Crumbs for Post Attachments
    elseif ( is_attachment() ) {
	$parent = get_post($post->post_parent);
	$cat_parents = '';
	if ( get_the_category($parent->ID) ) {
	    $cat = get_the_category($parent->ID);
	    $cat = $cat ? $cat[0] : '';
	    $cat_parents = get_category_parents( $cat, TRUE, $delimiter );
	}
	$hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
	// Note: Titles are forced for attachments; the
	// filename will be used if none is specified
	$currentLocation = get_the_title();
    }
    // Define Current Location for Parent Pages
    elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) {
	$hierarchy = $delimiter;
	// Note: get_the_title() is filtered to output a
	// default title if none is specified
	$currentLocation = get_the_title();
    }
    // Define Parent Page Hierarchy Crumbs for Child Pages
    elseif ( ! is_front_page() && is_page() && $post->post_parent ) {
	$parent_id  = $post->post_parent;
	$breadcrumbs = array();
	while ($parent_id) {
	    $page = get_page($parent_id);
	    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	    $parent_id  = $page->post_parent;
	}
	$breadcrumbs = array_reverse($breadcrumbs);
	foreach ($breadcrumbs as $crumb) {
	    $hierarchy = $hierarchy . $delimiter . $crumb;
	}
	$hierarchy = $hierarchy . $delimiter;
	// Note: get_the_title() is filtered to output a
	// default title if none is specified
	$currentLocation = get_the_title();
    }
	// Define current location for Search Results page
    elseif ( is_search() ) {
	$hierarchy = $delimiter . __('Search Results','atw') . ' ';
	$currentLocation = get_search_query();
    }
	// Define current location for Tag Archives
    elseif ( is_tag() ) {
	$hierarchy = $delimiter . __( 'Tags','atw') . ' ';
	$currentLocation = single_tag_title( '' , FALSE );
    }
	// Define current location for Author Archives
    elseif ( is_author() ) {
	$hierarchy = $delimiter . __( 'Author','atw') . ' ';
	$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
    }
	// Define current location for 404 Error page
    elseif ( is_404() ) {
	$hierarchy = $delimiter . __( '404','atw') . ' ';
	$currentLocation = __( 'Page not found','atw');
    }
	// Define current location for Post Format Archives
    elseif ( get_post_format() && ! is_home() ) {
	$hierarchy = $delimiter . __( 'Post Formats','atw') . ' ';
	$currentLocation = get_post_format_string( get_post_format() ) . 's';
    }

// Build the Current Location Link markup
    $currentLocationLink = $currentBefore . $currentLocation . $currentAfter;

// Define breadcrumb pagination

// Define pagination for paged Archive pages
    if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
      $crumbPagination = ' - ' . __('Page','atw') . ' ' . get_query_var('paged');
    }

 // Define pagination for Paged Posts and Pages
    if ( get_query_var('page') ) {
      $crumbPagination = ' - ' . __('Page','atw') . ' ' . get_query_var('page') . ' ';
    }

// Output the resulting Breadcrumbs

    $bc .= $hierarchy; // Output Hierarchy
    $bc .= $currentLocationLink; // Output Current Location
    $bc .= $crumbPagination; // Output page number, if Post or Page is paginated

    if (is_rtl()) {
	$list = explode($delimiter,$bc);	// split on the arrow
	$list = array_reverse($list);
	$larrow = '&larr;';
	$bc = implode($larrow,$list);
    }
    // Wrap crumbs
    $bc = $containerBefore . $containerCrumb . $bc . $containerCrumbEnd . $containerAfter;

    if ($echo) echo $bc;
    else return $bc;
    return '';
}
}

?>
