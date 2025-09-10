<?php get_header(); ?>

<div class="wrap grid">
	<div id="primary" class="content-area <?php b2k_primary_grid(); ?>">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) : 
				the_post();
				get_template_part( 'template-parts/post', 'content' );
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
