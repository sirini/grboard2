<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="inputReply">

	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $boardPost['no']; ?>">
		<div>
			<input type="hidden" name="family_uid" value="" />
			<input type="hidden" name="commentProceed" value="yes" />
		</div>
		<ul class="inputs">
			<li>Secret: <input type="checkbox" name="secret" value="1" /> (비밀글일 시 체크)</li>
			<?php if (!$Common->getSessionKey()): ?>
			<li>Spam<span class="red">*</span>: <input type="text" name="simplelock" placeholder="(필수) 우측의 4자리 키 값 입력!" /> <?php echo $simplelock; ?></li>
			<li>Name<span class="red">*</span>: <input type="text" name="name" placeholder="(필수) 이름" /></li>
			<li>Pass<span class="red">*</span>: <input type="password" name="password" placeholder="(필수) 비밀번호" /></li>
			<li>email: <input type="email" name="email" placeholder="이메일" /></li>
			<li>home: <input type="url" name="homepage" placeholder="웹사이트" /></li>
			<?php endif; ?>

			<li><textarea name="content" placeholder="답글 입력"></textarea></li>
			<li><input type="submit" value="Send" /></li>
		</ul>
	</form>

</div>