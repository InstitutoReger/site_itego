<?php get_header(); ?>

	<div class="container">
		<div class="row">
			
            <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
			<? $qtyBanners = count( get_field('home') );?>
    	        <!-- Indicators -->
				<ol class="carousel-indicators">
                	<? for($i=0; $i<$qtyBanners;$i++){?>
                    <li data-target="#slider" data-slide-to="<?=$i;?>" <? if($i == 0) { echo 'class="active"'; }?>></li>
                    <? } ?>
				</ol>

				<!-- Wrapper for slides -->

				<div class="carousel-inner" role="listbox">

					<? if( have_rows('home') ): ?>
                        <? $count = 0; ?>
                        <? while( have_rows('home') ): the_row(); ?>
                            <div class="item <? if ($count == 0) { echo "active";}?>" style="background:url(<?php the_sub_field('banners');?>) no-repeat center center; width:100%; height:410px"></div>
							<? $count++; ?>
                        <? endwhile;?>
                    <? endif;?>

				</div>
			</div>
        	<?php
            wp_nav_menu( array(
                'menu' => 'principal',
        		'container' => ''
            ) );
        	?>
        </div>
	</div>

    

    

    <div class="container destaquesInicial">

		<h3><? the_field('txtdestaque');?></h3>

   		<a class="btn" href="<? the_field('linktxtdestaque');?>">CLIQUE AQUI</a>

    </div>

    

    <div class="container boxDestaques text-center">

		<? if(have_rows('boxdestaques')) :?>

			<ul>

				<? while( have_rows('boxdestaques')) : the_row();?>

					<li class="col-md-3 col-sm-3 col-xs-12">

                       	<img src="<? the_sub_field('imagem');?>" />

                    	<a class="btn" href="<? the_sub_field('link');?>"><? the_sub_field('texto');?></a>

                    </li>

                <? endwhile; ?>

            </ul>

        <? endif; ?>

    </div>

<?php get_footer(); ?>   