<?php echo $event['name']; ?> Online Registration


Date: <?php echo date('m-d-Y')."\r\n"; ?>
Order Id: <?php echo $shop['Order']['order_id']."\r\n"; ?>
Total: $<?php echo $shop['Order']['total']."\r\n";?>

Order Items:
<?php
if (count($participants) > 0) {
    $i=1;
    foreach ($data['Order']['participants'] AS $item) {
        echo "#".$i.'     '.$item['name'] . "\r\n";
        $i++;
    }
}

if (count($shop['OrderItem']) > 0) {
    $i=1;
    foreach ($shop['OrderItem'] AS $item) {
        echo "#".$i.'     '.$item['name'] . '      Qty:'. $item['quantity'] . ' @  $'. $item['price']."\r\n";
        $i++;
    }
    echo 'Total: $'.$shop['Order']['total']."\r\n";
}
?>