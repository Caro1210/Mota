<?php

//Add styles and scripts
function theme_enqueue_styles_and_scripts() {
    wp_enqueue_style('mota-style', get_stylesheet_directory_uri(). '/sass/style.css', array(), time());
    wp_enqueue_script('header', get_theme_file_uri(). '/js/header.js', array( 'jquery' ), true);
    wp_enqueue_script('modale', get_theme_file_uri() . '/js/modale.js', array( 'jquery' ), true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');


// Add menu to header and footer
function register_my_menu() {
    register_nav_menu( 'header-main-menu', __( 'Header' ));
    register_nav_menu( 'footer-second-menu', __( 'Footer' ));
}
add_action( 'after_setup_theme', 'register_my_menu' );
