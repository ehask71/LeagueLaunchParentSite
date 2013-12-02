<?php $this->Html->addCrumb('Step 1', '/registration/step1'); ?>
<?php
if (count($seasons) > 0) {
    $seasonopts = array();
    foreach ($seasons AS $s) {
	$seasonopts[$s['SeasonSaaS']['id']] = $s['SeasonSaaS']['name'];
    }
}
?>
<div class="row-fluid">
    <div class="span6 box black">
        <div class="box-header">Players</div>
        <div class="box-content">

	</div>
    </div>
    <div class="span6 box blue">
	<div class="box-header">Available Seasons</div>
	<div class="box-content">
	    <table class="table table-bordered">
	    <?php
	    if (count($seasonopts) > 0) {
		foreach ($seasonopts AS $season) {
		    ?>
		<tr>
		    <td><?php echo $season;?></td>
		</tr>
		    <?php
		}
	    }
	    ?>
	    </table>
	</div>
    </div>
</div>
<div class="row">
    <div class="span12">
	<pre>
	    <?php print_r($seasons); ?>
<?php print_r($seasonopts); ?>
	</pre>
    </div>
</div>