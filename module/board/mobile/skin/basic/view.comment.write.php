	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $boardPost['no']; ?>" class="form">
		<div>
			<input type="hidden" name="family_uid" value="" />
			<input type="hidden" name="commentProceed" value="yes" />
		</div>
		<ul class="list-group">
			<?php if (!$Common->getSessionKey()): ?>
			<li class="list-group-item"><input type="text" name="simplelock" placeholder="(필수) 우측의 4자리 키 값 입력!" class="form-control" /> &middot;&middot;&middot; [<strong><?php echo $simplelock; ?></strong>]</li>
			<li class="list-group-item"><input type="text" name="name" placeholder="(필수) 이름" class="form-control" /> &middot;&middot;&middot; <strong>Name</strong></li>
			<li class="list-group-item"><input type="password" name="password" placeholder="(필수) 비밀번호" class="form-control" /> &middot;&middot;&middot; <strong>Pass</strong></li>
			<li class="list-group-item"><input type="email" name="email" placeholder="이메일" class="form-control" /> &middot;&middot;&middot; email</li>
			<li class="list-group-item"><input type="url" name="homepage" placeholder="웹사이트" class="form-control" /> &middot;&middot;&middot; homepage</li>
			<?php endif; ?>
			<li class="list-group-item"><input type="checkbox" name="secret" value="1" /> &middot;&middot;&middot; Secret</li>

			<li class="list-group-item"><textarea name="content" placeholder="답글 입력" class="form-control"></textarea></li>
			<li class="list-group-item"><input id="gr2sendComment" type="submit" value="Send" class="btn btn-primary gr-width-full" /></li>
		</ul>
	</form>