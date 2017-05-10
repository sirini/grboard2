$(function(){
	$(".add-category").click(function(){
		$("#blogConfigForm input[name=blogCategoryAction]").val('add');
		$("#blogConfigForm").submit();
	});
	
	$(".update-category").click(function(){
		var uid = $(this).attr("rel");
		var id = $("#index_" + uid).val();
		var name = $("#name_" + uid).val();
		
		$("#blogConfigForm input[name=blogCategoryAction]").val('update');
		$("#blogConfigForm input[name=categoryTarget]").val(uid);
		$("#blogConfigForm input[name=categoryIndex]").val(id);
		$("#blogConfigForm input[name=categoryName]").val(name);
		$("#blogConfigForm").submit();
	});
	
	$(".delete-category").click(function(){
		var uid = $(this).attr("rel");
		
		$("#blogConfigForm input[name=blogCategoryAction]").val('delete');
		$("#blogConfigForm input[name=categoryTarget]").val(uid);
		$("#blogConfigForm").submit();		
	});
});
