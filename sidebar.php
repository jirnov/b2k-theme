<?php
if (!is_active_sidebar('right-sidebar')) {
    return;
}
?>
<aside id="secondary" class="widget-area <?php b2k_secondary_grid(); ?>">
	<div id="search_widget" class="widget">
		<div class="widget-title"><?php esc_html_e('Site search', 'b2k')?></div>
		<div class="widget-body">
			<form method="get" id="searchform" action="<?php echo esc_url(home_url())?>/">
				<input type="text" value="" name="s" id="search_input" onfocus="this.value='';" placeholder="<?php esc_attr_e('Input search string here and press Enter', 'b2k'); ?>" />
			</form>
		</div>
	</div>
	<!-- #search_widget -->
		                                
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</aside> <!-- #secondary -->
