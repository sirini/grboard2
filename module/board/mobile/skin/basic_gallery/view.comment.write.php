	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $boardPost['no']; ?>" class="form">
		<div>
			<input type="hidden" name="family_uid" value="" />
			<input type="hidden" name="commentProceed" value="yes" />
		</div>
		<ul class="list-group">
			<?php if (!$Common->getSessionKey()): ?>
			<li class="list-group-item"><input type="text" name="simplelock" placeholder="(필수) <?php echo $simplelock; ?> ← 입력해 주세요" class="form-control" /></li>
			<li class="list-group-item"><input type="text" name="name" placeholder="(필수) 이름" class="form-control" /></li>
			<li class="list-group-item"><input type="password" name="password" placeholder="(필수) 비밀번호" class="form-control" /></li>
			<?php endif; ?>
			<li class="list-group-item"><input type="checkbox" name="secret" value="1" /> &middot;&middot;&middot; Check to secret mode</li>

			<li class="list-group-item"><textarea name="content" placeholder="답글 입력" class="form-control"></textarea></li>
			<li class="list-group-item"><input id="gr2sendComment" type="submit" value="Send" class="btn btn-primary gr-width-full" /></li>
		</ul>
	</form>