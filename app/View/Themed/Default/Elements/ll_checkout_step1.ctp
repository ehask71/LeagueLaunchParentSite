<style type="text/css">
 /* temporary */
a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,dialog,div,dl,dt,em,embed,fieldset,figcaption,figure,font,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,hr,html,i,iframe,img,ins,kbd,label,legend,li,main,mark,menu,meter,nav,object,ol,output,p,pre,progress,q,rp,rt,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video,xmp{border:0;margin:0;padding:0;font-size:100%}html,body{height:100%}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section{display:block}b,strong{font-weight:bold}img{color:transparent;font-size:0;vertical-align:middle;-ms-interpolation-mode:bicubic}ol,ul{list-style:none}li{display:list-item}table{border-collapse:collapse;border-spacing:0}th,td,caption{font-weight:normal;vertical-align:top;text-align:left}q{quotes:none}q:before,q:after{content:'';content:none}sub,sup,small{font-size:75%}sub,sup{line-height:0;position:relative;vertical-align:baseline}sub{bottom:-0.25em}sup{top:-0.5em}svg{overflow:hidden}
.clear {
    clear:both;
}
body{
    font-family: Arial, Tahoma, sans-serif;
    font-size: 14px;
}
.message{
    width:93.75%;
    max-width:768px;
    margin:50px auto 40px auto;
    text-align:center;
    margin-bottom:40px;
    text-shadow:1px 1px 1px rgba(255,255,255,0.2);
    color: #D8000C;
    background-color: #FFBABA;
}
#flashMessage{
    border: 1px solid;
    margin: 10px auto;
    padding:15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 10px center;
    border-radius: 6px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
}
#LL-CC-Info{
    width:93.75%;
    max-width:768px;
    margin:50px auto 40px auto;
    text-align:center;
    margin-bottom:40px;
    text-shadow:1px 1px 1px rgba(255,255,255,0.2);
}
#LL-CC-Info p{
    
}
#LL-CC-Info h2{
    font-size:1.5em;
    color:#555;
    
}
#LL-CC-Process{
    display:block;
    position:relative;
    width:93.75%;   
    max-width:500px;    
    min-width:300px;    
    margin:30px auto;
    padding:20px;
    overflow:hidden;
    border-radius:6px;
    z-index:1;
    background: linear-gradient(to bottom, #4D9DCE 1%, #2C59A8 100%) repeat scroll 0 0 transparent;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.8), 0 1px 3px rgba(255, 255, 255, 0.3) inset, 0 0 2px rgba(255, 255, 255, 0.3) inset;
    color: #FFFFFF;
}
#LL-CC-Process h2{
    text-shadow: 0 1px 1px #2D4DAA;
}
#LL-CC-Process label{
    display:block;
    margin-bottom:8px;
    color:rgba(255,255,255,0.6);
    text-transform:uppercase;
    font-size:1.1em;
    font-weight:bold;
    text-shadow:0px 1px 2px rgba(17,123,173,0.6);
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);
}
#LL-CC-Process div.part{
    display: inline-block;
    float: left;
}
#LL-CC-Process input {
    display:block;
    padding:12px 10px;
    color:#999;
    font-size:1.2em;
    font-weight:bold;
    text-shadow:1px  1px 1px #fff;
    border:1px solid rgba(16,103,133,0.6);
    box-shadow:0px 0px 3px rgba(255,255,255,0.5), inset 0px 1px 4px rgba(0,0,0,0.2);
    border-radius:3px;
}
#LL-CC-Process div.submit{
    text-align: right;
}
#LL-CC-Process input[type=submit]{
    cursor: pointer;
}
#LL-CC-Process div.ccnumber{
    display:block;
    width:100%;
    margin-bottom: 20px;
}
#LL-CC-Process div.ccyear, #LL-CC-Process div.ccmonth, #LL-CC-Process div.cccvv{
    width:33%;
    margin-bottom: 10px;
    float: left;
}
#LL-CC-Process input.full {
    width:100%;
}
#LL-CC-Process input.month{
    margin-right: 5%;
    width: 90%;
}
#LL-CC-Process input.year{
    margin-right: 5%;
    width: 90%;
}
#LL-CC-Process input.cvv{
    float: left;
    width: 90%;
}
#LL-CC-Process .watermark{
    color: rgba(255, 255, 255, 0.06);
    font-size: 1.3em;
    font-style: italic;
    font-weight: bold;
    right: 20px;
    text-align: right;
    position:absolute;
}
#LL-CC-Footer{
    width:93.75%;
    max-width:768px;
    margin:50px auto 40px auto;
    text-align:right;
    margin-bottom:40px;
    text-shadow:1px 1px 1px rgba(255,255,255,0.2);
}
</style>
<div id="LL-CC-Info"> 
<?php
echo '<h2>'.$this->Session->read('Sitedetails.Sites.leaguename').'</h2>';
?>
    <p>
        Total: $<?php echo $this->Session->read('Orderdetails.OrderSaaS.total');?>
    </p>
</div>
<div id="LL-CC-Process">
    <h2>Payment Details</h2>
<?php

echo $this->Form->create(NULL,array('url' =>array('controller' => 'checkout', 'action' => 'process'), 'id' => 'checkoutForm',
	'inputDefaults' => array(
                                'div' => false,
                                'label' => true,
                                'before' => '<div class="input">',
                                'between' => '',
				'after' => '</div>'
                            )));
echo $this->Form->input('creditcard_number',array('label'=>'Credit Card:','value'=>'5555555555555555','class'=>'full','onfocus'=>'this.value=\'\'','before'=>'<div class="input text ccnumber">'));
echo '<div class="clear"></div>';
echo $this->Form->input('creditcard_month',array('label'=>'Month:','value'=>'01','class'=>'month','onfocus'=>'this.value=\'\'','before'=>'<div class="input text ccmonth">'));
echo $this->Form->input('creditcard_year',array('label'=>'Year:','value'=>'2013','class'=>'year','onfocus'=>'this.value=\'\'','before'=>'<div class="input text ccyear">'));
//echo $this->Form->input('creditcard_month',array('type'=>'select','label'=>'Month','options'=> array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12)));
//echo $this->Form->input('creditcard_year',array('type'=>'select','label'=>'Year','options'=> array(2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017,2018=>2018,2019=>2019,2020=>2020)));
echo $this->Form->input('creditcard_code',array('label'=>'CVV','value'=>'111','class'=>'cvv','onfocus'=>'this.value=\'\'','before'=>'<div class="input text cccvv">'));
echo '<div class="clear"></div>';
echo $this->Form->input('sid',array('type'=>'hidden','value'=>$sid));
echo $this->Form->input('oid',array('type'=>'hidden','value'=>$oid));
echo $this->Form->input('rtn',array('type'=>'hidden','value'=>  base64_decode($rtn)));
echo $this->Form->end(__('Submit Payment'));
?>
    <div class="watermark">powered by leaguelaunch.com</div>
</div>
<div id="LL-CC-Footer">
    <?=$this->Html->image('/img/visa.png')?> <?=$this->Html->image('/img/mastercard.png')?>
    <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=uAD9cz18b4cLPgo866tbyCTWKJ0AapMjI5njEEWiWmNaoVNMiHWH"></script></span>
</div>