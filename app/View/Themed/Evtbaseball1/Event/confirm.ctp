<div class="row" id="body-content">
    <div class="row">
        <div class="span6" >	
            <div class="row">
                <div class="span6">
                    <h2>Purchaser</h2>
                    <table class="table-condensed table table-striped">
                        <tbody>
                            <tr>
                                <td><?= $event['firstname'] . ' ' . $event['lastname']; ?></td>
                            </tr>
                            <tr>
                                <td><?= $event['address']; ?></td>
                            </tr>
                            <tr>
                                <td><?= $event['city'] . ' ' . $event['zip']; ?></td>
                            </tr>
                            <tr>
                                <td><?= $event['country']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="row">
                <div class="span6">
                    <h2>Participants</h2>
                    <table class="table-condensed table table-striped">
                        <tbody>
                            <?php
                            foreach ($event['participants'] AS $reg) {
                                if ($reg == '')
                                    continue;
                                echo '<tr>';
                                echo '<td>' . $reg . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <h2>Payment Details</h2>
            <table class="table-condensed table table-striped">
                <tbody>
                    <tr>
                        <td>Card</td>
                        <td>XXXX-XXXX-XXXX-<?= substr($event['ccnum'], -4); ?></td>
                    </tr>
                    <tr>
                        <td>Expiration</td>
                        <td><?= $event['ccmonth'] . '-' . $event['ccyear']; ?></td>
                    </tr>
                    <tr>
                        <td>Verification:</td>
                        <td><?= $event['cc_code']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="span6">
            <h2>Events</h2>
            <table class="table-condensed table table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cart['OrderItem'] AS $item) {
                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['quantity'] . '</td>';
                        echo '<td>' . $item['subtotal'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <table class="table-condensed table">
                <tbody>
                    <tr>
                        <td>Sub Total</td>
                        <td>$<?= $cart['Order']['subtotal']; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$<?= $cart['Order']['total']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>