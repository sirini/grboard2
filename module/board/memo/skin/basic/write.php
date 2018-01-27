<h4 class="card-header">내 쪽지함 - 쪽지 쓰기</h4>
<div class="card-body">
    <form id="boardSendMemoForm" method="post" action="<?php echo $prePath; ?>/memo" class="form-horizontal">
    	<div class="hiddenInputs">
    		<input type="hidden" name="memoSendProceed" value="true" />
    	</div>
    	
    	<div class="row">
    		<div class="col">
        		<div class="form-group">
        			<label class="control-label" for="userId">ID</label>
        			<input id="userId" name="userId" type="text" placeholder="여기에 쪽지를 보낼 대상자 아이디를 입력해 주세요" 
        				data-toggle="popover" title="혹시 찾으시는 분이...?" data-content="Searching..." data-placement="bottom"
        				required="true" autofocus="true" class="form-control" value="<?php echo $oldData['id']; ?>" />
        			<small id="userIdInfo" class="form-text text-muted">상대방의 ID 를 입력해 주세요</small>
        		</div>
    		</div>
    		<div class="col">
        		<div class="form-group">
        			<label class="control-label" for="userIntro">Message</label>
        			<textarea id="userMsg" name="userMsg" placeholder="여기에 보낼 메시지를 250자 이내로 입력해 주세요." required="true" 
        				class="form-control" rows="5"><?php echo $oldData['memo']; ?></textarea>
        			<small class="form-text text-muted">메시지 내용은 250자 이내로 작성해 주시고, 서로 에티켓을 꼭 지켜 주세요!</small>
        		</div>
    		</div>
    	</div>
    	
    	<div class="form-group text-right">
    		<input id="gr2sendMsgBtn" type="submit" class="btn btn-lg btn-primary btn-block" role="button" value="<?php echo ($oldData['id']) ? 'Reply' : 'Send'; ?>" />
    	</div>
    	
    </form>
</div>