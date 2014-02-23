<?php 
if(!defined('GR_BOARD_2')) exit(); 

if($postTarget == 0):
	$oldData = array('is_notice'=>0, 'is_secret'=>0, 'name'=>'', 'email'=>'', 'homepage'=>'',  'subject'=>'', 'content'=>'', 'tag'=>'');
endif;
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">

<h2 class="title">Write</h2>

<div class="boardWrite">
	
	<div class="boardWriteBox">
	<form id="boardWriteForm" method="post" action="<?php echo $boardLink; ?>/write/<?php echo $postTarget; ?>">
	<div id="hiddenInputs">
		<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
		<input type="hidden" name="writeProceed" value="yes" />
		<input type="hidden" name="boardId" id="boardId" value="<?php echo $ext_id; ?>" />
	</div>
		<ul>
			<li>Options: 
				<?php if($Common->getSessionKey()): ?>
					<input type="checkbox" name="isNotice" value="1" <?php echo ($oldData['is_notice']) ? 'checked="true"':''; ?> />notice
				<?php endif; ?>
				<input type="checkbox" name="isSecret" value="1" <?php echo ($oldData['is_secret']) ? 'checked="true"':''; ?> />secret 
				<input type="checkbox" name="isReplyable" value="1" checked="checked" />reply 
			</li>
			
			<?php if (!$Common->getSessionKey()): ?>
			<li><strong>Spam</strong><span class="red">*</span>: <input type="text" name="gr2simplelock" placeholder="(필수) 우측의 5자리 키 값 입력!" title="오른쪽에 붉은색 글씨대로 그대로 입력해 주시면 됩니다" /> <span class="red"><?php echo $simplelock; ?></span></li>
			<li><strong>Name</strong><span class="red">*</span>: <input type="text" name="gr2name" value="<?php echo $oldData['name']; ?>" placeholder="(필수) 이름" title="본인을 구별할 수 있는 이름(혹은 닉네임)을 입력해 주세요" /></li>
			<li><strong>Pass</strong><span class="red">*</span>: <input type="password" name="gr2password" placeholder="(필수) 비밀번호" title="비밀번호는 관리자도 알 수 없습니다" /></li>
			<li>email: <input type="email" name="gr2email" placeholder="이메일" value="<?php echo $oldData['email']; ?>" title="추가적으로 이메일 주소를 입력 하실 수 있습니다" /></li>
			<li>home: <input type="url" name="gr2homepage" placeholder="웹사이트" value="<?php echo $oldData['homepage']; ?>" title="본인의 웹사이트 (혹은 블로그/SNS)가 있다면 주소를 입력해 주세요" /></li>
			<?php endif; ?>

			<li><strong>Subject</strong><span class="red">*</span>: <input type="text" name="gr2subject" required="true" placeholder="글 제목을 입력" class="longWidth" value="<?php echo $oldData['subject']; ?>" /></li>
			<li>
				<div id="gr2dndUpload" title="여기에 업로드 할 파일을 끌어다 놓으세요">
					<div id="gr2dndMsg">이 곳에 업로드 할 파일을 끌어다 놓으세요</div>
				</div>
				<div class="clear"></div>
			</li>
			<li>
				<?php if(array_key_exists('fid', $oldFile[0])): ?>
				<ul class="gr2fileList">
				<?php foreach($oldFile as &$list): 
					$fid = $list['fid'];
					$fnameArr = explode('/', $list['real_name']);
					$fname = $fnameArr[count($fnameArr) - 1];
					?>
					<li><input type="checkbox" name="deleteFileList[]" value="<?php echo $fid; ?>" title="이 첨부파일을 삭제 하고자 할 경우 체크해 주세요" /> <?php echo $fname; ?></li>
				<?php endforeach; unset($fid, $fnameArr, $fname, $list); ?>
				</ul>
				<?php endif; ?>
			</li>			
			<li><textarea id="gr2content"><?php echo $oldData['content']; ?></textarea></li>
			<li>T a g s: <input type="text" name="gr2tag" value="<?php echo $oldData['tag']; ?>" placeholder="글의 핵심 단어들을 태킹 (쉼표로 구분)" class="longWidth" /></li>
		</ul>
		<input type="submit" value="Submit" />
		<a href="<?php echo $boardLink; ?>/list/1">Cancel</a>
	</form>
	</div>

</div>

</div>