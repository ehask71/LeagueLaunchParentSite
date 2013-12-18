<?php echo $event['name']; ?> Online Registration


Date: <?php echo date('m-d-Y')."\r\n"; ?>
Order Id: <?php echo $data['Order']['order_id']."\r\n"; ?>
Total: $<?php echo $data['Order']['total']."\r\n";?>

Order Items:
<?php
if (count($participants) > 0) {
    $i=1;
    foreach ($participants AS $item) {
        echo "#".$i.'     '.$item['name'] . "\r\n";
        $i++;
    }
}

if (count($data['OrderItem']) > 0) {
    $i=1;
    foreach ($data['OrderItem'] AS $item) {
        echo "#".$i.'     '.$item['name'] . '      Qty:'. $item['quantity'] . ' @  $'. $item['price']."\r\n";
        $i++;
    }
    echo 'Total: $'.$data['Order']['total']."\r\n";
}
?>