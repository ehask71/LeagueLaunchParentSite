<?php $this->Html->addCrumb('Confirm', '/registration/confirm'); ?>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <table class="table-bordered table-condensed" width="98%">
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
                        <table class="table-striped" width="80%">
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
                        <table class="table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Player</th>
                                <th>Price</th>
                                <th>SubTotal</th>
                            </tr>
                            <?php foreach ($shop['OrderItem'] AS $item) { ?>
                                <tr>
                                    <td><?= (isset($registration['Players'][$item['player_id']]['season_name'])) ? $registration['Players'][$item['player_id']]['season_name'] : ''; ?><?= $item['name']; ?></td>
                                    <td><?= ($item['player_id'] != 0) ? $registration['Players'][$item['player_id']]['name'] : ''; ?></td>
                                    <td><?= $item['price']; ?></td>
                                    <td><?= $item['subtotal']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3">SubTotal:</td>
                                <td><?= $shop['Order']['subtotal']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">Total:</td>
                                <td><?= $shop['Order']['total']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <pre>
                <?php print_r($shop); ?>
                <?php print_r($registration); ?>
            </pre>
        </div>
    </div>
</div>