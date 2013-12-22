<?php $this->Html->addCrumb('Step 3', '/registration/step3'); ?>
<div class="row-fluid">
    <div class="span6 box black">
        <div class="box-content">
            <?php
            echo $this->Form->create(NULL, array(
                'inputDefaults' => array(
                    'div' => 'control-group',
                    'label' => array(
                        'class' => 'control-label'
                    ),
                    'wrapInput' => 'controls'
                ),
                'class' => 'form-horizontal'
            ));
            ?>
            <?php echo $this->Form->input('first_name', array('value' => $userinfo['firstname'])); ?>
            <?php echo $this->Form->input('last_name', array('value' => $userinfo['lastname'])); ?>
            <?php echo $this->Form->input('email', array('value' => $userinfo['email'])); ?>
            <?php echo $this->Form->input('phone', array('value' => $userinfo['phone'])); ?>
            <?php echo $this->Form->input('billing_address', array('value' => $userinfo['address'])); ?>
            <?php echo $this->Form->input('billing_address2', array('value' => $userinfo['address2'])); ?>
            <?php echo $this->Form->input('billing_city', array('value' => $userinfo['city'])); ?>
            <?php echo $this->Form->input('billing_state', array('value' => $userinfo['state'],'type' => 'select', 'options' => Configure::read('States'))); ?>
            <?php echo $this->Form->input('billing_zip', array('value' => $userinfo['zip'])); ?>
            <?php echo $this->Form->input('billing_country', array('value' => $userinfo['country'],'type' => 'select', 'options' => Configure::read('Countries'))); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <?php $shop = $this->Session->read('Shop'); ?>
    <div class="span6 box black">
        <div class="box-header">Cart</div>
        <div class="box-content">
            Total: <?php echo sprintf('%01.2f', $shop['Order']['total']); ?><br/>
            <hr>
            <ul>
                <?php
                $shop = $this->Session->read('Shop');
                if (is_array($shop['OrderItem'])) {
                    foreach ($shop['OrderItem'] AS $k => $v) {
                        echo '<li>' . $v['name'] . '-' . $players[$v['player_id']]['name'] . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>