<div class="span6" >	
    <div class="row">
        <div class="span6">
            <h2>Purchaser</h2>
            <table class="table-condensed table table-striped">
                <tbody>
                    <tr>
                        <td><?= $purchaser['firstname'] . ' ' . $puchaser['lastname']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $purchaser['address']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $purchaser['city'] . ' ' . $purchaser['zip']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $purchaser['country']; ?></td>
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
                    foreach ($participants AS $reg) {
                        echo '<tr>';
                        echo '<td>' . $purchaser['firstname'] . ' ' . $puchaser['lastname'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>