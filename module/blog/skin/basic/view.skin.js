$(function(){
	$.material.init();
	$("div#blogReply a.checkReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#blogCommentForm input[name="family_uid"]').attr("value", uid);
			$('form#blogCommentForm textarea[name="content"]').val( ': ' + $('div#blogContent_' + uid).text() );
			$('form#blogCommentForm input[type="submit"]').attr("value", "Reply");
		});
	});
	
	$("#blogPost .panel-body img").each(function(index){
		$(this).addClass("img-responsive").addClass("img-rounded").addClass("center-block");
	});

	$("#blogSearchForm").submit(function (e) {
	    e.preventDefault();
	    var value = $("#blogSearchText").val();
	    if ($.trim(value) == "") {
	        alert("검색어가 비어 있습니다. 다시 확인해 주세요!");
	        return false;
	    }
	    var grboard = $(this).attr("rel");
	    location.href = "/" + grboard + "/blog/search/all/" + value + "/1";
	    return false;
	});
		
	SyntaxHighlighter.all();
});