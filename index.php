<?php include 'base.php'; initUser(); ?>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
        <link rel="stylesheet" type="text/css" href="./css/flipping.css"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="./js/jquery.cookie.js"></script>

    <script type="text/javascript">
/*
 jquery.fullscreen 1.1.4
 https://github.com/kayahr/jquery-fullscreen-plugin
 Copyright (C) 2012 Klaus Reimer <k@ailis.de>
 Licensed under the MIT license
 (See http://www.opensource.org/licenses/mit-license)
*/
function d(b){var c,a;if(!this.length)return this;c=this[0];c.ownerDocument?a=c.ownerDocument:(a=c,c=a.documentElement);if(null==b){if(!a.cancelFullScreen&&!a.webkitCancelFullScreen&&!a.mozCancelFullScreen)return null;b=!!a.fullScreen||!!a.webkitIsFullScreen||!!a.mozFullScreen;return!b?b:a.fullScreenElement||a.webkitCurrentFullScreenElement||a.mozFullScreenElement||b}b?(b=c.requestFullScreen||c.webkitRequestFullScreen||c.mozRequestFullScreen)&&(Element.ALLOW_KEYBOARD_INPUT?b.call(c,Element.ALLOW_KEYBOARD_INPUT):
b.call(c)):(b=a.cancelFullScreen||a.webkitCancelFullScreen||a.mozCancelFullScreen)&&b.call(a);return this}jQuery.fn.fullScreen=d;jQuery.fn.toggleFullScreen=function(){return d.call(this,!d.call(this))};var e,f,g;e=document;e.webkitCancelFullScreen?(f="webkitfullscreenchange",g="webkitfullscreenerror"):e.mozCancelFullScreen?(f="mozfullscreenchange",g="mozfullscreenerror"):(f="fullscreenchange",g="fullscreenerror");jQuery(document).bind(f,function(){jQuery(document).trigger(new jQuery.Event("fullscreenchange"))});
jQuery(document).bind(g,function(){jQuery(document).trigger(new jQuery.Event("fullscreenerror"))});

    	function fullScreen() {
    		$(document).fullScreen(true);
    	}
    </script>
</head>
<body style="background-image: url(images/bg-img.jpg)">
	<!--
	<div id="main">
	<h1>DIGITAL FORTRESS</h1>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#newsession").click(function(e) {
			window.location = "digitalfortress.php";
		})
		// if (confirm("Enter fullscreen mode")) { fullScreen(); }
	});
	</script>
	<p>
	<input type="button" class="button white" style="" value="Start New Session" id="newsession"/><hr>
	or Enter your ID: <form method="post" action="digitalfortress.php"><input type="text" name="id" value="<?=isset($_SESSION['rid']) ? $_SESSION['rid'] : ""?>"/>
	<input type="button" class="button white" value="Continue your work" style="" id="newsession" onclick="submit();"/></form>
	</div> 
	-->
	
	<div id="main" style="height: 500px; width: 500px">
	<h1>DECRYPTION</h1>
        
        <table>
            <?php
            global $mysqli;
            $res = $mysqli->query("SELECT * FROM mission");
            while ($row = $res->fetch_array()) { ?>
            <tr><td>
                    <a href="#">
            <div id="f1_container">
            <div id="f1_card" class="shadow">
            <div class="front face">
                <img width="150" height="150" src="./images/mission/<?=$row['img']?>" class="attachment-thumbnail wp-post-image" alt="Tokyo Imperial Palace" />  
            </div>
            <div class="back face center">
                <p><h3><?=$row['name']?></h3></p>
            </div>
            </div>
            </div>
                        </a>
            </td></tr>
            <?php } ?>
        </table>
		
	</div>
	
</body>