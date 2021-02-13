<?php get_header(); ?>

	<div class="container" id="conteudoInternas">
	<?php include('wp-menu.php');?>

		<div class="row">

			<? if (have_posts()){ the_post(); ?>
				<div class="conteudoPaginas">
					<h2><?php the_title() ?></h2>
					<?php the_content();?>
				</div>
			<?php }	?>
		</div>
	</div>
<?php get_footer(); ?>