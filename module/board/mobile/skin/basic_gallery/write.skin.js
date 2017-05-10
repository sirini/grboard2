$(function(){
	var resizeSearch = function(){
		var searchInputSize = $(window).width();
		if(searchInputSize > 750) searchInputSize -= 250;
		else if(searchInputSize > 500) searchInputSize -= 230;
		else if(searchInputSize > 350) searchInputSize -= 190;
		else searchInputSize -= 190;
		$("#gr2searchForm input[type=search]").css("width", searchInputSize + "px");
	};
	
	resizeSearch();
	$(window).resize(resizeSearch);
});	