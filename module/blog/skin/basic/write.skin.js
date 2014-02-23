$(function(){
    
    var gr2write = {
        
        grboard: $("#hiddenInputs > input[name=grboard]").val(),
        dropzone: $("#gr2dndUpload").get(0),
        content: $("#gr2content"),
        hidden: $("#hiddenInputs"),
        jDropzone: $("#gr2dndUpload"),
        writeForm: $("#blogWriteForm").get(0),

        previewImage: function(file) {
            var imgTag = "<img src=\"" + file + "\" border=\"0\" />";
            gr2write.jDropzone.append(imgTag);
            var oldContent = gr2write.content.html();
            oldContent += "<br /><br />" + imgTag + "<br /><br />";
            tinymce.activeEditor.execCommand('mceInsertContent', false, oldContent);
        },
        
        linkFile: function(file) {
            var downTag = "<img class=\"download\" src=\"/" + gr2write.grboard + 
              "/module/blog/skin/basic/images/down.png\" rel=\"/" + gr2write.grboard + "/download/file/" + file +"\" border=\"0\" />";
            gr2write.jDropzone.append(downTag);
            var oldContent = gr2write.content.html();
            oldContent += "<br /><br />" + downTag + "<br /><br />";
            gr2write.content.html(oldContent);
        },

        readFile: function(files) {
            var formData = new FormData();
            for(var i=0; i<files.length; i++) {
                formData.append("file[]", files[i]);
                gr2write.jDropzone.css("padding", "5px").css("height", "100px");
            }
            
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/" + gr2write.grboard + "/blog/upload");
            formData.append("mode", "dnd");
            xhr.send(formData);
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    var json = eval('(' + xhr.responseText + ')');
                    if(json.status == "error") {
                        var err = json.msg;
                        var msg = "에러 없음";
                        switch(err) {
                            case 1: 
                            case 2: msg = "파일 크기가 너무 큽니다."; break;
                            case 4: msg = "파일이 업로드 되지 않았습니다."; break;
                            case 6: msg = "임시 폴더를 잃어버렸습니다."; break;
                            default: msg = err; break;
                        }
                        alert(msg);
                    } else {
                        for(var f in json.list) {
                            var hash = json.list[f].hash;
                            var real = json.list[f].real;
                            var ext = real.match(/[^\\]*\.(\w+)$/);
                            var extLow = ext[1].toLowerCase();
                            if(extLow == "png" || extLow == "jpg" || extLow == "gif" || extLow == "bmp") {
                                gr2write.previewImage(hash);
                            } else {
                                var path = hash.split('/');
                                gr2write.linkFile(path[ path.length - 1 ]);
                            }
                            gr2write.hidden.append("<input type=\"hidden\" name=\"hashfiles[]\" value=\"" + hash + "\" />");
                            gr2write.hidden.append("<input type=\"hidden\" name=\"realfiles[]\" value=\"" + real + "\" />");
                        }
                    }
                } 
            }
        }
    };
        
    gr2write.dropzone.ondragover = function() {
        this.className = "hover"; 
        return false;
    };

    gr2write.dropzone.ondragend = function() {
        this.className = "";
        return false;
    };

    gr2write.dropzone.ondrop = function(e) {
        this.className = "";
        e.preventDefault();
        gr2write.readFile(e.dataTransfer.files);
    };
    
    $("head").append("<script src=\"/" + gr2write.grboard + "/lib/tinymce/tinymce.min.js\"></script>");
    tinymce.init({
        selector: "textarea#gr2content",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"      
        ],
        content_css: "/" + gr2write.grboard + "/module/blog/skin/basic/editor.css",
        forced_root_block : false,
        setup: function(ed) {
            ed.on('submit', function(e) {
                e.preventDefault();
                var subject = $("input[name=gr2subject]");
                var content = ed.getContent();
                if(subject.val() == "") {
                    alert("글 제목을 입력해 주세요");
                    subject.focus();
                    return false;
                }
                if(content == "") {
                    alert("글 내용을 입력해 주세요");
                    return false;
                }
                gr2write.hidden.append("<input type=\"hidden\" name=\"gr2content\" value=\"" + content.replace(/"/g, "[bigquote]") + "\" />");
                gr2write.writeForm.submit();
                return false;   
            });
        },
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
    });
    
});
