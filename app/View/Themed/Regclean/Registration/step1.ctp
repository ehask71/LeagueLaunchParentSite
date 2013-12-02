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
	    <?php if(count($players)>0){
		
	    } else {
		?>
	    <p>It appears you do not have any players in our system.</p>
	    <p>Please <a href="/registration/addplayer">Click Here</a> to add a player to your account.</p>
		<?php
	    }
	    ?>
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
<?php print_r($players); ?>
<?php			print_r($this->Session->read('Auth.User'));?>
	</pre>
    </div>
</div>