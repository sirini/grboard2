$(function(){

	$("div#blogReply a.checkReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#blogCommentForm input[name="family_uid"]').attr("value", uid);
			$('form#blogCommentForm textarea[name="content"]').val( ': ' + $('div#blogContent_' + uid).text() );
			$('form#blogCommentForm input[type="submit"]').attr("value", "Reply");
		});
	});

});