<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Under
 */
  get_header();
  add_theme_support( 'post-thumbnails' );
?> 
    <?php 
      dynamic_sidebar('topo_pagina_inicial'); 
    ?>
  <main id="main" class="site-main container" role="main">

    <div class="'col-md-12'">
          <?php dynamic_sidebar('pagina_inicial'); ?>
          
    </div>


    <?php if (have_posts()) : ?>

      <?php /* Start the Loop */ ?>
      <?php while (have_posts()) : the_post(); ?>

        <?php
        /* Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        // get_template_part('content', get_post_format());
        ?>

      <?php endwhile; ?>


    <?php else : ?>

      <?php //get_template_part('content', 'none'); ?>

    <?php endif; ?>

  </main><!-- #main -->
      <div class="fundoddepoimento">
          <div class="container">
            <?php dynamic_sidebar('campo_depoimento'); ?>
          </div>
    </div>
<?php get_footer(); ?>