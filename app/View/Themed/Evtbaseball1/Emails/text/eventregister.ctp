<?php echo $event['name']; ?> Online Registration

Thank You <?php echo $shop['Order']['firstname']; ?> <?php echo $shop['Order']['lastname']; ?> for your online registration

Please remember Lunch and water for campers will NOT be provided. We recommend bringing lots of water and a packed lunch. Concession stands will be open for business. The coaches will be available for autographs once the camp has concluded. We will have a camp party, with food provided, on the last day.


Date: <?php echo date('m-d-Y')."\r\n"; ?>
Order Id: <?php echo $shop['Order']['order_id']."\r\n"; ?>
Total: $<?php echo $shop['Order']['total']."\r\n";?>

Order Items:
<?php
if (count($shop['OrderItem']) > 0) {
    $i=1;
    foreach ($shop['OrderItem'] AS $item) {
        echo "#".$i.'     '.$item['name'] . '      Qty:'. $item['quantity'] . ' @  $'. $item['price']."\r\n";
        $i++;
    }
    echo 'Total: $'.$shop['Order']['total']."\r\n";
}
?>