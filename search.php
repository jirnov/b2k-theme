<?php get_header(); ?>

<div id="primary" class="content-area <?php b2k_primary_grid(); ?>">
  <!-- start main -->
  <main id="main" class="site-main">
  <?php dynamic_sidebar('title-sidebar'); ?>
  <?php
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        get_template_part( 'template-parts/post', 'content' );
      }

      the_posts_pagination(array(
        'prev_next' => True,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'end_size' => 0,
        'mid_size' => 2,
        'screen_reader_text' => " "));

        echo "<!-- #pagination -->";
    }
    else {
      get_template_part('template-parts/post', 'notfound');
    }
  ?>

  </main> <!-- #main -->
</div> <!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer();

