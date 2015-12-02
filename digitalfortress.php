<?php include 'base.php'; initUser(true); ?>
<?php
header('X-Frame-Options: GOFORIT'); 
?>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
	<link rel="stylesheet" href="./plugin/jcubic-jquery.terminal-86a54bc/css/jquery.terminal.css" />
	<link rel="stylesheet" href="./css/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script src="./plugin/jcubic-jquery.terminal-86a54bc/js/jquery.mousewheel-min.js"></script>
    <script src="./plugin/jcubic-jquery.terminal-86a54bc/js/jquery.terminal-min.js"></script>
</head>
<body style="margin: 0; padding: 0; background-image: url(images/background.png);">
	<div style="background-image: url(images/bar.png); padding: 4px; font-size: 10.5pt; font-family:sans-serif">
		<span><b>Desktop</b></span>
		<span style="float: right"><span id="currenttime"></span></span>
	</div>
	
	<script type="text/javascript">
    			function capture_enter(t) {
    				if ((event.keyCode === 13) && (t.value != "")) {
    					event.preventDefault();
    					append_chat("me", t.value);
    					t.value = "";
    				}
    			}
    			
    			function append_chat(from, text) {
    					if (text == "") return;
			            table = document.getElementById('chat_table');
			            row = table.insertRow(table.getElementsByTagName("tr").length); 
			            cell1 = row.insertCell(0); 
			            cell1.style.cssText = "vertical-align: top";
			            if (from == 'me') cell1.innerHTML = "<img src='images/director.png' heigth='32' width='32'/>";
			            else if (from == 'susan') cell1.innerHTML = "<img src='images/susan.png' heigth='32' width='32'/>";
			            else  cell1.innerHTML = "<img src='images/director.png' heigth='32' width='32'/>";
			            cell2 = row.insertCell(1); 
			            cell2.innerHTML = text;
			            $("#chat_div").animate({
							scrollTop: $('#chat_div').prop("scrollHeight") }, 300);
			    }
			    
			    var messid1;
			    var messid2;
			    function getMess1() {
			    	$.get("mess_ajax.php", { messid: messid1, from: 'susan' }, function(data) {
			    		var obj = jQuery.parseJSON(data);
			    		append_chat("susan", obj.mess);
			    		if (!$("#message").dialog("isOpen")) $("#message").dialog("open");
			    		if (obj.delay > 0) setTimeout(getMess1, obj.delay);
			    		messid1 = obj.messid;
			    	})
			    }
			    
			    function getMess2() {
			    	$.get("mess_ajax.php", { messid: messid2, from: 'david' }, function(data) {
			    		var obj = jQuery.parseJSON(data);
			    		append_chat("david", obj.mess);
			    		if (!$("#message").dialog("isOpen")) $("#message").dialog("open");
			    		if (obj.delay > 0) setTimeout(getMess2, obj.delay);
			    		messid2 = obj.messid;
			    	})
			    }
    		</script>
    
    <div id="message" class="window" style="background-color: lightgray; padding: 10px; overflow: hidden">
    	<table height="100%" width="100%">
    	<tr style="height: 20px"><td style="font-size: 11pt">Message: </td></tr>
    	<tr><td>
    		<div id="chat_div" style="border: 1px solid gray; height: 100%; width: 100%; background-color: white; overflow-x: hidden; overflow-y: visible">
    			<table id="chat_table" style="font-size: 10pt"></table>
    		</div>
    	</td></tr>
    	<tr height="70px"><td>
    		<textarea style="height: 100%; width: 100%; resize: none" onkeypress="capture_enter(this);"></textarea>
    	</td></tr>
    	</table>
    </div>
    
    <div id="webbrowser" class="window" style="background-color: lightgray; padding: 10px; overflow: hidden">
    	<table height="100%" width="100%">
    	<tr style="height: 20px">
    		<td width="70px"><div style="font-size: 11pt">Address: </div></td>
    		<td><input id="webaddress" type="text" style="width: 100%"/></td>
    		<td width="130px">
    			<input type="button" value="Google" id="web_btngoogle" style="width: 60px"/>
    			<input type="button" value="Wiki" id="web_btnwiki" style="width: 60px"/></td>
    	</tr>
    	<tr><td colspan="3"><iframe id="webpage" src="" style="height: 100%; width: 100%;" sandbox="allow-scripts allow-forms"></iframe></div></td></tr>
    	<script type="text/javascript">
    		$("#web_btngoogle").click(function() {
    			$("#webpage").attr('src', "http://www.google.com/custom?q=" + $("#webaddress").val())
    		});
    		$("#web_btnwiki").click(function() {
    			$("#webpage").attr('src', "http://en.wikipedia.org/wiki/" + $("#webaddress").val())
    		});
    	</script>
    	</table>
    </div>
    
    <div id="consolewindow" class="window" style="background-color: black; color: white">
    	<div id="title" style="visibility: collapse">Console</div></tr>
    </div>
    
    </a>
    
    <script type="text/javascript">
	
	function msgbox(content) {
		//$("#overlay").show();
      	$("#dialog").fadeIn(300);
      	
      	// $("#overlay").unbind("click"); // modal
	}
	
	function add0(i) { return i < 10 ? '0' + i : i; }
	function setTime() {
		var date = new Date();
		if (date.getHours() > 12) $("#currenttime").html(add0(+date.getHours() - 12) + ":" + add0(date.getMinutes()) + " PM");
		else  $("#currenttime").html(add0(+date.getHours()) + ":" + add0(date.getMinutes()) + " AM");			
	}
	
	(function ( $ ) {
	$.fn.icon = function(id, text, dlg, fname) {
		this.id = "icon" + id;
		this.css("position", "absolute");
		
		$(this).draggable();
		$(this).dblclick(function(e) {
			$("#" + dlg).dialog('open');
		});
		 
    	$('<a href="#" id="open_' + id + '"><table width="80px">' +
    		'<tr><td align="center" ><img src="images/icon/' + fname + '"/><br></td></tr>' +
    		'<tr><td align="center"><div style="font-size: 11pt; color: white; text-shadow: 1px 1px black">' + text + '</div></td></tr>'+
    		'</table></a>').appendTo($(this));
	}
	}) (jQuery);
	
	$(document).ready(function ()
	{
		setTime(); setInterval(setTime, 60000);
		
		icon_id = [ "terminal", "chat_susan", "browser" ];
		icon_title = [ "Terminal", "Message", "Browser" ];
		icon_dlg = [ "consolewindow", "chat_susan", "webbrowser" ];
		icon_url = [ "terminal.png", "chat.png", "browser.png" ] 
		
		for (i = 0; i < icon_id.length; i++) {
			ic = document.createElement('div');
			$(ic).css("left", "30px"); $(ic).css("top", 50 + 90 * i + "px");
			$(ic).appendTo("body");
			$(ic).icon(icon_id[i], icon_title[i], icon_dlg[i], icon_url[i]);
		}

		$("#message").dialog({
			autoOpen: false,
			title: "Message",
			height: 500,
			width: 300,
			position: [1000, 50],
			closeOnEscape: false
		});
		
		$("#consolewindow").dialog({
			autoOpen: true,
			title: "Terminal",
			height: 400,
			width: 600,
			position: [300,120],
            closeOnEscape: false
        });
        
        $("#webbrowser").dialog({
        	autoOpen: false,
			title: "Web Browser",
			height: 600,
			width: 1000,
			position: [100,50],
            closeOnEscape: false
        });
        
        $(".window").dialog('option', 'hide', 'fade');
        $(".window").dialog('option', 'show', 'fade');
        
        $(".ui-dialog").removeClass('ui-corner-all').addClass('ui-corner-top');
        $(".ui-dialog-titlebar").removeClass('ui-corner-all').addClass('ui-corner-top');
        $(".ui-dialog-titlebar").css("border", "none");
        $(".ui-dialog-titlebar").css("border-bottom", "1px solid gray");
		
		var cmdcount;
		var obj;
		
		function termEcho() {
			term.echo(obj[cmdcount][0]); 
			cmdcount++; 
			if (cmdcount == obj.length) term.resume();
		}
		var term = $("#consolewindow").terminal(function (cmd, term) {
			term.pause();
			$.post("cmd_ajax.php", { cmd: cmd }, function(data){
				if (data.charAt(0) == '.') { data = data.substring(1, data.length); 
					messid1 = 0; setTimeout(getMess1, 3000);
					messid2 = 0; setTimeout(getMess2, 3000); 
				}
				obj = jQuery.parseJSON(data);
				
				cmdcount = 0;
				cmdtime = obj[0][1];
				
				termEcho();
				for (i = 1; i < obj.length; i++) { 
					setTimeout(termEcho, cmdtime);
					cmdtime = +cmdtime + +obj[i][1];
				}
				if (obj.length == 0) term.resume();
			});
		},  
        { 
        	prompt: 'NSA:~$ ', 
        	name: 'TRANSLTR', 
        	greetings: "This is United States National Security Agency's code-breaking supercomputer.\nYour ID is <?=$_SESSION['rid']?> (remember this if you want to continue your progress next time)\nPlease enter commands. Type 'help' for more information.",
        	onBlur: function() {
            	// prevent loosing focus
            	// return false;
       		}
       	});
       	
       	
       	messid1 = 0; setTimeout(getMess1(), 3000);
       	messid2 = 0; setTimeout(getMess2(), 3000);
	});
   
        
</script>
</body>
