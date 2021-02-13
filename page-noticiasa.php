<?php get_header();?>
<div class="container">
<?php include('wp-menu.php');?>

		<div class="row">
			<div class="tituloNoticias">
				<h1>Notícias</h1>
				<div class="buscaNoticias fr">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>

		<div class="row fix" id="conteudoInternas">
			<?php echo do_shortcode('[custom-facebook-feed]');?>
		</div>
</div>
<?php get_footer();?>