<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'vue_photo'));

        $type = get_field('type');
        $reference = get_field('reference');

        $annee = get_the_term_list(get_the_ID(), 'annee');

        $categorie = get_the_terms(get_the_ID(), 'categorie');
        $categorie_slug = '';
        $categorie_name = '';
        if ($categorie && !is_wp_error($categorie)) {
            $categorie_slug = $categorie[0]->slug;
            $categorie_name = $categorie[0]->name;
        }

        $format = get_the_term_list(get_the_ID(), 'format');

        echo '<div class="photo-box">';
        
        echo '<div class="photo-info">';
        echo '<h2>' . get_the_title() . '</h2>';

        echo '<p>Type de photo : ' . $type . '</p>';
        echo '<p>Référence : ' . $reference . '</p>';

        if (!empty($annee)) {
            echo '<p>Année(s) : ' . $annee . '</p>';
        }

        if (!empty($categorie)) {
            echo '<p>Catégorie(s) : ' . get_the_term_list(get_the_ID(), 'categorie') . '</p>';
        }

        if (!empty($format)) {
            echo '<p>Format(s) : ' . $format . '</p>';
        }

        the_content();

        echo '</div>';

        echo '<div class="photo_inside">';
        if (!empty($image)) {
            echo '<a href="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" data-lightbox="image-1" data-title="' . get_the_title() . '">' . $image . '</a>';
        }
        echo '</div>';
        echo '</div>'; // End of photo-box
    }
}
?>

<?php
$post_thumbnail_id = get_post_thumbnail_id();
$reference = get_field('ref', $post_thumbnail_id); 
echo '<div style="display: none;">';
echo 'Référence de la photo : ' . $reference;
echo '</div>';
echo '<div class="contact_inside">';
echo '<p>Cette photo vous intéresse ?</p>';
?>

<?php
$reference = get_field('reference');
?>

<div class="modal_button" id="openModalButton" data-ref-photo="<?php echo esc_attr($reference); ?>">
    <a>Contact</a>
</div>

<!-- Include the existing modal structure -->
<div id="overlay" class="single-photo">

<div id="contact_modale" class="modale_contact single-photo">
    <div class="modale_content2"> 
        <img src="<?php echo get_template_directory_uri() . "/images/Contact.png" ?>" alt="titre de formulaire de contact">
        <?php echo do_shortcode('[contact-form-7 id="adecfda" title="Modale"]'); ?>
    </div>
</div>
</div>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
$current_category = get_the_terms(get_the_ID(), 'categorie');
$current_category_slug = '';
if ($current_category && !is_wp_error($current_category)) {
    foreach ($current_category as $category) {
        $current_category_slug = $category->slug;
        break;
    }
}
?>

<div class="small_img">
    <?php
    $prev_post_query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $current_category_slug,
            ),
        ),
    ));

    $next_post_query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC',
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $current_category_slug,
            ),
        ),
    ));
    ?>
</div>

<?php
echo '<div class="nav-links">';
if ($prev_post_query->have_posts()) {
    while ($prev_post_query->have_posts()) {
        $prev_post_query->the_post();
        $prev_post_thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
        echo '<div class="prev-post">';
        echo '<a href="' . get_permalink() . '">←</a>';
        echo '<div class="prev-post-preview">' . $prev_post_thumbnail . '</div>';
        echo '</div>';
    }
    wp_reset_postdata();
}
if ($next_post_query->have_posts()) {
    while ($next_post_query->have_posts()) {
        $next_post_query->the_post();
        $next_post_thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
        echo '<div class="next-post">';
        echo '<a href="' . get_permalink() . '">→</a>';
        echo '<div class="next-post-preview">' . $next_post_thumbnail . '</div>';
        echo '</div>';
    }
    wp_reset_postdata();
}
echo '</div>';
?>

<?php
echo '<div class="like_too_container">';
echo '<div class="decorative-line"></div>';
echo '<div class="like_too">';
echo '<p>VOUS AIMEREZ AUSSI</p>';
echo '</div>';
?>

<div class="galerie_photo">
    <div id="photo-container">
        <?php
        // Arguments pour la requête WP_Query
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => 2,
            'order'          => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'slug',
                    'terms'    => $current_category_slug,
                ),
            ),
        );

        // Exécutez la requête (no repetition function ^^)
        $photo_block = new WP_Query($args);

        if ($photo_block->have_posts()) {
            while ($photo_block->have_posts()) {
                $photo_block->the_post();
                afficher_image_galerie(get_the_ID());
            }
            // Restaurez les données du post original
            wp_reset_postdata();
        } else {
            echo '<p>Aucune photo trouvée dans cette catégorie.</p>';
        }
        ?>
    </div>
</div>

<?php
get_footer();
?>
