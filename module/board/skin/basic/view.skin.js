$(function(){

	$("div.replyBox a.checkReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#boardCommentForm input[name="family_uid"]').attr("value", uid);
			$('form#boardCommentForm textarea[name="content"]').val( ': ' + $('div#boardReplyContent_' + uid).text() );
			$('form#boardCommentForm input[type="submit"]').attr("value", "Reply");
		});
	});
	
	$("#GRBOARD2 img.download").each(function(index){
	    $(this).click(function(){
	        var path = $(this).attr("rel");
	        window.open(path, '_blank');
	        return false;
	    });
	});
	
	var bbs = $("#GRBOARD2");
	var grboard = bbs.attr("rel");
	var bbsid = bbs.attr("data-board-id");
	$("head").append("<script src=\"http://grboard2.mooo.com/socket.io/socket.io.js\"></script>");
	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"/"+grboard+"/lib/gritter/css/jquery.gritter.css\" />");
	$("head").append("<script src=\"/"+grboard+"/lib/gritter/js/jquery.gritter.min.js\"></script>");
	setTimeout(function(){
        var socket = io.connect('http://grboard2.mooo.com/message');
        var viewBody = $("#gr2viewContent");
        var userkey = viewBody.attr("data-push-userkey");
        var roomid = viewBody.attr("data-push-roomid");
        var joinSuccess = false;
        
        socket.emit('join', {room: roomid});
        socket.on('joined', function(data){
            joinSuccess = true;
        });
        socket.on('msg ' + userkey, function(data){
            if(!joinSuccess) return;
            $.gritter.add({ 
                title: "New message", 
                text: "You got a new message right now. Please check it. <a href=\"/"+grboard+"/board-"+bbsid+"/memo\" style=\"color: #fff; font-weight: bold\">(Click to move)</a>", 
                time: 10000
            }); 
        });	    
	}, 3000);
});