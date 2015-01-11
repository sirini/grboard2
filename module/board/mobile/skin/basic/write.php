<?php 
if(!defined('GR_BOARD_2')) exit(); 

if($postTarget == 0):
	$oldData = array('is_notice'=>0, 'is_secret'=>0, 'name'=>'', 'email'=>'', 'homepage'=>'',  'subject'=>'', 'content'=>'', 'tag'=>'');
endif;
?>
<div id="GRBOARD2">		
	<form id="boardWriteForm" method="post" action="<?php echo $boardLink; ?>/write/<?php echo $postTarget; ?>" enctype="multipart/form-data" class="form">
		<div id="hiddenInputs">
			<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
			<input type="hidden" name="writeProceed" value="yes" />
			<input type="hidden" name="boardId" id="boardId" value="<?php echo $ext_id; ?>" />
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $Model->getMaxUploadSize(); ?>" />
			<input type="hidden" name="writingInMobile" value="no" />
		</div>		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Write a new post</h3>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item">
					<?php if($Common->getSessionKey() == 1): ?>
						<input type="checkbox" name="isNotice" value="1" <?php echo ($oldData['is_notice']) ? 'checked="true"':''; ?> id="isNotice" />
							<label for="isNotice">notice</label>
					<?php endif; ?> &nbsp;&nbsp;
					
					<input type="checkbox" name="isSecret" value="1" <?php echo ($oldData['is_secret']) ? 'checked="true"':''; ?> id="isSecret" />
						<label for="isSecret">secret</label> &nbsp;&nbsp;
						
					<input type="checkbox" name="isReplyable" value="1" checked="checked" id="isReplyable" />
						<label for="isReplyable">reply</label> &nbsp;&nbsp;
						
					<?php 
					$category = $Model->getCategoryList($ext_id);
					if($category != false): ?>
						<select name="gr2category">
							<?php foreach($category as &$cat): ?>
								<option name="<?php echo $cat; ?>"><?php echo $cat; ?></option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
				</li>		
				
				<?php if (!$Common->getSessionKey()): ?>
				<li class="list-group-item"><input type="text" name="gr2simplelock" placeholder="(필수) 우측의 5자리 키 값 입력!" class="form-control" /> 
					&middot;&middot;&middot; <strong>Spam</strong> [<span class="red"><?php echo $simplelock; ?></span>]</li>
				<li class="list-group-item"><input type="text" name="gr2name" value="<?php echo $oldData['name']; ?>" placeholder="(필수) 이름" class="form-control" /> 
					&middot;&middot;&middot; <strong>Name</strong></li>
				<li class="list-group-item"><input type="password" name="gr2password" placeholder="(필수) 비밀번호" class="form-control" /> 
					&middot;&middot;&middot; <strong>Password</strong></li>
				<li class="list-group-item"><input type="email" name="gr2email" placeholder="이메일" value="<?php echo $oldData['email']; ?>" class="form-control" /> 
					&middot;&middot;&middot; email</li>
				<li class="list-group-item"><input type="url" name="gr2homepage" placeholder="웹사이트" value="<?php echo $oldData['homepage']; ?>" class="form-control" /> 
					&middot;&middot;&middot; homepage</li>
				<?php endif; ?>
				
				<li class="list-group-item">
					<input type="text" name="gr2subject" required="true" placeholder="글 제목을 여기에 입력해 주세요" class="form-control" value="<?php echo $oldData['subject']; ?>" />
				</li>
					
				<li class="list-group-item">
					<input type="file" name="gr2files[]" multiple="true" />
				</li>				
				
				<?php if(isset($oldFile[0]['fid'])): ?>
					<?php foreach($oldFile as &$list): 
						$fid = $list['fid'];
						$fnameArr = explode('/', $list['real_name']);
						$fname = $fnameArr[count($fnameArr) - 1];
						?>
						<li class="list-group-item">
							<input type="checkbox" name="deleteFileList[]" value="<?php echo $fid; ?>" /> 
							<?php echo $fname; ?> <span class="text-danger">(Check to delete)</span>
						</li>
					<?php endforeach; unset($fid, $fnameArr, $fname, $list); ?>
				<?php endif; ?>		
				
			<li class="list-group-item">
				<textarea id="gr2content" name="gr2content" placeholder="글의 내용을 여기에 입력해 주세요" class="form-control" style="height: 300px"><?php echo $oldData['content']; ?></textarea></li>
			<li class="list-group-item">
				<input type="text" name="gr2tag" value="<?php echo $oldData['tag']; ?>" placeholder="글의 핵심 단어들을 태킹 (쉼표로 구분: 공지,감사합니다,사랑)" class="form-control" /></li>
			</ul>
			
			<li class="list-group-item"><input type="submit" value="Submit" class="btn btn-success gr-width-full" /></li>
			<li class="list-group-item"><a href="<?php echo $boardLink; ?>/list/1" id="gr2writeCancelBtn" class="btn btn-danger gr-width-full">Cancel</a></li>
		</div>	
					
	</form>
</div>