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
	
	$("#GRBOARD2 .tag").each(function(index){
		var o = $(this).text();
		var tags = o.split(',');
		var outStr = '';
		for (var i=0, len=tags.length; i<len; i++) {
			outStr += '#' + tags[i] + ' ';
		}
		$(this).text(outStr);
	});

    $("body").bootstrapMaterialDesign();
    $('[data-toggle="tooltip"]').tooltip();
});