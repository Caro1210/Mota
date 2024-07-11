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
    wp_enqueue_script('filters', get_theme_file_uri() . '/js/filters.js', array('jquery'), true);
    //wp_enqueue_script('load-more', get_theme_file_uri() . '/js/load-more.js', array('jquery'), true);
    wp_enqueue_script('modale2', get_theme_file_uri() . '/js/modale2.js', array('jquery'), true);
    wp_enqueue_script('lightbox', get_theme_file_uri() . '/js/lightbox.js', array('jquery'), true);
    

    // Ajouter wp_localize_script pour passer l'URL d'admin AJAX à JavaScript
    wp_localize_script('filters', 'load_more_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_nonce')
    ));
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

//show img
function afficherImages($query, $reset_postdata = true) {
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // URL photo
            $photoUrl = get_post_meta(get_the_ID(), 'photo', true);
            $photo_titre = get_the_title();
            $post_url = get_permalink();
            $reference = get_field('reference');
            $categorie = get_the_terms(get_the_ID(), 'categorie');
            $categorie_name = '';

            if ($categorie && !is_wp_error($categorie) && !empty($categorie)) {
                $categorie_name = $categorie[0]->name;
            }
            ?>

            <div class="blockPhoto">
                <?php if ($photoUrl) : ?>
                    <img src="<?php echo esc_url($photoUrl); ?>" alt="<?php the_title_attribute(); ?>">
                <?php else : ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>

                <div class="overlay">
                    <?php if ($reference) : ?>
                        <h2><?php echo esc_html($reference); ?></h2>
                    <?php endif; ?>

                    <?php if ($categorie_name) : ?>
                        <h3><?php echo esc_html($categorie_name); ?></h3>
                    <?php endif; ?>

                    <div class="eye-icon">
                        <a href="<?php echo esc_url($post_url); ?>">
                            <img src="<?php echo get_template_directory_uri() . '/images/eye.png'; ?>" alt="voir la photo">
                        </a>
                    </div>

                    <?php if ($reference) : ?>
                    <div class="fullscreen-icon" data-full="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
                        <?php echo '<script>console.log("Data URL: ' . esc_attr($photoUrl) . '")</script>'; ?>
                        <img class="fullscreen" src="<?php echo get_template_directory_uri() . '/images/icon_fullscreen.png'; ?>" alt="Plein écran">
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
        }

        if ($reset_postdata) {
            wp_reset_postdata();
        }
    } else {
        echo 'Aucune photo trouvée.';
    }
}

// Fonction pour filtrer les photos
function filter_photos() {
    if (!check_ajax_referer('load_more_nonce', 'nonce', false)) {
        wp_send_json_error('Nonce verification failed.');
        die();
    }

    $categorie = isset($_POST['categorie']) && $_POST['categorie'] !== 'all' ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) && $_POST['format'] !== 'all' ? sanitize_text_field($_POST['format']) : '';
    $order = isset($_POST['annee']) && $_POST['annee'] === 'date_asc' ? 'ASC' : 'DESC';
    
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'order' => $order,
    );

    if ($categorie) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $photo_block = new WP_Query($args);

    if ($photo_block->have_posts()) :
        ob_start();
        afficherImages($photo_block, false);
        $response = array(
            'success' => true,
            'data' => ob_get_clean(),
        );
    else :
        $response = array(
            'success' => false,
            'data' => '<p>Aucune photo trouvée.</p>',
        );
    endif;

    wp_send_json($response);
}
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

// Fonction pour charger plus de photos
function load_more_photos() {
    if (!check_ajax_referer('load_more_nonce', 'nonce', false)) {
        wp_send_json_error('Nonce verification failed.');
        die();
    }

    $paged = $_POST['page'] + 1;

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'order'          => 'ASC',
    );
    $photo_block = new WP_Query($args);

    if ($photo_block->have_posts()) :
        ob_start();
        afficherImages($photo_block, false);
        $data = ob_get_clean();
        wp_send_json_success($data);
    else :
        wp_send_json_error();
    endif;
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
