<style type="text/css">
 /* temporary */
a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,dialog,div,dl,dt,em,embed,fieldset,figcaption,figure,font,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,hr,html,i,iframe,img,ins,kbd,label,legend,li,main,mark,menu,meter,nav,object,ol,output,p,pre,progress,q,rp,rt,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video,xmp{border:0;margin:0;padding:0;font-size:100%}html,body{height:100%}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section{display:block}b,strong{font-weight:bold}img{color:transparent;font-size:0;vertical-align:middle;-ms-interpolation-mode:bicubic}ol,ul{list-style:none}li{display:list-item}table{border-collapse:collapse;border-spacing:0}th,td,caption{font-weight:normal;vertical-align:top;text-align:left}q{quotes:none}q:before,q:after{content:'';content:none}sub,sup,small{font-size:75%}sub,sup{line-height:0;position:relative;vertical-align:baseline}sub{bottom:-0.25em}sup{top:-0.5em}svg{overflow:hidden}
#LL-CC-Process{

}
            
</style>
<div id="LL-CC-Process">
<form id="testform" method="POST" action="https://leaguelaunch.com/checkout/ll">
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
?>

</div>