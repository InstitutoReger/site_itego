<?php get_header(); ?>

<div class="container" id="conteudoInternas">
<?php include('wp-menu.php');?>

	<div class="row tituloEvento">
		<h1 class="tituloPag"><?php the_title(); ?></h1>
		<h4><?php the_field('data');?></h4>
	</div>

	<div class="row">
		<?php if(have_posts()) : while(have_posts()): the_post();?>
			<div class="conteudoEventos">
			<img src="<?php the_field('imagem');?>" class="fl imagemEvento" />			
			<?php the_content();?>
			</div>
		<?php endwhile; endif;?>
	</div>
</div>

<?php get_footer();?>