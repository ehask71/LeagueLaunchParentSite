<section>
    <div class="container login">
        <div class="row ">
            <div class="center span4 well">
                <legend>Please Sign In</legend>
                <?php
                echo $this->Form->create('Payment', array(
                    'inputDefaults' => array(
                        'div' => 'control-group',
                        'label' => array(
                            'class' => 'control-label'
                        ),
                        'wrapInput' => 'controls'
                    ),
                    'class' => 'form-horizontal'
                ));
                echo $this->Form->input('email',array('placeholder'=>'Email','label'=>FALSE));
                echo $this->Form->input('password',array('placeholder'=>'Password','label'=>FALSE));
                echo $this->Form->submit('Sign in', array('class' => 'btn  btn-primary btn-block'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
    <p class="text-center muted ">&copy; Copyright 2013 - Application Name</p>
</section>