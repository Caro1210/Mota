<section class="hero_header">
    <h1>Photographe event</h1>
    <?php 
        $random_image = new WP_Query(array (
            'post_type' => 'photo',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => '1'
        ));
        if ($random_image->have_posts()) {
            while ($random_image->have_posts()) {
                $random_image->the_post();
                echo '<img class="hero__background" src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">';
            }
        }
        wp_reset_postdata();
    ?> 
</section>