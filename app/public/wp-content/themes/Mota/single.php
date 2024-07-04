<?php
/**
 * The template for displaying all single posts
 *
 * @package Mota
 * @since 1.0.0
 */

 get_header(); ?>

<?php get_template_part( 'single-photos' ); ?>

<div class="single-post">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="post-thumbnail">
            <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('large');
            } ?>
        </div>
        <div class="post-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
