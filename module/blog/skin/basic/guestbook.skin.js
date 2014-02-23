$(function(){

	$("div#blogPost a.doReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#blogGuestbookForm input[name="reply_uid"]').attr("value", uid);
			$('form#blogGuestbookForm textarea[name="content"]').val( ': ' + $('div#message' + uid).text().trim() );
			$('form#blogGuestbookForm input[type="submit"]').attr("value", "Reply");
		});
	});
	
});