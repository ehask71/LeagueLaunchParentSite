

Hello <?php echo $order['OrderSaaS']['first_name'] .' '. $order['OrderSaaS']['last_name'];?>,

You successfully paid via Credit Card in the amount of $<?php echo $order['OrderSaaS']['total'];?>
    
Date Paid:  <?php echo date('m-d-Y')."\r\n";?>
Order#:  <?php echo $order['OrderSaaS']['id'];?>
Credit Card Transaction#: <?php echo $authnet['transaction'];?>


Thank You,
<?php echo $site['Sites']['leaguename'];?>
