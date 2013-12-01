<div class="span12">
    <p>Lets add a player to your account. Please fill out the form below</p>
<?php
echo $this->Form->create('PlayerSaaS', array(
    'inputDefaults' => array(
        'div' => 'control-group',
        'label' => array(
            'class' => 'control-label'
        ),
        'wrapInput' => 'controls'
    ),
    'class' => 'form-horizontal'
));
echo $this->Form->input('site_id', array('type' => 'hidden', 'value' => $site_id));
echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user_id));
echo $this->Form->input('firstname');
echo $this->Form->input('lastname');
echo $this->Form->input('nickname');
echo $this->Form->input('address');
echo $this->Form->input('address2');
echo $this->Form->input('city');
echo $this->Form->input('state',array('options'=> Configure::read('States')));
echo $this->Form->input('zip');
echo $this->Form->input('country',array('type'=>'select','options'=> Configure::read('Countries')));
echo $this->Form->input('phone', array('type' => 'text'));
echo $this->Form->input('birthday', array('id' => 'birthDate', 'label' => array('text'=>'Your Birthdate','class'=>'control-label'), 'minYear' => '1950', 'maxYear' => date('Y')));
echo $this->Form->input('gender', array('type' => 'radio', 'options' => array('m', 'f')));
echo $this->Form->input('email');
echo $this->Form->input('medconditions',array('label'=>array('text'=>'Medical Conditions','class'=>'control-label')));
echo $this->Form->submit('Register',array('class'=>'btn'));
echo $this->Form->end();
?>
</div>