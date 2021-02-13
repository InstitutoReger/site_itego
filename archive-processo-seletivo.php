<?php get_header(); ?>
	<div class="container" id="conteudoInternas">
		<?php include('wp-menu.php');?>
	</div>

	<div class="container">
		<h1 class="tituloPag">Processo seletivo</h1>

		<?php $args = array('post_type' => 'processo-seletivo', 'posts_per_page'=>'-1'); ?>
		<?php $posts = new WP_Query($args); ?>
		<?php if($posts->have_posts()){?>

		<table class="table">
			<thead>
				<th class="col-lg-8 col-md-9 col-sm-7 col-xs-7">Nome</th>
				<th class="col-lg-2 col-md-3 col-sm-5 col-xs-5">Edital</th>
				<th class="col-lg-2 col-md-3 col-sm-5 col-xs-5">Inscrição</th>
			</thead>
			
			<tbody>

				<?php while($posts->have_posts()): $posts->the_post(); ?>
					<tr>
						<td><?php the_title(); ?></td>
						<td><a href="<?php the_permalink();?>">acessar </a></td>
						<td>
							<?php
								$ud = get_the_ID();


									$linkbtn = get_field('link_inscricao', $ud);

									if($linkbtn){
										
										echo '<a href="'.$linkbtn.'" target="_blank"><span class="badge badge-primary">Inscrição Online</span></a>';
									} else {
										echo '';
									}


							?>
						</td>
					</tr>
				<?php endwhile; ?>
				<?php wp_reset_postdata();?>
			</tbody>
		</table>

		<?php }else{ echo "<div class='alert alert-danger'>Não há arquivos cadastrados</div>";}?>
	</div>
<?php get_footer(); ?>