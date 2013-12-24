<?php $this->Html->addCrumb('Step 3', '/registration/step3'); ?>
<div class="row-fluid">
    <div class="span6 box black">
        <div class="box-content">
            <?php
            $seloption = array('no'=>'No','yes'=>'Yes');
            echo '<p>' . __('Here are some Addons to your registration. If you are not interested in purchasing Addons please leave the dropdown set to "No"') . '</p>';
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
                echo '<fieldset>';
                echo '<legend>'.$value['name'].'</legend>';
                foreach($value['addons'] AS $k=>$v){
                    echo $this->Form->input('Addon.' . $value['player_id'].'_'.$k, array(
                        'label' => array('text' => $v['name'].' $'.sprintf('%01.2f', $v['price']),'class'=>'control-label'), 
                        'type' => 'select', 'options' => $seloption,
                        'after' => '<span class="help-block">'.$v['description'].'</span>'));
                }
                echo '</fieldset>';
            }
            echo $this->Form->submit('Proceed To Next Step', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
            ?>
        </div>
    </div>
    <?php $shop = $this->Session->read('Shop');?>
    <div class="span6 box black">
        <div class="box-header">Cart</div>
        <div class="box-content">
            Total: <?php echo sprintf('%01.2f', $shop['Order']['total']);?><br/>
            <hr>
            <ul>
            <?php
            $shop = $this->Session->read('Shop');
            if(is_array($shop['OrderItem'])){
                foreach ($shop['OrderItem'] AS $k => $v){
                    echo '<li>'.$v['name'].'-'.$players[$v['player_id']]['name'].'</li>';
                }
            }
            ?>
            </ul>
        </div>
    </div>
</div>