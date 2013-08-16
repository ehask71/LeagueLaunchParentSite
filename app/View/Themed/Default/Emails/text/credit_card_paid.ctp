Order Paid  <?php echo date('m-d-Y')."\r\n";?>


Hello <?php echo $order['OrderSaaS']['first_name'] .' '. $order['OrderSaaS']['last_name'];?>,

    You successfully paid Order #<?php echo $order['OrderSaaS']['id'];?> via Credit Card in the amount of $<?php echo $order['OrderSaaS']['total'];?>   
 Credit Card Transaction#<?php echo $authnet['transaction'];?>


Thank You,
<?php echo $site['Sites']['leaguename'];?>
