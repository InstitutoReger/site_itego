<?php get_header();?>
<div class="container">
		<div class="row">
			<nav class="navbar navbar-page">
			<?php
			wp_nav_menu( array(
				'menu' => 'internas',
				'container' => '',
				'menu_class' => 'nav navbar-nav'
			));
			?>
			</nav>
		</div>

		<div class="row">
			<div class="tituloNoticias">
				<h1>Notícias</h1>
				<div class="buscaNoticias fr">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>

		<div class="row fix" id="conteudoInternas">
			
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
				<?php $buscaPosts = new WP_Query($args); ?>
				<?php if($buscaPosts->have_posts()) : while($buscaPosts->have_posts()): $buscaPosts->the_post();?>
					<div class="itemNoticia col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?php if ( has_post_thumbnail() ) : ?>
	        				<?php the_post_thumbnail(); ?>
						<?php endif; ?>

						<h3><?php the_title();?></h3>
						<h5><?php echo get_the_date();?></h5>
						<p><?php echo get_excerpt(); ?> ...</p>
						<a class="btn btnleiamais" href="<?=the_permalink();?>">Continuar lendo</a>
					</div>
				<?php endwhile; endif;?>
			
		</div>

		<div class="row">
			<?php wp_pagenavi(array( 'query' => $buscaPosts ) ); ?>
			<?php wp_reset_postdata(); ?>
		</div>
</div>
<?php get_footer();?>