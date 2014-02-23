<?php
if(!defined('GR_BOARD_2')) exit();

include $skinResourcePath . '/terminal.php';
?>

<script src="http://grboard2.mooo.com/socket.io/socket.io.js"></script>
<script>
$(function(){
	var logBox = $("#cmdLog");
	logBox.append("Connecting to the GR Board 2 API server at grboard2.mooo.com ... ");
	
	var socket = io.connect('http://grboard2.mooo.com');
	socket.on('welcome', function(data) { logBox.append("Done.<br /><br />" + data.hello); });
	socket.on('response', function(data) { logBox.append(data.response).animate({scrollTop: logBox.prop("scrollHeight")}, 500) });
	
	var info = {
		gr2version: <?php echo GR2_VERSION_NUM; ?>, 
		gr2versionStr: '<?php echo GR2_VERSION_STR; ?>', 
		gr2versionState: '<?php echo GR2_VERSION_STATE; ?>'
	};
	
	$("#cmdLineInput").keydown(function(event){
		if(event.which == 13) {
			event.preventDefault();
			var cmd = $(this).val();
			logBox.append('<div class="cmd">'+cmd+'</div>');
			socket.emit(cmd, info);
			$(this).val("");
		} 		
	});
});
</script>