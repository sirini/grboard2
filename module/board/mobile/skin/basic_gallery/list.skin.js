$(function(){
	$("#gr2searchForm").submit(function(event){
		event.preventDefault();
		var grboard = $("#GRBOARD2").attr("rel");
		var id = $("#gr2searchForm input[name=boardId]").val();
		var option = $("#gr2searchForm select[name=option]").val();
		var value = $("#gr2searchForm input[name=value]").val();
		var page = $("#gr2searchForm input[name=page]").val();
		if($.trim(value) == "") {
			alert("검색어가 비어 있습니다. 다시 확인해 주세요!");
			return;
		}       
		location.href = "/" + grboard + "/board-" + id + "/mobile/" + option + "/:" + value + "/" + page;
	});  
		
	$("#managePosts").click(function(){
		var isChecked = false;
		$(".checkedPost").each(function(){
			if(!!this.checked == true) isChecked = true;
		});
		
		if(!isChecked) {
			alert("관리할 게시글을 하나 이상 선택해 주세요!");
			return;
		}
		
		$("#managePostForm").submit();
	});
	
	var resizeSearch = function(){
		var searchInputSize = $(window).width() - 200;
		$("#gr2searchForm input[type=search]").css("width", searchInputSize + "px");
	};
	
	resizeSearch();
	$(window).resize(resizeSearch);
	
	var thumbWidth = ($(window).width() / 3) - 15;
	$(".gr-thumbnail").css("width", thumbWidth);
	$(".gr-thumbnail img").css("width", thumbWidth);
});
