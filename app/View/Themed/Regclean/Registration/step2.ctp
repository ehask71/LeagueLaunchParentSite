<?php $this->Html->addCrumb('Step 2', '/registration/step2'); ?>
<div class="row-fluid">
    <div class="span12 box black">
        <div class="box-content">
            <pre>
                <?php print_r($players); ?>
            </pre>
        </div>
    </div>
</div>
<?php
if ($this->Session->read('Debug')) {
    ?>
    <div class="row">
        <div class="span12">
            <pre>
                <?php print_r($this->Session->read('Registration')); ?>
            </pre>
        </div>
    </div>
    <?
}?>