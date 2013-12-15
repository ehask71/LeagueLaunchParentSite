<!DOCTYPE html>
<html lang="en">
<head>
<title>Professional Camps </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php 
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('style');
	echo $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:400,700');
    ?>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="span6" id="masthead">
		    <a href="/event/<?php echo $slug;?>" title="Back to Home Page"><?php echo $this->Html->image('logon-png.png',array('width'=>"523",'height'=>"66"));?></a>
		</div>
		<div class="span6">
		
		</div>
	</div>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>  
	<div class="row" id="footer">
		<div class="span12">
			<div id="disclaimer">
				<p>Lunch and water for campers will <strong>NOT</strong> be provided. We recommend bringing lots of water and a packed lunch. Concession stands will be open for business. The coaches will be available for autographs once the camp has concluded.</p> 
				<p>We will have a camp party, with food provided, on the last day.</p>
			</div>
		</div>
	</div>
</div>
<?php
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    echo $this->Html->script('bootstrap');
?>
</body>
</html>
