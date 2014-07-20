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
	var bbsno = bbs.attr("data-board-no");
    var userkey = bbs.attr("data-push-userkey");
    var roomid = bbs.attr("data-push-roomid");
	var socket;
    var joinSuccess = false;
    
	$("head").append("<script src=\"http://grboard2.mooo.com/socket.io/socket.io.js\"></script>");
	$("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"/"+grboard+"/lib/gritter/css/jquery.gritter.css\" />");
	$("head").append("<script src=\"/"+grboard+"/lib/gritter/js/jquery.gritter.min.js\"></script>");
   
	setTimeout(function(){
        socket = io.connect('http://grboard2.mooo.com/message');        
        socket.emit('join', {room: roomid});
        socket.on('joined', function(data){
            joinSuccess = true;
        });
        socket.on('msg ' + userkey, function(data){
            if(!joinSuccess) return;
            $.gritter.add({ 
                title: "New message", 
                text: "You got a new message. <a href=\"/"+grboard+"/board-"+bbsid+"/memo\">(Click to check it)</a>", 
                time: 10000
            }); 
        });
        socket.on('notify ' + userkey, function(data){
        	if(!joinSuccess) return;
            $.gritter.add({ 
                title: "Receive a reply", 
                text: "You got a new reply on your post.<br /><a href=\"/"+grboard+"/board-"+data.bbsid+"/view/"+data.bbsno+"\">(Click to check it)</a>", 
                time: 10000
            }); 
        });
	}, 1000);
	
    $("#gr2sendComment").click(function(){
        if(!joinSuccess) return;
        var toId = $("#gr2userId").html();
        if(toId != userkey) {
        	socket.emit('notify', {room: roomid, to: toId, id: bbsid, no: bbsno});
        }
    });
});