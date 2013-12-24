<?php $this->Html->addCrumb('Step 1', '/registration/step1'); ?>
<?php
if (count($seasons) > 0) {
    $seasonopts = array(0 => 'Choose A Season');
    foreach ($seasons AS $s) {
	$seasonopts[$s['SeasonSaaS']['id']] = $s['SeasonSaaS']['name'];
    }
}
?>
<div class="row-fluid">
    <div class="span6 box black">
        <div class="box-header">Players</div>
        <div class="box-content">
	    <?php
	    $isAlready = $this->Session->read('Registration.already_registered');
	    if (isset($isAlready)) {
		?>
    	    <p>These Players are already registered to an active League</p>
    	    <ol>
		    <?php
		    $already = $this->Session->read('Registration.already_registered');
		    foreach ($already AS $item) {
			echo '<li>' . $item . '</li>';
		    }
		    ?>
    	    </ol><br/>
		<?php
	    }
	    if (count($players) > 0) {
		?>
                <p>Use the Dropdown to select the correct season for each player. If a 
    		player is not playing this season leave the dropdown set to "Choose A Season" and they will not be added. <a href="/registration/addplayer">Click Here</a> to add more players</p>
		<?
		echo $this->Form->create(FALSE, array(
		    'type' => 'file',
		    'action' => 'step1',
		    'inputDefaults' => array(
			'div' => 'control-group',
			'label' => array(
			    'class' => 'control-label'
			),
			'wrapInput' => 'controls'
		    ),
		    'novalidate' => true,
		    'class' => 'form-horizontal'));
		foreach ($players AS $player) {
		    echo $this->Form->input('Players.' . $player['PlayersSaaS']['player_id'], array('label' => array('text' => $player['PlayersSaaS']['firstname'] . ' ' . $player['PlayersSaaS']['lastname'], 'class' => 'control-label'), 'type' => 'select', 'options' => $seasonopts));
		}
		echo $this->Form->submit('Proceed To Step 2', array('class' => 'btn btn-primary'));
		echo $this->Form->end();
	    } else {
		?>
    	    <p>It appears you do not have any players in our system or they are already registered to a League.</p>
    	    <p>Please <a href="/registration/addplayer">Click Here</a> to add a player to your account.</p>
		<?php
	    }
	    ?>
        </div>
    </div>
    <div class="span6 box blue">
        <div class="box-header">Active Leagues</div>
        <div class="box-content">
            <p>Here are our Leagues that are currently open for registration.</p>
            <table class="table table-bordered">
		<?php
		if (count($seasonopts) > 0) {
		    unset($seasonopts[0]);
		    foreach ($seasonopts AS $season) {
			?>
			<tr>
			    <td><?php echo $season; ?></td>
			</tr>
			<?php
		    }
		}
		?>
            </table>
        </div>
    </div>
</div>