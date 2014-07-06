<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="inputReply">

	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $boardPost['no']; ?>" class="gr-form">
		<div>
			<input type="hidden" name="family_uid" value="" />
			<input type="hidden" name="commentProceed" value="yes" />
		</div>
		<ul class="inputs">
			<?php if (!$Common->getSessionKey()): ?>
			<li><input type="text" name="simplelock" placeholder="(필수) 우측의 4자리 키 값 입력!" class="gr-form-input" /> &middot;&middot;&middot; <strong>Spam</strong> [<strong><?php echo $simplelock; ?></strong>]</li>
			<li><input type="text" name="name" placeholder="(필수) 이름" class="gr-form-input" /> &middot;&middot;&middot; <strong>Name</strong></li>
			<li><input type="password" name="password" placeholder="(필수) 비밀번호" class="gr-form-input" /> &middot;&middot;&middot; <strong>Pass</strong></li>
			<li><input type="email" name="email" placeholder="이메일" class="gr-form-input" /> &middot;&middot;&middot; email</li>
			<li><input type="url" name="homepage" placeholder="웹사이트" class="gr-form-input" /> &middot;&middot;&middot; homepage</li>
			<?php endif; ?>
			<li><input type="checkbox" name="secret" value="1" /> &middot;&middot;&middot; Secret (비밀글일 시 체크)</li>

			<li><textarea name="content" placeholder="답글 입력" class="gr-form-input"></textarea></li>
			<li><input type="submit" value="Send" class="gr-btn gr-btn-primary" /></li>
		</ul>
	</form>

</div>