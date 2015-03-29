$(function(){
	$(".add-link").click(function(){
		$("#blogConfigForm input[name=blogLinkAction]").val('add');
		$("#blogConfigForm").submit();
	});
	
	$(".update-link").click(function(){
		var uid = $(this).attr("rel");
		var name = $("#name_" + uid).val();
		var url = $("#url_" + uid).val();
		var info = $("#info_" + uid).val();
		
		$("#blogConfigForm input[name=blogLinkAction]").val('update');
		$("#blogConfigForm input[name=linkTarget]").val(uid);
		$("#blogConfigForm input[name=linkName]").val(name);
		$("#blogConfigForm input[name=linkURL]").val(url);
		$("#blogConfigForm input[name=linkInfo]").val(info);
		$("#blogConfigForm").submit();
	});
	
	$(".delete-link").click(function(){
		var uid = $(this).attr("rel");
		
		$("#blogConfigForm input[name=blogLinkAction]").val('delete');
		$("#blogConfigForm input[name=linkTarget]").val(uid);
		$("#blogConfigForm").submit();		
	});
});
