<form id="testform" method="POST">
    <input type="hidden" name="sid" value="3"/>
    <input type="hidden" name="oid" value="tttttt"/>
    <input type="hidden" name="rtn" value="http://eastbaylittleleague.com/registration/success"/>
</form>
<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo '$(document).ready(function () {
    $("#testform").submit;
    });';
$this->Html->scriptEnd();
echo $this->Js->writeBuffer();