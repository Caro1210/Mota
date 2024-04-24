<?php
/**
 * The template for displaying all pages
 *
 * @package Mota
 * @since 1.0.0
 */

 get_header(); ?>
<main id="primary" class="site-main page">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="post">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
  </main>
<?php get_footer(); ?>