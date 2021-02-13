<?php get_header();?>

<div class="container">
<?php include('wp-menu.php');?>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<h2><?php the_title();?></h2>
						<?php
			$inscricao = get_field("link_inscricao");

			if($inscricao){
				echo '<a class="btnleiamais" href="'.get_field('link_inscricao').'">FAÇA AQUI SUA INSCRIÇÃO</a><br><br>';
			}
			?>
			<?php the_content(); ?>
			<table class="table">
				<thead>
					<th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Nome</th>
					<th class="col-lg-3 col-md-3 col-sm-3 hidden-xs">Data</th>
					<th class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Arquivo</th>
				</thead>
				
				<tbody>
					<?php while(have_rows('processo_seletivo')): the_row(); ?>
						<tr>
							<td><?php echo the_sub_field('nome');?></td>
							<td><?php echo the_sub_field('data_publicacao');?></td>
							<td><a href="<?php echo the_sub_field('arquivo');?>" target="_blank">Baixar arquivo</a></td>
						</tr>
					<? endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php get_footer();?>
