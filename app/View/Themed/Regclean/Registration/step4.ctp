<?php $this->Html->addCrumb('Step 3', '/registration/step3'); ?>
<div class="row-fluid">
    <div class="span6 box black">
        <div class="box-content">
            
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