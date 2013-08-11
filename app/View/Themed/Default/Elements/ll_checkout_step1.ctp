<div> 
<?php
echo '<h2>'.$this->Session->read('Sitedetails.Sites.leaguename').'</h2>';
?>
    <p>
        Total: $<?php echo $this->Session->read('Orderdetails.OrderSaaS.total');?>
    </p>
<?php

echo $this->Form->create(NULL,array('url' =>array('controller' => 'checkout', 'action' => 'll'), 'id' => 'checkoutForm'));
echo $this->Form->input('creditcard_num');
echo $this->Form->input('creditcard_month',array('type'=>'select','label'=>'Month','options'=> array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12)));
echo $this->Form->input('creditcard_year',array('type'=>'select','label'=>'Year','options'=> array(2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017,2018=>2018,2019=>2019,2020=>2020)));
echo $this->Form->input('creditcard_code',array('type'=>'input',));
echo $this->Form->end(__('Submit Payment'));
?>
    <pre>
       <?php print_r($this->Session->read);?>
    </pre>
</div>