$(function(){
    var userId = $("#userId"); 
    var idInfo = $("#userIdInfo");
    var userPw = $("#userPw");
    var pwInfo = $("#userPwInfo");
    var userReal = $("#userReal");
    var realInfo = $("#userRealInfo");
    var grboard = $("#gr2joinPageBody").attr("rel");
    userId.focusout(function(){
        var id = userId.val();
        if(id.length < 1) return;
        $.ajax({
            url: '/'+grboard+'/module/board/join/idcheck.php',
            data: 'id=' + id, method: 'POST', type: 'text',
            success: function(data) {
                if(data == 'true') idInfo.html('<span class="text-danger">이미 등록된 아이디 입니다.</span>');
                else idInfo.html('<span class="text-primary">사용해도 되는 아이디 입니다.</span>');
            }
        });
    });
    userPw.focusout(function(){
        var pw = userPw.val();
        if(pw.length < 5) pwInfo.html('<span class="text-danger">비밀번호 길이가 너무 짧습니다.</span>');
        else pwInfo.html('<span class="text-primary">비밀번호를 잊지 않도록 주의해 주세요.</span>')
    });
    userReal.focusout(function(){
       var real = userReal.val();
       var limit = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '{', '}', '[', ']', '|', ':', ';', '<', '>', '?', '/',
                    '~', '=', '\\', '"', '_', '=', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
       var ret = true;
       for(var str in limit) {
           if(real.indexOf(str) != -1) {
               realInfo.html('<span class="text-danger">본명을 입력해 주세요.</span>');
               ret = false;
               break;
           }
       }
       if(ret) realInfo.html('<span class="text-primary">필요 시 실제 이름이 사용 됩니다.</span>');
    });
});