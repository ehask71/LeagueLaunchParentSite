<?php $this->Html->addCrumb('Step 3', '/registration/step3'); ?>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <?php
            $seloption = array('no'=>'No','yes'=>'Yes');
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
                foreach($value['addons'] AS $k=>$v){
                    echo $this->Form->input('Addon.' . $v['player_id'].'_'.$k, array(
                        'label' => array('text' => $v['name'].' $'.sprintf('%01.2f', $v['price']),'class'=>'control-label'), 
                        'type' => 'select', 'options' => $seloption,
                        'after' => '<span class="help-block">'.$v['description'].'</span>'));
                }
            }
            echo $this->Form->submit('Proceed To Next Step', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
            ?>
            <pre>
                <?php print_r($players);?>
                <?php print_r($this->Session->read('Shop'));?>
            </pre>
        </div>
    </div>
</div>