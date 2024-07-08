<?php
get_header(); ?>



<div id="photo-container">
    <?php
    $args = array(
        'post_type'      => 'photo', 
        'posts_per_page' => 8,
        'order'          => 'ASC',
    );
    $photo_block = new WP_Query($args);
    afficherImages($photo_block);
    ?>
</div>

<div id="load-moreContainer">
    <button id="btnLoad-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
</div>

<?php get_footer(); ?>
