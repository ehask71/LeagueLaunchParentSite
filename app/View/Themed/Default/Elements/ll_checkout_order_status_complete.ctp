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
</style>
<div class="LL-CC-Info">
    <h2>Oops!</h2>
    <p>
        It appears this order has already been completed. If you think this is an error please contact us 
        <a href="mailto:<?php echo $this->Session->read('Sitedetails.Settings.admin_email');?>"><?php echo $this->Session->read('Sitedetails.Settings.admin_email');?></a>. 
        We will be happy to investigate and resolve the issue 
    </p>
</div>