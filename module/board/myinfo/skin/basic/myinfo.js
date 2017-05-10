$(function(){
    $.material.init();
    
    var userPw = $("#userPw");
    var pwInfo = $("#userPwInfo");
    var userReal = $("#userReal");
    var realInfo = $("#userRealInfo");
    var grboard = $("#gr2MyInfoPageBody").attr("rel");
    
    userPw.focusout(function(){
        var pw = userPw.val();
        if(pw.length < 5) pwInfo.html('<span class="text-danger">비밀번호 길이가 너무 짧습니다.</span>');
        else pwInfo.html('<span class="text-primary">비밀번호를 잊지 않도록 주의해 주세요.</span>');
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