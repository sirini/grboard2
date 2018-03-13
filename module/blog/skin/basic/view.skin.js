$(function(){
	$("div#blogReply a.checkReply").each(function(index){
		$(this).click(function(){
			var uid = $(this).attr("rel");
			$('form#blogCommentForm input[name="family_uid"]').attr("value", uid);
			$('form#blogCommentForm textarea[name="content"]').val( ': ' + $('div#blogContent_' + uid).text() );
			$('form#blogCommentForm input[type="submit"]').attr("value", "Reply");
		});
	});
	
	$(".card-body img").each(function(index){
		$(this).addClass("img-fluid").addClass("rounded").addClass("mx-auto");
	});

	$("#blogSearchForm").submit(function (e) {
	    e.preventDefault();
	    var value = $("#blogSearchText").val();
	    if ($.trim(value) == "") {
	        alert("�˻�� ��� �ֽ��ϴ�. �ٽ� Ȯ���� �ּ���!");
	        return false;
	    }
	    var grboard = $(this).attr("rel");
	    location.href = "/" + grboard + "/blog/search/all/" + value + "/1";
	    return false;
	});
		
	SyntaxHighlighter.all();
	
	$("body").bootstrapMaterialDesign();
	$('[data-toggle="tooltip"]').tooltip();			
});