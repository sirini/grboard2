$(function(){
    var socket = io.connect('http://grboard2.mooo.com/message');
    var memoBody = $("#gr2memoPageBody");
    var userkey = memoBody.attr("data-push-userkey");
    var roomid = memoBody.attr("data-push-roomid");
    var joinSuccess = false;
    
    socket.emit('join', {room: roomid});
    socket.on('joined', function(data){
        joinSuccess = true;
    });
    socket.on('msg ' + userkey, function(data){
        if(!joinSuccess) return;
        $.gritter.add({ 
            title: "New message", 
            text: "You got a new message right now. Please check it. (Refresh this page)", 
            time: 3000,
            after_close: function() {
                var url = location.href;
                if(url.indexOf("/memo/write") == -1) {
                    location.reload();
                }
            }
        }); 
    });
    
    $("#gr2sendMsgBtn").click(function(){
        if(!joinSuccess) return;
        var toId = $("#userId").val();
        socket.emit('msg', {room: roomid, to: toId});
    });
});
