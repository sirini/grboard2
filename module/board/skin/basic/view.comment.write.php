<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="inputReply">

	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $boardPost['no']; ?>" class="form">
		<div>
			<input type="hidden" name="family_uid" value="" />
			<input type="hidden" name="commentProceed" value="yes" />
		</div>

		<?php if (!$Common->getSessionKey()): ?>

		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="Mr. Hong">
					<small id="nameHelp" class="form-text text-muted">이 곳에 이름(닉네임)을 입력하세요</small>
				</div>
				<div class="form-group">
					<label for="name">Password</label>
					<input type="password" class="form-control" name="password" aria-describedby="passwordHelp" placeholder="password">
					<small id="passwordHelp" class="form-text text-muted">이 곳에 글 수정/삭제를 위한 비밀번호를 입력하세요</small>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="name">Email</label>
					<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="example@website.com">
					<small id="emailHelp" class="form-text text-muted">이 곳에 이메일 주소를 입력하세요 (선택)</small>
				</div>
				<div class="form-group">
					<label for="name">Website</label>
					<input type="url" class="form-control" name="homepage" aria-describedby="homepageHelp" placeholder="http://example.com">
					<small id="homepageHelp" class="form-text text-muted">이 곳에 웹사이트 주소를 입력하세요 (선택)</small>
				</div>
			</div>
		</div>

		<!-- for Google reCAPTCHA | Please update your google reCAPTCHA sitekey/secretkey in common.config.php -->
		<div class="form-group">			
			<script src='<?php echo $gr2cfg['googleRecaptchaApiUrl']; ?>'></script>
			<div class="g-recaptcha" data-sitekey="<?php echo $gr2cfg['googleRecaptchaSiteKey']; ?>"></div>
		</div>

		<?php endif; ?>
		
		<div class="form-group">
			<label for="gr2CommentForm">Content</label>
			<textarea class="form-control" id="gr2CommentForm" name="content"></textarea>
		</div>
		
		<div class="form-group">
			<div class="form-check">
				<label class="form-check-label" for="secret" data-toggle="tooltip" data-placement="bottom" title="체크 하시면 비밀글로 설정 됩니다"> 
					<input class="form-check-input" type="checkbox" name="secret" id="secret" aria-describedby="secretHelp"> check for secret
				</label>
			</div>
			<input id="gr2sendComment" type="submit" value="SEND" class="btn btn-block btn-outline-primary" />
		</div>
	</form>

</div>