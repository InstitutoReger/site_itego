<?php get_header();?>

<div class="container">
<?php include('wp-menu.php');?>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php if( have_posts() ) : while( have_posts() ) : the_post();?>

			<h2><?php the_title();?></h2>
			<h4><?php echo get_the_date();?></h4>
			<div class="fbLikeBtn">
				<iframe src="https://www.facebook.com/plugins/like.php?href=<?=the_permalink();?>&width=450&layout=standard&action=like&size=small&show_faces=false&share=true&height=35&appId" width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
			
			<?php the_content();?>

			<?php if(comments_open() || get_comments_number() ):?>
				<div class="comentariosNoticia">
					<?php comments_template();?>
				</div>
			<?php endif;?>

		<?php endwhile; endif;?>
	</div>
</div>
<?php get_footer();?>
