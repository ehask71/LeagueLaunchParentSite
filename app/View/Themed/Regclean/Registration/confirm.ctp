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
<form action="/registration/addpromo" method="post">
<div class="row-fluid">
    <div class="span8" style="text-align: right;">Promo Code:</div>
    <div class="span4"><input type="text" name="promocode"><input type="submit" name="promo" value="Add" class="btn btn-primary"></div>
</div>
</form>