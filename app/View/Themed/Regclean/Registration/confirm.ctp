<?php $this->Html->addCrumb('Confirm', '/registration/confirm'); ?>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <table class="table-bordered table-condensed" width="98%" align="center">
                <tr>
                    <td width="49%">
                        <h3>Customer Info</h3>
                        <table class="table-striped">
                            <tr>
                                <td><?php echo $shop['Order']['first_name'] . ' ' . $shop['Order']['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_address']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_address2']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_city'] . ', ' . $shop['Order']['billing_state']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_country']; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <h3>Billing Info</h3>
                        <table class="table-striped">
                            <tr>
                                <td><?php echo $shop['Order']['first_name'] . ' ' . $shop['Order']['last_name']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_address']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_address2']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_city'] . ', ' . $shop['Order']['billing_state']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $shop['Order']['billing_country']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Registration Items</h3>
                        <table class="table-striped" width="98%" align="center">
                            <tr>
                                <th>Name</th>
                                <th>Player</th>
                                <th>Price</th>
                                <th>SubTotal</th>
                            </tr>
                            <?php foreach ($shop['OrderItem'] AS $item) { ?>
                                <tr>
                                    <td><?= (isset($registration['Players'][$item['player_id']]['season_name'])) ? $registration['Players'][$item['player_id']]['season_name'].' ' : ''; ?><?= $item['name']; ?></td>
                                    <td><?= ($item['player_id'] != 0) ? $registration['Players'][$item['player_id']]['name'] : ''; ?></td>
                                    <td><?= $item['price']; ?></td>
                                    <td><?= $item['subtotal']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" style="text-align: right;">SubTotal:</td>
                                <td><?= $shop['Order']['subtotal']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;"><?=(isset($promocode))?$promocode:'';?> Promo:</td>
                                <td><?=(isset($promodiscount))?$promodiscount:'0.00'?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;">Total:</td>
                                <td><?= $shop['Order']['total']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <?php
            echo $this->Form->create(NULL, array(
                'novalidate' => true,
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
            <?php echo $this->Form->input('ccnum',array('label' => array('text'=>'Card Number','class'=>'control-label')));?>
            <?php echo $this->Form->input('ccexp',array('label' => array('text'=>'Card Expiration','class'=>'control-label')));?>
            <?php echo $this->Form->input('ccexp',array('label' => array('text'=>'Card CVV','class'=>'control-label')));?>
            <?php echo $this->Form->submit('Pay', array('class' => 'btn btn-primary'));?>
            <?php echo $this->Form->end();?>
        </div>  
    </div>
</div>