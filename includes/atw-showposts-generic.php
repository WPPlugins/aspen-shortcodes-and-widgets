<?php

function atw_generic_show_posts_shortcode($args = '') {
    /* implement [weaver_show_posts]  */

/* DOC NOTES:
CSS styling: The group of posts will be wrapped with a <div> with a class called
.wvr-show-posts. You can add an additional class to that by providing a 'class=classname' option
(without the leading '.' used in the actual CSS definition). You can also provide inline styling
by providing a 'style=value' option where value is whatever styling you need, each terminated
with a semi-colon (;).

The optional header is in a <div> called .wvr_show_posts_header. You can add an additional class
name with 'header_class=classname'. You can provide inline styling with 'header_style=value'.

.wvr-show-posts .hentry {margin-top: 0px; margin-right: 0px; margin-bottom: 40px; margin-left: 0px;}
.widget-area .wvr-show-posts .hentry {margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;}
*/

    global $more;

    extract(shortcode_atts(array(
	     /* query options */
	    'cats' => '',			/* by slug, use - to exclude  */
	    'tags' => '',			/* by slug (tag) */
	    'author' => '',			/* author - use nickname (auhor_name)*/
	    'author_id' => '',			/* list of author IDs */
	    'single_post' => '',		/* by slug - only one article (name) */
	    'post_type' => '',			/* add post_type */
	    'orderby' => 'date',		/* author | date | title | rand | modified | parent {date} (orderby) */
	    'sort' => 'DESC',			/* ASC | DESC {DESC} (order)*/
	    'number' => '5',			/* number of posts to show  {5} (posts_per_page)*/
	    'paged' => false,			/* use paging? */
        'sticky' => false,          // show sticky?
	    'nth' => '0',			/* show just the nth post that matches other criteria */
	    /* formatting options */
	    'show' => 'full',			/* show: title | excerpt | full | titlelist  */
	    'hide_title' => '',			/* hide the title? */
	    'hide_top_info' => '',		/* hide the top info line */
	    'hide_bottom_info' => '',		/* hide bottom info line */
	    'show_featured_image' => true, 	/* force showing featured image */
	    'show_avatar' => '',		/* show the author avatar */
	    'show_bio' => '',			/* show the bio below */
	    'excerpt_length' => '',		/* override excerpt length */
	    'style' => '',			/* inline CSS style for wvr-show-posts */
	    'class' => '',			/* optional class to allow outside styling */
	    'header' => '',			/* optional header for post */
	    'header_style' => '',		/* styling for the header */
	    'header_class' => '',		/* class for header */
	    'more_msg' => '',			/* replacement for Continue Reading */
	    'left' => '',
	    'right' => '',
	    'clear' => true,
	    'cols' => '1'			// number of columns

    ), $args));


    // set transient opts for these options

    atw_t_set('showposts',true);	// global to see if we are in this function

    atw_t_set('show',$show);		// this will always be set

    if ($hide_title != '') atw_t_set('hide_title',true);
    if ($hide_top_info != '') atw_t_set('hide_top_info',true);
    if ($hide_bottom_info != '') atw_t_set('hide_bottom_info',true);
    atw_t_set('show_featured_image',$show_featured_image);
    if ( isset($args['show_avatar'])) {
        if ($show_avatar) {
            atw_t_set('show_avatar', true);
        } else {
            atw_t_set('show_avatar','no');
        }
    }
    if ($excerpt_length != '') atw_t_set('excerpt_length',$excerpt_length);
    if ($more_msg != '') atw_t_set('more_msg',$more_msg);

    /* Setup query arguments using the supplied args */
    $qargs = array(
        'ignore_sticky_posts' => 1
    );

    $qargs['orderby'] = $orderby;	/* enter opts that have defaults first */
    $qargs['order'] = $sort;
    $qargs['posts_per_page'] = $number;
    if (!empty($cats)) $qargs['cat'] = atw_cat_slugs_to_ids($cats);
    if (!empty($tags)) $qargs['tag'] = $tags;
    if (!empty($single_post)) $qargs['name'] = $single_post;
    if (!empty($author)) $qargs['author_name'] = $author;
    if (!empty($author_id)) $qargs['author'] = $author_id;
    if (!empty($post_type)) $qargs['post_type'] = $post_type;
    if (!empty($sticky) && $sticky) $qargs['ignore_sticky_posts'] = 0;

    if ( $paged ) {
	if ( get_query_var( 'paged' ) )
	    $qargs['paged'] = get_query_var('paged');
	else if ( get_query_var( 'page' ) )
	    $qargs['paged'] = get_query_var( 'page' );
	else
	    $qargs['paged'] = 1;
    }

    $ourposts = new WP_Query(apply_filters('weaver_show_posts_wp_query',$qargs, $args));
	// now modify the query using custom fields for this page

    /* now start the content */

    $div_add = '';
    if ($left) $class .= ' atw-left';
    else if ($right) $class .= ' atw-right';
    if (!empty($style)) $div_add = ' style="' . $style . '"';
    $content = '<div style="clear:both;"></div><div class="atw-show-posts ' . $class . '"'  . $div_add . '>';

    $h_add = '';
    if (!empty($header_style)) $h_add = ' style="' . $header_style . '"';

    if (!empty($header)) {
        $content .= '<div class="atw-show-posts-header ' . $header_class . '"' . $h_add . '>' . $header . '</div>';
    }

    ob_start();

    if ($show == 'titlelist') echo '<ul>';

    $posts_out = 0;
    $col = 0;
    while ( $ourposts->have_posts() ) {
        $ourposts->the_post();
        $posts_out++;
        if ($nth != 0) {
            if ($posts_out < $nth)
                continue;
            if ($posts_out > $nth)
                break;			// all done...
        }

        // aspen_per_post_style();
        if ($show == 'titlelist') {
    ?>
            <li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__( 'Permalink to %s','aspen')),
           the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
    <?php
        } else {
            switch ($cols) {
                case 2:
                    echo ('<div class="atw-content-2-col atw-cf">' . "\n");
                    atw_show_content();
                    echo ("</div> <!-- atw-content-2-col -->\n");
                    $col++;
                    if ( !($col % 2) ) {	// force stuff to be even
                        echo "<div style=\"clear:left;\"></div>\n";
                    }
                    break;
                case 3:
                    echo ('<div class="atw-content-3-col atw-cf">' . "\n");
                    atw_show_content();
                    echo ("</div> <!-- atw-content-3-col -->\n");
                    $col++;
                    if ( !($col % 3) ) {	// force stuff to be even
                        echo "<div style=\"clear:left;\"></div>\n";
                    }
                    break;
                case 1:
                default:
                    atw_show_content();
                    break;
                }	// end switch $cols
        }

    } // end loop
    if ($show == 'titlelist') echo "</ul>\n";
    if (!empty($show_bio) && get_the_author_meta( 'description' ) ) { ?>
    <hr />
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'atw_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php printf( esc_attr__( 'About %s','aspen'), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>','aspen'), get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
<?php
    }

    if ($paged) {
?>
    <div style="clear:both;"></div>
    <div id="atw-show-posts-navigation" class="atw-post-nav">
<?php
	$big = 999999;
	echo paginate_links( array(
	    'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format'  => '?paged=%#%',
	    'current' => max( 1, $qargs['paged'] ),
	    'total'   => $ourposts->max_num_pages
	) );
?>
    </div>
<?php
    }
    $content .= ob_get_clean();	// get the output

    // get posts

    $content .= '</div><!-- #atw-show-posts -->';
    if ($clear) echo "\t<div style='clear:both;'></div>\n";

    // reset stuff
    wp_reset_query();
    wp_reset_postdata();
    atw_t_clear_all();

    return "<!-- aspen_show_posts -->\n" . $content;
}

function atw_cat_slugs_to_ids($cats) {
    if (empty($cats)) return '';
    // now convert slugs to numbers
    $cats = str_replace(' ','',$cats);
    $clist = explode(',',$cats);	// break into a list
    $cat_list = '';
    foreach ($clist as $slug) {
        $neg = 1;	// not negative
        if ($slug[0] == '-') {
            $slug = substr($slug,1);	// zap the -
            $neg = -1;
        }
        if (strlen($slug) > 0 && is_numeric($slug)) { // allow both slug and id
            $cat_id = $neg * (int)$slug;
            if ($cat_list == '') $cat_list = strval($cat_id);
            else $cat_list .= ','.strval($cat_id);
        } else {
            $cur_cat = get_category_by_slug($slug);
            if ($cur_cat) {
                $cat_id = $neg * (int)$cur_cat->cat_ID;
                if ($cat_list == '') $cat_list = strval($cat_id);
                else $cat_list .= ','.strval($cat_id);
            }
        }
    }
    if (empty($cat_list)) $cat_list='99999999';
    return $cat_list;
}

// ============================ atw_show_content===================

function atw_show_content() {

    $cur_post_id = get_the_ID();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="atw-entry-header">
<?php
	if (!atw_t_get('hide_title')) {		// ========== TITLE
?>
	    <hgroup class="atw-entry-hdr"><h2 class="atw-entry-title">
	    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__( 'Permalink to %s','aspen')),
	   the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	   </h2></hgroup>

<?php
	}

	if (!atw_t_get('hide_top_info')) {	// ============ TOP META
?>
	    <div class="atw-entry-meta">
		<div class="atw-entry-meta-icons">
<?php

    printf( __( '<span class="entry-date"><a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a></span> <span class="by-author"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>','aspen'),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr(__( 'View all posts by %s','aspen')), get_the_author() ),
		esc_html( get_the_author() )
	);

    if (atw_t_get('show_avatar') != '' && atw_t_get('show_avatar') != 'no' ) {
	    echo '&nbsp;&nbsp;' . get_avatar( get_the_author_meta('user_email') ,22,null,'avatar');
    }
?>
		</div><!-- .atw-entry-meta-icons -->
	    </div><!-- .atw-entry-meta -->
<?php
	}
?>
	</header><!-- .atw-entry-header -->
<?php
if (atw_trans_get('show') == 'title') {
        echo '</article><!-- #post-' . get_the_ID() . '-->';
        return;
    }
	if (atw_t_get('show') == 'excerpt') { // =================== EXCERPT
?>
	    <div class="atw-entry-summary atw-cf">
<?php
		atw_show_post_content();
?>
	    </div><!-- .atw-entry-summary -->
<?php
	} else {				// ================== FULL CONTENT
?>
	    <div class="atw-entry-content atw-cf">
<?php
		atw_show_post_content();
?>
	    </div><!-- .atw-entry-content -->
<?php
	}

	if (!atw_t_get('hide_bottom_info')) {	// ================= BOTTOM META
?>

	    <footer class="atw-entry-utility">
		<div class="atw-entry-meta-icons">
<?php
		$categories_list = get_the_category_list( __( ', ','aspen') );
		if ( $categories_list ) { ?>
		    <span class="cat-links">
<?php
		    echo $categories_list ;
?>
		    </span>
<?php
		} // End if categories
		$tags_list = get_the_tag_list( '', __( ', ','aspen') );
		if ( $tags_list ) {
?>
			<span class="tag-links">
<?php
		    echo $tags_list ;
?>
			</span>
<?php
		} // End if $tags_list
		if ( comments_open() ) {
?>
		    <span class="comments-link">
<?php
		    comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply','aspen') . '</span>',
			__( '<b>1</b> Reply','aspen'),
			__( '<b>%</b> Replies','aspen') );
?>
		    </span>
<?php 	        } // End if comments_open()
?>
		</div><!-- .entry-meta-icons -->
	    </footer><!-- .atw-entry-utility -->
<?php
	}
?>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php
}

function atw_show_post_content() {
    // display a post - honor shortcode's show_featured_image setting, but always thumbnail
    if (atw_t_get('show_featured_image') && get_post_thumbnail_id()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'full' );        // (url, width, height)
        // $href = $image[0];
	$href = get_permalink();
?>
    <span class='atw-featured-image'><a href="<?php echo $href; ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a></span>
<?php
    }
    if (atw_t_get('show') == 'excerpt') {
	$more = '';
	if (atw_t_get('more_msg') != '')
	    $more = atw_t_get('more_msg');
	the_excerpt($more);
    } else {
        echo do_shortcode(get_the_content(atw_t_get('more_msg')));
    }
}
?>
