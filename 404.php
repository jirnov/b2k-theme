<?php get_header(); ?>
<?php if (!is_404()) { return; } ?>

<div id="primary" class="content-area <?php b2k_primary_grid(); ?>">
	<main id="main" class="site-main">

		<article <?php post_class("hentry"); ?>>
		        <header class="entry-header">
		                <h1>Извините - страница не найдена</h1>
		        </header> <!-- .entry-header -->

		        <div class="entry-content">
        <p>Извините, такая страница не найдена или была удалена.</p>
        <p>Возможно, вас заинтересует одна из популярных страниц моего блога:</p>
        <?php echo do_shortcode('[tptn_list heading=0 title_length=0]'); ?>
        <p>Или воспользуйтесь строкой поиска.</p>
        <p>Если вы считаете, что это какая-то ошибка, напишите о проблеме на <a href="mailto:evgeny@blog2k.ru">почту</a>.</p>
				<p style="text-align:center"><a href="https://blog2k.ru">вернуться на главную страницу блога</a></p>
		        </div> <!-- .entry-content -->
		</article> <!-- #post-## -->
	</main> <!-- #main -->
</div> <!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer();
