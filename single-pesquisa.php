<?php get_header(); ?>

<div class="container">
<?php include('wp-menu.php');?>

	<div class="row">
		<h1 class="tituloPag"><?php the_title(); ?></h1>
	</div>

	<table class="table">
		<thead>
			<th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Nome</th>
			<th class="col-lg-3 col-md-3 col-sm-3 hidden-xs">Data</th>
			<th class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Arquivo</th>
		</thead>
		
		<tbody>
			<?php while(have_rows('transparencia')): the_row(); ?>
					<tr>
						<td><?php echo the_sub_field('nome_arquivo');?></td>
						<td><?php echo the_sub_field('data_arquivo');?></td>
						<td><a href="<?php echo the_sub_field('arquivo');?>" target="_blank">Baixar arquivo</a></td>
					</tr>
			<? endwhile; ?>
		</tbody>
	</table>
</div>

<?php get_footer();?>