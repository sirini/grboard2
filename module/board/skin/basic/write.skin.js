/* @See: http://html5demos.com/dnd-upload, @modified: sirini */
$(function(){
    
	var gr2write = {
        
        grboard: $("#hiddenInputs > input[name=grboard]").val(),
		dropzone: $("#gr2dndUpload").get(0),
		content: $("#gr2content"),
		hidden: $("#hiddenInputs"),
		boardId: $("#boardId"),
		jDropzone: $("#gr2dndUpload"),
		writeForm: $("#boardWriteForm").get(0),
		writeCancel: $("#gr2writeCancelBtn"),

		previewImage: function(file) {
		    var imgTag = "<img class=\"preview\" src=\"" + file + "\" border=\"0\" title=\"더블 클릭 시 삭제 합니다\" />";
			gr2write.jDropzone.append(imgTag);
		},
		
		linkFile: function(file) {
		    var downTag = "<img class=\"download\" src=\"/" + gr2write.grboard + 
		      "/module/board/skin/basic/images/down.png\" rel=\"/" + gr2write.grboard + "/download/file/" + file +"\" border=\"0\" />";
		    gr2write.jDropzone.append(downTag);
            var oldContent = gr2write.content.html();
            oldContent += "<br /><br />" + downTag + "<br /><br />";
            gr2write.content.html(oldContent);
		},

		readFile: function(files) {
		    var formData = new FormData();
		    for (var i = 0; i < files.length; i++) {
				formData.append("file[]", files[i]);
			}
			
			var boardId = $("#boardId").val();
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "/" + gr2write.grboard + "/board-" + boardId + "/upload");
			formData.append("mode", "dnd");
			xhr.send(formData);
			xhr.onreadystatechange = function() {
			    if (xhr.readyState == 4 && xhr.status == 200) {
			        var json = eval('(' + xhr.responseText + ')');
			        if (json.status == "error") {
			            var err = json.msg;
			            var msg = "에러 없음";
			            switch(err) {
			                case 1: 
			                case 2: msg = "파일 크기가 너무 큽니다. (ERROR: 2)"; break;
			                case 4: msg = "파일이 업로드 되지 않았습니다. (ERROR: 4)"; break;
			                case 6: msg = "임시 폴더를 잃어버렸습니다. (ERROR: 6)"; break;
			                default: msg = err; break;
			            }
			            alert(msg);
			        } else {
			            for (var f in json.list) {
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
			};
		}
	};
	
	$(document).on("dblclick", "img.preview", function(){
	    if(confirm("정말로 삭제 하시겠습니까?")) {
	        var img = $(this);
	        var path = img.attr("src");
	        var pathArr = path.split("/");
	        var pathName = pathArr[ pathArr.length - 1 ];
	        $.ajax({
	            url: "/" + gr2write.grboard + "/module/board/upload/delete.php",
	            data: "path="+pathName,
	            type: "POST",
	            dataType: "text",
	            success: function(data) {
	                img.remove();
	                alert("본문에 삽입 되었던 그림은 직접 삭제해 주세요.");
	            }
	        });
	    }
	});
		
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
	
	gr2write.writeCancel.click(function(){
		if(gr2write.content.html() != '' || tinymce.activeEditor.getContent() != '') {
			if(!confirm('정말로 글 작성을 취소 하시겠습니까?')) {
				return false;
			}
		}
	});
	
	var winWidth = $(window).width();
	if(winWidth > 640) {
	    $("head").append("<script src=\"/" + gr2write.grboard + "/lib/tinymce/tinymce.min.js\"></script>");
	    tinymce.init({
	        selector: "textarea#gr2content",
	        plugins: [
	            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	            "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	            "save table contextmenu directionality emoticons template paste textcolor"      
	        ],
	        content_css: "/" + gr2write.grboard + "/module/board/skin/basic/editor.css",
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
	  
	} else {
		$("input[name=writingInMobile]").val("yes");
	}

	var contentWidth = $("#GRBOARD2").width();
	$("#gr2dndUpload").width(contentWidth - 2);
    $("#boardWriteForm .gr-form-input").width(contentWidth - 12);

    $("body").bootstrapMaterialDesign();
    $('[data-toggle="tooltip"]').tooltip();
});