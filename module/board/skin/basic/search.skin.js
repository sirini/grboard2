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
       location.href = "/" + grboard + "/board-" + id + "/" + option + "/" + value + "/" + page;
   });  
});
