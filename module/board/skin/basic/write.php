<?php 
if(!defined('GR_BOARD_2')) exit(); 

if($postTarget == 0):
	$oldData = array('is_notice'=>0, 'is_secret'=>0, 'name'=>'', 'email'=>'', 'homepage'=>'',  'subject'=>'', 'content'=>'', 'tag'=>'', 'category'=>'');
endif;
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">
    <div class="card bg-light">
    	<div class="card-header">Write a new post</div>
    	<div class="card-body">
    	
        	<form id="boardWriteForm" method="post" action="<?php echo $boardLink; ?>/write/<?php echo $postTarget; ?>" enctype="multipart/form-data" class="gr-form">
        	<div id="hiddenInputs">
        		<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
        		<input type="hidden" name="writeProceed" value="yes" />
        		<input type="hidden" name="boardId" id="boardId" value="<?php echo $ext_id; ?>" />
        		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $Model->getMaxUploadSize(); ?>" />
        		<input type="hidden" name="writingInMobile" value="no" />
        	</div>
        	
        	<div class="row">
        		
    			<?php 
    			$category = $Model->getCategoryList($ext_id);
    			if($category != false): ?>
    			<div class="col">
    				<select name="gr2category" class="custom-select" data-toggle="tooltip" title="글 분류를 선택 하실 수 있습니다">
    					<?php foreach($category as &$cat): ?>
    						<option name="<?php echo $cat; ?>" <?php echo (($oldData['category']==$cat)?'selected="true"':''); ?>><?php echo $cat; ?></option>
    					<?php endforeach; ?>
    				</select>
    			</div>
        		<?php endif; ?>
        
        		<?php if($Common->getSessionKey() == 1): ?>
        		<div class="col">
        			<div class="form-check">
        				<label class="form-check-label" for="isNotice" data-toggle="tooltip" title="이 글을 공지글로 지정 합니다">
        					<input class="form-check-input" type="checkbox" id="isNotice" name="isNotice" value="1" <?php echo ($oldData['is_notice']) ? 'checked="true"':''; ?> /> notice
        				</label>
        			</div>
    			</div>
    			<?php endif; ?>
        		
        		<div class="col">
        			<div class="form-check form-check-inline">
        				<label class="form-check-label" for="isSecret" data-toggle="tooltip" title="이 글을 비밀글로 지정 합니다">
        					<input class="form-check-input" type="checkbox" id="isSecret" name="isSecret" value="1" <?php echo ($oldData['is_secret']) ? 'checked="true"':''; ?> /> secret
        				</label> 
        			</div>
        			<div class="form-check form-check-inline">
        				<label class="form-check-label" for="isReplyable" data-toggle="tooltip" title="이 글에 댓글 쓰기를 허용 합니다">
        					<input class="form-check-input" type="checkbox" id="isReplyable" name="isReplyable" value="1" checked="checked" /> reply
        				</label>
        			</div>
        		</div>
        	</div>
        	
        	<?php if (!$Common->getSessionKey()): ?>
        	<div class="row">
        		<div class="col">
        			<div class="form-group">
        				<label for="gr2name">Name</label>
        				<input type="text" id="gr2name" name="gr2name" aria-describedby="nameHelp" value="<?php echo $oldData['name']; ?>" placeholder="(필수) 이름" class="form-control" />
        				<small id="nameHelp" class="form-text text-muted">본인을 구별할 수 있는 이름을 입력해 주세요</small>
        			</div>
        			<div class="form-group">
        				<label for="gr2password">Password</label>
        				<input type="password" id="gr2password" name="gr2password" aria-describedby="passwordHelp" placeholder="(필수) 비밀번호" class="form-control" />
        				<small id="passwordHelp" class="form-text text-muted">비밀번호는 관리자도 알 수 없습니다</small>
        			</div>
        		</div>
        		
        		<div class="col">
        			<div class="form-group">
        				<label for="gr2email">Email</label>
        				<input type="email" id="gr2email" name="gr2email" aria-describedby="emailHelp" placeholder="이메일" value="<?php echo $oldData['email']; ?>" class="form-control" />
        				<small id="emailHelp" class="form-text text-muted">추가적으로 이메일 주소를 입력 하실 수 있습니다</small>
        			</div>
        			<div class="form-group">
        				<label for="gr2homepage">Homepage</label>
        				<input type="url" id="gr2homepage" name="gr2homepage" aria-describedby="homepageHelp" placeholder="웹사이트" value="<?php echo $oldData['homepage']; ?>" class="form-control" />
        				<small id="gr2homepage" class="form-text text-muted">본인의 사이트 주소를 입력해 주세요</small>
        			</div>
        		</div>
        	</div>
        	
        	<div class="row">
        		<div class="col">
            		<!-- for Google reCAPTCHA | Please update your google reCAPTCHA sitekey/secretkey in common.config.php -->
            		<div class="form-group">			
            			<script src='<?php echo $gr2cfg['googleRecaptchaApiUrl']; ?>'></script>
            			<div class="g-recaptcha" data-sitekey="<?php echo $gr2cfg['googleRecaptchaSiteKey']; ?>"></div>
            		</div>
        		</div>
        	</div>
        	<?php endif; ?>
        	
        	<div class="form-group">
    			<label for="gr2subject" class="form-control-label">Subject</label>
    			<input type="text" id="gr2subject" name="gr2subject" required="true" placeholder="글 제목을 여기에 입력해 주세요" class="form-control" value="<?php echo $oldData['subject']; ?>" />
        	</div>
        	
        	<div class="form-group">
            	<div id="gr2dndUpload" class="row" data-toggle="tooltip" title="여기에 업로드 할 파일을 끌어다 놓으세요"></div>
            			
            	<label class="custom-file">
            		<input type="file" name="gr2files[]" data-toggle="tooltip" title="첨부할 파일들을 직접 선택해 보세요" class="custom-file-input" multiple="true" />
            		<span class="custom-file-control text-muted">click to choose multiple files</span>
            	</label>
        	</div>
        	
        	<?php if(isset($oldFile[0]['fid'])): ?>
        	<div class="form-group">
    			<ul class="list-group">
    	    	<?php foreach($oldFile as &$list): 
                    $fid = $list['fid'];
                    $fnameArr = explode('/', $list['real_name']);
                    $fname = $fnameArr[count($fnameArr) - 1];
                    ?>
    				<li class="form-check"><input type="checkbox" id="deleteFile<?php echo $fid; ?>" name="deleteFileList[]" class="form-check-input" value="<?php echo $fid; ?>" /> 
    					<label for="deleteFile<?php echo $fid; ?>" class="form-check-label" data-toggle="tooltip" title="이 첨부파일을 삭제 하고자 할 경우 체크해 주세요"><?php echo $fname; ?></label></li>
    			<?php endforeach; ?>	
    			</ul>
        	</div>
        	<?php unset($fid, $fnameArr, $fname, $list); endif; ?>
            	
            <div class="form-group">
            	<textarea id="gr2content" name="gr2content" class="form-control"><?php echo $oldData['content']; ?></textarea>
            </div>
            	
            <div class="form-group">
            	<label for="gr2tag" class="form-control-label">Tag</label>
            	<input type="text" id="gr2tag" name="gr2tag" value="<?php echo $oldData['tag']; ?>" placeholder="글의 핵심 단어들을 쉼표로 구분해서 입력해 주세요" class="form-control" />
            </div>
            	
            <div class="form-group">
            	<input type="submit" value="Submit" class="btn btn-outline-primary" aria-pressed="true" />
        		<a href="<?php echo $boardLink; ?>/list/1" id="gr2writeCancelBtn" class="btn btn-outline-secondary" role="button" aria-pressed="true">Cancel</a>
            </div>
        		
        	</form>
        </div>    
    </div>
</div>