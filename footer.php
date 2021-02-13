        <footer class="container text-center">
		<ul class="redessociais">
            <?php
                $twitter = get_option('twitter');
                $facebook = get_option('facebook');
                $youtube = get_option('youtube');
                $instagram = get_option('instagram');
            ?>
            <?php if($instagram): ?>
                <li><a href="<?php echo $instagram; ?>"><i class="fa fa-2x fa-instagram"></i></a></li>
            <?php endif;?>

        	<?php if($facebook): ?>
                <li><a href="<?php echo $facebook; ?>"><i class="fa fa-2x fa-facebook-official"></i></a></li>
			<?php endif;?>

            <?php if($youtube): ?>
                <li><a href="<?php echo $youtube; ?>"><i class="fa fa-2x fa-youtube-square "></i></a></li>
            <?php endif;?>
            
            <?php if($twitter): ?>
                <li><a href="<?php echo $twitter; ?>"><i class="fa fa-2x fa-twitter-square"></i></a></li>
            <?php endif;?>
        </ul>
        
        <p>
            Rua Dona Josefina, 1 - Nossa Senhora de Fátima, Catalão – GO - CEP: 75.709-160<br/>
            Telefone: (64) 3443-1896
        </p>
    </footer>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/js/itego.js?v=1.3"></script>

    <?php wp_footer();?>
  </body>
</html>