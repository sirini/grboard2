$(function(){
	var $userId = $("#userId");
	$userId.popover();
	$userId.keyup(function(){
		var bbsid = $("#memoBox").attr("role");
		var grboard = $("#gr2memoPageBody").attr("rel");
		$.post("/" + grboard + "/board-" + bbsid + "/memo/autocomplete/0", {id: $userId.val()}).done(function(data) {
			var results = $.parseJSON(data);
			var content = '';
			for(var i=0; i<results.length; i++) {
				content += '<div><span class="auto-complete-list text-primary">'+results[i].id+'</span> ('+results[i].nickname+')</div>';
			}
			$(".popover-body").html(content);
		});		
	});
	
	$(document).on("click", ".auto-complete-list", function(){
		var $text = $(this).text();
		$userId.val($text);
	});
	
	$("body").bootstrapMaterialDesign();
	$('[data-toggle="tooltip"]').tooltip();
});
