<?php

function get_id() {
	global $wp_query;
	$thePostID = $wp_query->post->ID;
	return $thePostID;
}

function get_parent() {
	global $wp_query;
	$parent = array_reverse(get_post_ancestors($wp_query->post->ID));
	$theParentID = get_page($parent[0]);
	return $theParentID->ID;
}

function get_direct_parent() {
	global $wp_query;
	$parent = get_post_ancestors($wp_query->post->ID);
	$theParentID = get_page($parent[0]);
	return $theParentID->ID;
}

function is_child($page_id) { 
	global $post; 
	if(is_page() && $post->post_parent == $page_id ) {
       		return true;
	} else { 
       		return false; 
	}
}

function tnc_get_the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    return $thumbnail_image[0]->post_excerpt;
  }
}

function tnc_get_the_post_thumbnail_title() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    return $thumbnail_image[0]->post_title;
  }
}

function current_page_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

add_action( 'after_setup_theme', 'localize_setup' );

if ( ! function_exists( 'localize_setup' ) ):

function localize_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	add_filter('widget_title', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
    //add_image_size( 'page-banner', 952, 375, true );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	
	register_nav_menus( array(
		'main_nav' => __( 'Main Navigation', 'localize' )
	) );
	
}

endif;

function localize_widgets_init() {
    
    register_sidebar( array(
		'name' => __( 'Footer Section', 'localize' ),
		'id' => 'footer_section',
		'description' => __( 'Footer section', 'localize' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="hide">',
		'after_title' => '</h5>',
	));
}

add_action( 'widgets_init', 'localize_widgets_init' );

add_shortcode( 'base', 'base_func' );
function base_func( $atts, $content = null ) {
	return get_bloginfo('template_url');
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');
add_filter('acf_the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);

	return $content;
}

//remove_filter ('acf_the_content', 'wpautop');
remove_filter( 'acf_the_content', 'shortcode_unautop' );

add_action('init', 'cptui_register_cpt_press');
function cptui_register_cpt_press() {
    register_post_type('press', array(
        'label' => 'Press',
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'press', 'with_front' => true),
        'query_var' => true,
        'has_archive' => true,
        'supports' => array('title','editor','excerpt','custom-fields','revisions','thumbnail','author','page-attributes','post-formats'),
        'labels' => array (
          'name' => 'Press',
          'singular_name' => 'Press',
          'menu_name' => 'Press',
          'add_new' => 'Add Press Item',
          'add_new_item' => 'Add New Press Item',
          'edit' => 'Edit',
          'edit_item' => 'Edit Press',
          'new_item' => 'New Press',
          'view' => 'View Press',
          'view_item' => 'View Press',
          'search_items' => 'Search Press',
          'not_found' => 'No Press Found',
          'not_found_in_trash' => 'No Press Found in Trash',
          'parent' => 'Parent Press',
        )
    ));
}

add_action('init', 'cptui_register_cpt_video');
function cptui_register_cpt_video() {
    register_post_type('film', array(
        'label' => 'Films',
        'taxonomies' => array('category'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-format-video',
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'films', 'with_front' => true),
        'query_var' => true,
        'has_archive' => true,
        'supports' => array('title','editor','excerpt','custom-fields','revisions','thumbnail','author','page-attributes','post-formats'),
        'labels' => array (
          'name' => 'Films',
          'singular_name' => 'Film',
          'menu_name' => 'Films',
          'add_new' => 'Add Film',
          'add_new_item' => 'Add New Film',
          'edit' => 'Edit',
          'edit_item' => 'Edit Film',
          'new_item' => 'New Film',
          'view' => 'View Film',
          'view_item' => 'View Film',
          'search_items' => 'Search Film',
          'not_found' => 'No Films Found',
          'not_found_in_trash' => 'No Films Found in Trash',
          'parent' => 'Parent Film',
        )
    ));
}

function get_video_url($type, $id) {
    switch($type) {
        case 'youtube':
            $base = '//youtube.com/watch?v=';
            break;
        case 'vimeo':
            $base = '';
            break;
        default:
            $base = '';
            break;
    }

    return $base.$id;
}

//Film Shortcode
function film_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '\"\"',
			'href' => '',
            'gallery' => '',
		), $atts )
	);

    $post = get_post($id);
    $video_type = get_post_meta($post->ID, 'video_type', true);
    $video_url = get_post_meta($post->ID, 'video_url', true);
    if(empty($href)) {
       $href = get_video_url($video_type, $video_url);
    }
	// Code
//global $post;
//$category_id = get_cat_ID(.$category.);
//$posts = get_posts('numberposts='.$count.'&order=DESC&orderby=post_date&category='.$category_id.);
//$out = '';
//foreach($posts as $post):
    return '<a class="play video-'.$post->ID.'" href="'.$href.'" rel="lightbox '.$gallery.'"><span></span>'.get_the_post_thumbnail($post->ID, 'full', array('class'=>'img-responsive center-block')).'</a>';
    }
add_shortcode( 'film', 'film_shortcode' );

// Films Shortcode
function films_shortcode( $atts) {
 extract( shortcode_attrs(
     array(), $atts )
  );
}

// Add Leasing Shortcode
function leasing_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'color' => 'white',
		), $atts )
	);

	// Code
    if(get_field("leasing_info")) {
        $content = get_field("leasing_info");
    } else {
        $content = "Hello World";
    }

    return '<div class="leasing-info '.$color.'">'.$content.'</div>';
}
add_shortcode( 'leasing_info', 'leasing_shortcode' );

// Add Location Shortcode
function location_shortcode( $atts ) {
  $output = '<div class="row"><div class="col-sm-7 map-container">';

  $output .= '<img class="img-responsive map-overlay" alt="Location Map" src="'.get_field('location_map').'" />';

  $output .= '</div><div class="col-sm-5 "><div class="panel panel-default"><div class="panel-body"><div><span class="sprite sprite-compass"></span></div>';
  $location_rows = get_field("location_layers");
  $location_output = '<ul class="map-toggle">';
  $location_content = '<div class="map-content-container">';


  // Code
  if($location_rows) {
    foreach($location_rows as $index => $location_slide) {
      if(empty($location_slide["layer_href"])) {
        $location_output .= '<li><button class="btn btn-lg btn-default" data-id="'.$index.'" data-map="'.$location_slide["layer_image"].'"><img class="hidden-sm" src="'.$location_slide["layer_icon"].'"/>'.$location_slide["layer_name"].'</button></li>';
      } else {
        $location_output .= '<li><a data-id="'.$index.'" class="btn btn-lg btn-default" href="'.$location_slide["layer_href"].'" target="_blank"><img class="hidden-sm" src="'.$location_slide["layer_icon"].'"/>'.$location_slide["layer_name"].'</a></li>';
      }
      
      $location_content .= '<div class="map-content" id="map-content-'.$index.'">'.$location_slide["layer_content"].'</div>';
      $index++;
    }
  }

  $location_output .= '</ul>';
  $location_content .= '</div>';

  $output .= $location_output;
  $output .= $location_content;

  $output .= '</div></div></div></div>';

    return $output;
}
add_shortcode( 'location_map', 'location_shortcode' );

add_shortcode('gallery', 'gallery_shortcode_override');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr {
 *     Attributes of the gallery shortcode.
 *
 *     @type string $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 *     @type string $orderby    The field to use when ordering the images. Default 'menu_order ID'.
 *                              Accepts any valid SQL ORDERBY statement.
 *     @type int    $id         Post ID.
 *     @type string $itemtag    HTML tag to use for each image in the gallery.
 *                              Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
 *     @type string $icontag    HTML tag to use for each image's icon.
 *                              Default 'dt', or 'div' when the theme registers HTML5 gallery support.
 *     @type string $captiontag HTML tag to use for each image's caption.
 *                              Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
 *     @type int    $columns    Number of columns of images to display. Default 3.
 *     @type string $size       Size of the images to display. Default 'thumbnail'.
 *     @type string $ids        A comma-separated list of IDs of attachments to display. Default empty.
 *     @type string $include    A comma-separated list of IDs of attachments to include. Default empty.
 *     @type string $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
 *     @type string $link       What to link each image to. Default empty (links to the attachment page).
 *                              Accepts 'file', 'none'.
 * }
 * @return string HTML content to display gallery.
 */
function gallery_shortcode_override( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filter the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output The gallery output. Default empty.
	 * @param array  $attr   Attributes of the gallery shortcode.
	 */
	$output = apply_filters( 'post_gallery', '', $attr );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	/**
	 * Filter whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "
		<style type='text/css'>
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 20px;
                margin-bottom: 20px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filter the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        // $attr['class'] = 'img-responsive center-block';
      
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
}

?>
