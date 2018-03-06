$(function () {
    $("#blogSearchForm").submit(function (e) {
        e.preventDefault();
        var value = $("#blogSearchText").val();
        if ($.trim(value) == "") {
            alert("검색어가 비어 있습니다. 다시 확인해 주세요!");
            return false;
        }
        var grboard = $(this).attr("rel");
        location.href = "/" + grboard + "/blog-text/search/all/" + value + "/1";
        return false;
    });
    
	$("body").bootstrapMaterialDesign();
	$('[data-toggle="tooltip"]').tooltip();		
});