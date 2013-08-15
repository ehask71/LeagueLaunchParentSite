Order Paid  <?php echo date('m-d-Y')."\r\n";?>


Hello <?php echo $order['OrderSaaS']['first_name'] .' '. $order['OrderSaaS']['last_name'];?>,

    You successfully paid Order #<?php echo $order['OrderSaaS']['id'];?> via Credit Card in the amount of $<?php echo $order['OrderSaaS']['total'];?>
Transaction Id #<?php echo $order['OrderSaaS']['transaction'];?>


Thank You,
<?php echo $site['Sites']['leaguename'];?>
