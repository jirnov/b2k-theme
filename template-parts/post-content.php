<article id="post-<?php the_ID(); ?>" <?php post_class("hentry"); ?>>
  <!-- begin entry-header -->
  <header class="entry-header">
		<?php 
		if (is_singular()) {
			the_title('<h1 class="entry-title">', '</h1>'); 
		}
		else {
			the_title('<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>');
		}
?>

  </header> 
  <!-- end entry-header -->

  <!-- begin entry-meta --> 
	<div class="entry-meta">
    <time class="updated" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time>
    <?php b2k_print_view_counter(); ?>
    <?php b2k_tags() ?>

  </div> 
  <!-- end entry-meta -->

  <!-- begin entry-content -->
  <div class="entry-content">
      <?php the_content(); ?>
      <?php wp_link_pages(); ?>
  </div> 
  <!-- end entry-content -->
</article> <!-- #post-## -->

