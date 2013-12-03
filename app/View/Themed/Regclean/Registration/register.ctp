<div class="row-fluid">
    <div class="span12 box black">
	<div class="box-header">Registration</div>
	<div class="box-content">
	    <p>Please fill out the form below. So we can proceed with your registration.</p>
	    <?php
	    echo $this->Form->create('AccountSaaS', array(
		'inputDefaults' => array(
		    'div' => 'control-group',
		    'label' => array(
			'class' => 'control-label'
		    ),
		    'wrapInput' => 'controls'
		),
		'novalidate' => true,
		'class' => 'form-horizontal'
	    ));
	    echo $this->Form->input('site_id', array('type' => 'hidden', 'value' => $site_id));
	    echo $this->Form->input('firstname', array('after' => '<span class="help-block">Parent Firstname if under 18</span>'));
	    echo $this->Form->input('lastname', array('after' => '<span class="help-block">Parent Lastname if under 18</span>'));
	    echo $this->Form->input('address');
	    echo $this->Form->input('address2');
	    echo $this->Form->input('city');
	    echo $this->Form->input('state', array('options' => Configure::read('States')));
	    echo $this->Form->input('zip');
	    echo $this->Form->input('country', array('type' => 'select', 'options' => Configure::read('Countries')));
	    echo $this->Form->input('phone', array('type' => 'text'));
	    echo $this->Form->input('birthdate', array('id' => 'birthDate', 'label' => array('text' => 'Your Birthdate', 'class' => 'control-label'), 'minYear' => '1950', 'maxYear' => date('Y')));
	    echo $this->Form->input('gender', array('type' => 'radio', 'options' => array('m', 'f')));
	    echo $this->Form->input('email');
	    echo $this->Form->input('password');
	    echo $this->Form->input('confirm_password');
	    echo $this->Form->input('agever', array('type' => 'checkbox', 'value' => 1, 'label' => 'Are you over the age of 13'));
	    echo $this->Form->input('agreeterms', array('type' => 'checkbox', 'value' => 1, 'label' => array('class' => null, 'text' => 'I agree to the <a href="/terms" target="_blank">Terms & Conditions</a>')));
	    echo $this->Form->submit('Register', array('class' => 'btn'));
	    echo $this->Form->end();
	    ?>
	</div>
    </div>
</div>