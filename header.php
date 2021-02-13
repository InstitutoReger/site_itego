<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172405193-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-172405193-1');
</script>



<meta name="description" content="">
<meta name="author" content="">
<?php wp_head(); ?>

<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

<!-- Custom CSS -->
<link href="<?php echo get_bloginfo('template_directory'); ?>/itego.css<? echo'?v=' . filemtime( get_stylesheet_directory() . '/itego.css');?>" rel="stylesheet" />
<link href="<?php echo get_bloginfo('template_directory'); ?>/css/menu.css<? echo'?v=' . filemtime( get_stylesheet_directory() . '/css/menu.css');?>" rel="stylesheet" />
<link href="<?php echo get_bloginfo('template_directory'); ?>/css/slider.css<? echo'?v=' . filemtime( get_stylesheet_directory() . '/css/slider.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<header class="container">
	<?php $url = home_url('/');?>
    	<div class="col-md-4 col-sm-4 col-xs-4">
    		<a href="<?php echo $url;?>" target="_self">
	    		<img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo_itego.png" />
    		</a>
    	</div>
        
        <div class="col-md-8 col-sm-8 col-xs-8 text-right">    
    			<img src="<?php echo get_bloginfo('template_directory'); ?>/img/logostopo.png" style="margin-top:60px" />
        </div>
</header>