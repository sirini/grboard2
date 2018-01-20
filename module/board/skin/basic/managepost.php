<?php 
if(!defined('GR_BOARD_2')) exit(); 

if(!isset($_POST['checkedArticle'])) $Common->error('Wrong access', $boardLink);
$checked = $_POST['checkedArticle'];
$checkedSize = count($checked);
$checkedStr = '';
foreach($checked as &$check) {
	$checkedStr .= $check . ';';
}
$boardLists = $Model->getBoardList();
?>

<div id="GRBOARD2" class="card bg-light">

    <h4 class="card-header">Managing posts</h4>
    <div class="card-body">
    	
    	<form id="boardManageForm" method="post" action="<?php echo $boardLink; ?>/managepost">
    		<div class="hiddenInputs">
    			<input type="hidden" name="manageProceed" value="yes" />
    			<input type="hidden" name="manageTargets" value="<?php echo $checkedStr; ?>" />
    		</div>
    		
			<div class="card-title"><?php echo $ext_id; ?> 게시판에서 선택하신 <?php echo $checkedSize; ?> 개의 게시글(들)에 대하여</div>
			<div class="card-text">
				<div class="form-check">
					<label for="deleteAction" class="form-check-label red" data-toggle="tooltip" title="삭제 작업은 다시 되돌릴 수 없습니다. 신중히 선택해 주세요.">	
						<input type="radio" class="form-check-input" name="manageAction" value="delete" id="deleteAction" />
						<?php echo $checkedSize; ?>개 모두 삭제 합니다 (글에 달린 댓글과 첨부 파일까지 모두 삭제)
					</label>
				</div>
				<div class="form-group row">
					<input type="radio" class="col-sm-2" name="manageAction" value="move" id="moveAction" />
					<select name="moveBoard" class="form-control col-sm-10">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>" value="<?php echo $board; ?>"><?php echo $board; ?> 게시판으로 이동 하기</option>	
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group row">
					<input type="radio" class="col-sm-2" name="manageAction" value="copy" id="copyAction" />
					<select name="copyBoard" class="form-control col-sm-10">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>" value="<?php echo $board; ?>"><?php echo $board; ?> 게시판으로 복사 하기</option>	
						<?php endforeach; ?>
					</select>
				</div>			
			</div>
    		
    		<input type="submit" value="OK" class="btn btn-outline-primary" />
    		<a href="<?php echo $boardLink; ?>/list" class="btn btn-outline-danger">Cancel</a>
    	</form>
    
    </div>

</div>