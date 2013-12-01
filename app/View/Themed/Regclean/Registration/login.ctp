<section>
    <div class="container login">
        <div class="row ">
            <div class="center span4 well" style="float: none;margin: 0 auto;">
                <legend>Please Sign In</legend>
                <?php
                echo $this->Form->create('AccountSaaS', array(
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
                echo $this->Form->input('password',array('placeholder'=>'Password','label'=>FALSE,'after'=>'<span class="help-block">Need an Account? <a href="/registration/register">Click Here</a></span>'));
                echo $this->Form->submit('Sign in', array('class' => 'btn  btn-primary btn-block'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
    <p class="text-center muted ">&copy; Copyright 2013-<?=date('y');?> - LeagueLaunch.com</p>
</section>