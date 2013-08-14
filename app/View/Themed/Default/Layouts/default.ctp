<html>
    <head>
        <title>League Launch .::. Sports League Management .::.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta name="keywords" content="League Launch,LeagueLaunch,Sports Team,League management,Team Websites">
        <meta name="description" content="LeagueLaunch.com is a total site,League, and Team Management solution for all your leagues needs no matter what sport!">
        
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    </head>
    <body >
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>    
        <?php echo $this->fetch('scriptBottom');?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-42932858-1']);
            _gaq.push(['_setDomainName', '<?php echo $_SERVER['SERVER_NAME']; ?>']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 
                    'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </body>
</html>
