<?php get_header(); ?>
	<div class="container" id="conteudoInternas">
		<?php include('wp-menu.php');?>
	</div>

	<div class="container">
		<?php $slug = get_queried_object()->slug;?>
		<?php $name = get_queried_object()->name;?>
		<h1 class="tituloPag">Processo seletivo - <?php echo ucfirst($slug);?></h1>

		<?php 
			$args = array(
				'post_type' => 'processo-seletivo',
				'post_status' => 'publish',
				'posts_per_page'=>'10',
				'paged' => get_query_var( 'paged', 1 ),
				'tax_query' => array(
					array(
						'taxonomy' => 'tipo',
						'field'    => 'slug',
						'terms'    => $slug
					)
				)
			)
		?>

		<?php if ( isset( $_GET[ 's' ] ) && !empty( $_GET[ 's' ] ) ) $args[ 's' ] = $_GET[ 's' ]; ?>
		<?php $posts = new WP_Query($args); ?>
		<?php if($posts->have_posts()){?>

		<table class="table">
			<thead>
				<th class="col-lg-9 col-md-9 col-sm-7 col-xs-7">Nome</th>
				<th class="col-lg-3 col-md-3 col-sm-5 col-xs-5">Download</th>
			</thead>
			
			<tbody>
				<?php while($posts->have_posts()): $posts->the_post(); ?>
					<tr>
						<td><?php the_title(); ?></td>
						<td><a href="<?php the_permalink();?>">acessar </a></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

		<div class="row">
			<?php wp_pagenavi(array('query'=>$posts));?>
			<?php wp_reset_postdata();?>
		</div>

		<?php }else{ echo "<div class='alert alert-danger'>Não há arquivos cadastrados</div>";}?>
	</div>
<?php get_footer(); ?>