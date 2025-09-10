<?php get_header(); ?>

<!-- start primary -->
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
    }
	?>

  <!-- start pagination -->
	<?php
		$nav = get_the_posts_pagination(array(
		        'prev_next' => True,
		        'prev_text' => '&laquo;',
		        'next_text' => '&raquo;',
		        'end_size' => 0,
		        'mid_size' => 2,
				'screen_reader_text' => 'A'));
		$nav = str_replace('<h2 class="screen-reader-text">A</h2>', '', $nav);
		echo $nav;
	?>
	<!-- end pagination -->

  </main> 
  <!-- end main -->
</div> 
<!-- end primary -->

<?php get_sidebar(); ?>

<?php get_footer();
