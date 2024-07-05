<?php

function theme_enqueue_styles_and_scripts() {
    // Ajouter les styles et scripts du thème
    wp_enqueue_style('mota-style', get_stylesheet_directory_uri(). '/sass/style.css', array(), time());
    
    // Ajouter Select2 CSS et JS
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);

    // Ajouter les scripts du thème
    wp_enqueue_script('header', get_theme_file_uri(). '/js/header.js', array('jquery'), true);
    wp_enqueue_script('modale', get_theme_file_uri(). '/js/modale.js', array('jquery'), true);
    wp_enqueue_script('custom-select', get_theme_file_uri() . '/js/custom-select.js', array('jquery', 'select2-js'), true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');

// Add menu to header and footer
function register_my_menu() {
    register_nav_menu('header-main-menu', __( 'Header' ));
    register_nav_menu('footer-second-menu', __( 'Footer' ));
}
add_action('after_setup_theme', 'register_my_menu');

// posts & photos
function theme_support_post_thumbnails() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_support_post_thumbnails');

// show taxonomy
function afficherTaxonomies($nomTaxonomie) {
    $terms = get_terms(array('taxonomy' => $nomTaxonomie, 'orderby' => 'name'));
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
        }
    }
}

// AJAX filter function
function filter() {
    $tax_query = array();

    if ($_POST['categorieSelection'] != 'all') {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorieSelection'],
        );
    }

    if ($_POST['formatSelection'] != 'all') {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['formatSelection'],
        );
    }

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
    );

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $requeteAjax = new WP_Query($args);

    if ($requeteAjax->have_posts()) {
        while ($requeteAjax->have_posts()) {
            $requeteAjax->the_post();
            echo '<div>' . get_the_title() . '</div>';
        }
        wp_reset_postdata();
    } else {
        echo '<div>No posts found</div>';
    }
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');

?>
