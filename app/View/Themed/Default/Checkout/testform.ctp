<form id="testform" method="POST" action="/checkout/ll">
    <input type="hidden" name="sid" value="3"/>
    <input type="hidden" name="oid" value="52050917-c384-475f-a565-2c24413c2bf7"/>
    <input type="hidden" name="rtn" value="http://eastbaylittleleague.com/registration/success"/>
</form>
<?php
$this->Html->scriptStart(array('block' => 'scriptBottom'));
echo '$(document).ready(function () {
    $("#testform").submit();
    });';
$this->Html->scriptEnd();
echo $this->Js->writeBuffer();