$(function(){
	$("#boardManageForm").on("submit", function(e){
		var data = $("#boardManageForm :input").serializeArray();
		for(d in data) {
			if(data[d].name == 'manageAction') {
				if(data[d].value == 'delete') {
					if(confirm("정말로 선택하신 게시글(들)을 모두 삭제 하시겠습니까?")) {
						return true;
					} else {
						e.preventDefault();
						return false;
					}
				} 
			}
		}
		return true;
	});
});
