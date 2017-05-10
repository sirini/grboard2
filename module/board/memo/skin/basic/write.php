<form id="boardSendMemoForm" method="post" action="<?php echo $prePath; ?>/memo" class="form-horizontal">
	<div class="hiddenInputs">
		<input type="hidden" name="memoSendProceed" value"true" />
	</div>
	<fieldset>
		<legend><span class="glyphicon glyphicon-comment"></span> Send a message</legend>
		<div class="form-group">
			<label class="col-md-2 control-label" for="userId"><span class="glyphicon glyphicon-asterisk"></span> ID</label>		
			<div class="col-md-4">
				<input id="userId" name="userId" type="text" placeholder="여기에 쪽지를 보낼 대상자 아이디를 입력해 주세요" 
					required="true" autofocus="true" class="form-control input-md" value="<?php echo $oldData['id']; ?>" />
			</div>
			<span id="userIdInfo" class="col-md-6 help-block">상대방의 ID 를 입력해 주세요</span>
		</div>
		
		<div class="form-group">
			<label class="col-md-2 control-label" for="userIntro">Message</label>		
			<div class="col-md-4">
				<textarea id="userMsg" name="userMsg" placeholder="여기에 보낼 메시지를 250자 이내로 입력해 주세요." required="true" 
					class="form-control textarea-md" rows="5"><?php echo $oldData['memo']; ?></textarea>
			</div>
			<span class="col-md-6 help-block">메시지 내용은 250자 이내로 작성해 주세요</span>
		</div>
		
	</fieldset>
	
	<div class="form-group text-right">
		<input id="gr2sendMsgBtn" type="submit" class="btn btn-lg btn-primary" role="button" value="<?php echo ($oldData['id']) ? 'Reply' : 'Send'; ?>" />
	</div>
	
</form>