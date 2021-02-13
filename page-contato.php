<?php
// Template Name: Contato

$endereco = get_field('endereco');
$telefone = get_field('telefone');
$email    = get_field('email');
$email2   = 'itego-labibefaiad@sed.go.gov.br';
$id_frm   = get_field('id_formulario');
?>

<?php get_header(); ?>

	<div class="container" id="conteudoInternas">
	<?php include('wp-menu.php');?>

		<div class="row">

			<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
				<?php echo do_shortcode('[contact-form-7 id="'.$id_frm.'" title="Formulário de contato"]');?>
			</div>

			<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
				<ul class="infCtt">
					<li><?php echo '<i class="fa iconeCtt fa-map-marker"></i> '.$endereco;?></li>
					<li><?php echo '<i class="fa iconeCtt fa-phone"></i> '.$telefone;?></li>
					<li><?php echo '<i class="fa iconeCtt fa-envelope"></i> '.$email;?></li>
					<li><?php echo '<i class="fa iconeCtt fa-envelope"></i> '.$email2;?></li>
				</ul>

				<?php echo get_field('mapa');?>
			</div>
		</div>

	</div>

<?php get_footer(); ?>