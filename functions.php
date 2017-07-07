<?php

// MENUS!
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );

// Disable the WP emojis. c'mon wordpress not cool
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Add exceprt support to pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

// create image srcset
function srcset_get_image($imageid, $fallbacksize = 'large') {

	$sizes[] = wp_get_attachment_image_src( $imageid, 'medium');
	$sizes[] = wp_get_attachment_image_src( $imageid, 'large');
	$sizes[] = wp_get_attachment_image_src( $imageid, 'full');

	$srcset = '';

	foreach ( $sizes as $size ) :
		$srcset .= $size[0] . ' ' . $size[1] . 'w, ';
	endforeach;

	$fallback = wp_get_attachment_image_src( $imageid, $fallbacksize);

	$alt_text = get_post_meta($imageid, '_wp_attachment_image_alt', true);

	if ( !$alt_text || $alt_text == "" ) :
		$attachment = get_post($imageid);
		$alt_text = $attachment->post_title;
	endif;

	$output = '<img ';

	if ( $srcset != '' ) :
		$output .= 'srcset="' . $srcset . '" ';
	endif;

	$output .= 'src="' . $fallback[0] . '" ';
	$output .= 'alt="' . $alt_text . '">';

	return $output;

}

function srcset_the_image($imageid,$fallbacksize = 'full') {
	echo srcset_get_image($imageid,$fallbacksize);
}

function srcset_get_thumbnail($post_id, $fallbacksize = 'full') {
	$imageid = get_post_thumbnail_id( $post_id );
	if ( $imageid ) :
		return srcset_get_image($imageid,$fallbacksize);
	endif;
}

function srcset_the_thumbnail($post_id, $fallbacksize = 'full') {
	echo srcset_get_thumbnail($post_id, $fallbacksize);
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/dist/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function remove_footer_admin () {
    echo "Put some nice text here.";
}
add_filter('admin_footer_text', 'remove_footer_admin');
