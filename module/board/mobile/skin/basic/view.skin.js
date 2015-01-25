$(function(){
	
	$("a.checkReply").each(function(index){
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
	
	var resizeSearch = function(){
		var searchInputSize = $(window).width();
		if(searchInputSize > 750) searchInputSize -= 250;
		else if(searchInputSize > 500) searchInputSize -= 200;
		else if(searchInputSize > 350) searchInputSize -= 190;
		else searchInputSize -= 190;
		$("#gr2searchForm input[type=search]").css("width", searchInputSize + "px");
	};
	
	resizeSearch();
	$(window).resize(resizeSearch);
});	