<?php get_header(); ?>

<div class="container" id="conteudoPagina">
	<?php include('wp-menu.php');?>
	<?php the_content(); ?>
</div>

<div class="container" id="conteudoPagina">
	<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args  = array(
		'post_type'           => 'post',
		'posts_per_page'      => get_option('posts_per_page'),
		'paged'               => $paged,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'order'               => 'DESC',
		'orderby'             => 'date'
	);

	if ( isset( $_GET[ 's' ] ) && !empty( $_GET[ 's' ] ) )
		$args[ 's' ] = $_GET[ 's' ];
	?>

	<ul class="listaNoticias">
	<?php $buscaPosts = new WP_Query($args); ?>
	<?php
		if($buscaPosts->have_posts()) {
			while($buscaPosts->have_posts()): $buscaPosts->the_post();?>
				<li>
					<a href="<?php echo the_permalink();?>"><h4 class="vermelho"><?php the_title();?></h4></a>
					<h5><?php echo get_the_date();?></h5>
				</li>
			<?php endwhile;
		} else {
			echo '<div class="alert alert-danger">Não há notícias cadastradas!</div>';
		}
	?>
	</ul>

	<?php wp_pagenavi(array( 'query' => $buscaPosts ) ); ?>
	<?php wp_reset_postdata();?>

</div>
<?php get_footer(); ?>