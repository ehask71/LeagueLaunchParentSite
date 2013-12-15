<div class="row">
    <div class="span6" id="form-container">
	<?php
	echo $this->Form->create(null, array(
	    'inputDefaults' => array(
		'div' => 'control-group',
		'label' => array(
		    'class' => 'control-label'
		),
		'wrapInput' => 'controls'
	    ),
	    'class' => 'well form-horizontal'
	));
	?>
	<fieldset>
	    <legend>Register</legend>
	    <?php
	    echo $this->Form->input('firstname', array('label' => array('text' => 'Firstname', 'class' => 'control-label')));
	    echo $this->Form->input('lastname', array('label' => array('text' => 'Lastname', 'class' => 'control-label')));
	    echo $this->Form->input('address', array('label' => array('text' => 'Billing Address', 'class' => 'control-label')));
	    echo $this->Form->input('address2', array('label' => array('text' => 'Billing Address 2', 'class' => 'control-label')));
	    echo $this->Form->input('city', array('label' => array('text' => 'Billing City', 'class' => 'control-label')));
	    echo $this->Form->input('state', array('type' => 'select', 'options' => Configure::read('States'), 'label' => array('text' => 'State', 'class' => 'control-label')));
	    echo $this->Form->input('zip', array('label' => array('text' => 'Billing Zip', 'class' => 'control-label')));
	    echo $this->Form->input('country', array('type' => 'select', 'options' => Configure::read('Countries'), 'label' => array('text' => 'Billing Country', 'class' => 'control-label')));
	    echo $this->Form->input('phone', array('type' => 'text', 'label' => array('text' => 'Phone', 'class' => 'control-label')));
	    echo $this->Form->input('email', array('label' => array('text' => 'Email', 'class' => 'control-label')));
	    ?>
	</fieldset>
	<?php if (count($products) > 0): ?>
    	<fieldset>
    	    <legend>Options</legend>
		<?php
		foreach ($products AS $cat) {
		    echo '<div class="control-group"><p><strong>' . $cat['ProductCategory']['name'] . '</strong></p></div>';
		    foreach ($cat['Products'] AS $product) {
			$this->Form->input('product.'.$product['Product']['id'],array('type'=>'input','length'=>2,'value'=>0,'label'=>array('text'=>$product['Product']['name'].' $'.$product['Product']['price'], 'class' => 'control-label')));
		    }
		}
		?>
    	</fieldset>
	<?php endif; ?>
	<fieldset> 
	    <legend>Payment Details</legend>
	    <?php
	    echo $this->Form->input('ccnum', array('label' => array('text' => 'Card Number', 'class' => 'control-label')));
	    echo $this->Form->input('ccmonth', array('label' => array('text' => 'Exp Month', 'class' => 'control-label'), 'value' => '01', 'onfocus' => 'this.value=\'\''));
	    echo $this->Form->input('ccyear', array('label' => array('text' => 'Exp Year', 'class' => 'control-label'), 'value' => '2013', 'onfocus' => 'this.value=\'\''));
	    echo $this->Form->input('cc_code', array('label' => array('text' => 'CVV', 'class' => 'control-label'), 'value' => '111', 'onfocus' => 'this.value=\'\''));
	    echo $this->Form->input('agreeterms', array('type' => 'checkbox', 'value' => 1, 'label' => array('text' => 'I agree to the <a href="/terms" target="_blank">Terms & Conditions</a>', 'class' => 'control-label')));
	    echo $this->Form->submit('Proceed', array('div' => false, 'class' => 'btn'));
	    ?>
	</fieldset>
	<?php
	echo $this->Form->end();
	?>
    </div>
</div>