<?php $this->Html->addCrumb('Step 2', '/registration/step2'); ?>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <?php
            echo '<p>' . __('Select the Registration Option for each player. If a Player is not being registered leave them with "Please Select An Option"') . '</p>';
            echo $this->Form->create(FALSE, array(
		'inputDefaults' => array(
		    'div' => 'control-group',
		    'label' => array(
			'class' => 'control-label'
		    ),
		    'wrapInput' => 'controls'
		),
		'novalidate' => true,
		'class' => 'form-horizontal'
	    ));
            foreach ($players as $key => $value) {
                echo $this->Form->input('Players.' . $value['player_id'], array('label' => array('text' => $value['name'].' ('.$value['league_age'].')','class'=>'control-label'), 'type' => 'select', 'options' => $value['registration_options']));
            }
            echo $this->Form->submit('Proceed To Next Step', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>