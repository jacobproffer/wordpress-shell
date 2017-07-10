<?php

// Supports
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

// Disable the WP emojis. c'mon wordpress not cool
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Add exceprt support to pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
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
