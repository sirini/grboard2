$(function(){
	$("div#blogReply a.checkReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#blogGuestbookForm input[name="reply_uid"]').attr("value", uid);
			$('form#blogGuestbookForm textarea[name="content"]').val( ': ' + $('div#blogContent_' + uid).text().trim() );
			$('form#blogGuestbookForm input[type="submit"]').attr("value", "Reply");
		});
	});
	$("body").bootstrapMaterialDesign();
	$('[data-toggle="tooltip"]').tooltip();
});