<?php
/**
 * The template for displaying all single posts
 *
 * @package Mota
 * @since 1.0.0
 */

 get_header(); ?>

<?php get_template_part(" '/templates_parts/single_photo' ");?>

<main id="primary" class="site-main single">
   <?php if (have_posts()) : ?>
	 <?php while (have_posts()) : the_post(); ?>
	   <div class="post">
		 <h1 class="post-title"><?php the_title(); ?></h1>
		 <p class="post-info">
		   Publié le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
		 </p>
		 <div class="post-content">
		   <?php the_content(); ?>
		 </div>
	   </div>
	 <?php endwhile; ?>
   <?php endif; ?>
 </main><!-- #main -->

 
 <?php get_footer(); ?>
