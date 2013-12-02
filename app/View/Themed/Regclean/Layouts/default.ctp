<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title><?php echo Configure::read('Sitename'); ?></title>
        <meta name="description" content="">
        <meta name="author" content="High Octane Brands">
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
	//echo $this->Html->css('style-responsive');
	echo $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext');
	?>
        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<?php echo $this->Html->css('css/ie'); ?>
        <![endif] -->
        <!--[if IE 9]>
	<?php echo $this->Html->css('ie9'); ?>
        <![endif]-->
        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->
    </head>
    <body>
        <div class="container">
            <div class="row">
		<noscript>
                <div class="alert alert-block span12">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>
		<div id="content" class="span12">
		    <div class="row">
			<div class="span12"> 
			<?php
			echo $this->Html->getCrumbList(array('class' => 'breadcrumb', 'separator' => '<i class="icon-angle-right"></i>'), array(
			    'text' => '<i class="icon-home"></i>
                            <a href="/registration/">Home</a>',
			    'url' => '/registration/',
			    'escape' => false
			));
			?>
			</div>
		    </div>
		    <?php echo $this->Session->flash(); ?>
		    <?php echo $this->Session->flash('auth'); ?>
		    <?php echo $this->fetch('content'); ?>
		</div>
            </div>
        </div>
	<?php
	echo $this->Html->script('jquery-1.9.1.min');
	echo $this->Html->script('jquery-migrate-1.0.0.min');
	echo $this->Html->script('jquery-ui-1.10.0.custom.min');
	echo $this->Html->script('jquery.ui.touch-punch');
	echo $this->Html->script('modernizr');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('custom');
	echo $this->fetch('script');
	?>
    </body>
</html>