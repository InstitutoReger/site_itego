<?php get_header(); ?>
	<div class="container" id="conteudoInternas">
	<?php include('wp-menu.php');?>
	

		<h1 class="tituloPag">Eventos</h1>
		
		<div class="clear" style="height: 30px"></div>
		<?php $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;?>	
		<?php $args = array(
			'post_type'      => 'eventos',
			'posts_per_page' => '6',
			'paged'          => $paged,
			'meta_key'       => 'data', // campo do ACF
			'orderby'        => array('data' =>'ASC') // ordenação do campo
			); ?>
				
		<?php $posts = new WP_Query($args); ?>
		<?php if($posts->have_posts()){?>

		<div class="row fix">
			<?php while($posts->have_posts()): $posts->the_post(); ?>
				<div class="col-lg-4 col-md-4 col-sm-2 col-xs-12 itemEventos">
					
						<div class="infoEventos">
							<a href="<?php the_permalink();?>"><h2><?php the_title();?></h2></a>
							<h4><?php the_field('data');?></h4>
						</div>

						<div class="imgEvento">
							<a href="<?php the_permalink();?>"><img src="<?php the_field('imagem');?>"></a>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
		</div>
		
		<?php } else {echo "<div class='alert alert-danger'>Não há eventos cadastrados</div>";}?>

		<div class="row">
			<?php wp_pagenavi(array('query'=>$posts));?>
		</div>
		
		<?php wp_reset_postdata();?>
	</div>
<?php get_footer(); ?>