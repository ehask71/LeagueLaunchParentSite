

Hello <?php echo $order['Order']['first_name'] .' '. $order['Order']['last_name'];?>,

You successfully paid via Credit Card in the amount of $<?php echo $order['Order']['total'];?>
    
Date Paid:  <?php echo date('m-d-Y')."\r\n";?>
Order#:  <?php echo $order['Order']['id'];?>
Credit Card Transaction#: <?php echo $authnet['Order']['transaction'];?>


Thank You,
<?php echo $site['Sites']['leaguename'];?>
