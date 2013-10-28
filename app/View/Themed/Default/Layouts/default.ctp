<!DOCTYPE html>
<html lang="en">
    <head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>League Launch .::. Sports League Management .::.</title>
	<meta name="description" content="League Launch is a Sports League Management solutions provider">
	<meta name="author" content="High Octane Brands LLC">
	<meta name="keyword" content="">
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<?php
	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('bootstrap-responsive.min');
	echo $this->Html->css('style');
	echo $this->Html->css('style-responsive');

	echo $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext');
	?>
	<!-- end: CSS -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<?php echo $this->Html->script('//html5shim.googlecode.com/svn/trunk/html5.js'); ?>
	<?php echo $this->Html->css('ie'); ?>
	<![endif]-->

	<!--[if IE 9]>
	<?php echo $this->Html->css('ie9'); ?>
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->




    </head>

    <body>
	<? echo $this->fetch('header'); ?>
	<? echo $this->fetch('navigation'); ?>
	<div class="container-fluid-full">
	    <div class="row-fluid">
		<div class="non-fluid">
		    <?php echo $this->Session->flash(); ?>
		    <?php echo $this->fetch('content'); ?>    
		</div>
	    </div>
	</div>
	<?php echo $this->fetch('footer'); ?>
	<div class="clearfix"></div>

	<footer>
	    <p>
		<span style="text-align:left;float:left">&copy; <a href="" target="_blank">High Octane Brands LLC</a> 2013</span>
		<span class="hidden-phone" style="text-align:right;float:right">Powered by: <a href="#">LeagueLaunch</a></span>
	    </p>

	</footer>
	<?php
	echo $this->Html->script('bootstrap.min');
	?>
	<?php echo $this->fetch('scriptBottom'); ?>
        <script type="text/javascript">
	    var _gaq = _gaq || [];
	    _gaq.push(['_setAccount', 'UA-42932858-1']);
	    _gaq.push(['_setDomainName', '<?php echo $_SERVER['SERVER_NAME']; ?>']);
	    _gaq.push(['_setAllowLinker', true]);
	    _gaq.push(['_trackPageview']);

	    (function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
			'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	    })();

        </script>
    </body> 
</html>