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

<div id="GRBOARD2">

<h2 class="title">Managing posts</h2>

<div class="boardManage">
	
	<div class="boardManageBox">
	<form id="boardManageForm" method="post" action="<?php echo $boardLink; ?>/managepost">
		<div class="hiddenInputs">
			<input type="hidden" name="manageProceed" value="yes" />
			<input type="hidden" name="manageTargets" value="<?php echo $checkedStr; ?>" />
		</div>
		
		<div class="manageOptionBox gr-panel-body">
			<strong><?php echo $ext_id; ?></strong> 게시판에서 선택하신 <?php echo $checkedSize; ?> 개의 게시글(들)에 대하여
			<ol>
				<li><input type="radio" name="manageAction" value="delete" id="deleteAction" /> 
					<label for="deleteAction" class="red" title="삭제 작업은 다시 되돌릴 수 없습니다. 신중히 선택해 주세요.">
						<?php echo $checkedSize; ?>개 모두 삭제 합니다 (글에 달린 댓글과 첨부 파일까지 모두 삭제)</label></li>
				<li><input type="radio" name="manageAction" value="move" id="moveAction" />
					<select name="moveBoard">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>"><?php echo $board; ?></option>	
						<?php endforeach; ?>
					</select>
					 <label for="moveAction">(으)로 <strong>이동</strong> 합니다</label></li>
				<li><input type="radio" name="manageAction" value="copy" id="copyAction" />
					<select name="copyBoard">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>"><?php echo $board; ?></option>	
						<?php endforeach; ?>
					</select>
					 <label for="copyAction">(으)로 <strong>복사</strong> 합니다</label></li>
			</ol>
		</div>
		
		<input type="submit" value="OK" class="gr-btn gr-btn-primary" />
		<a href="<?php echo $boardLink; ?>/list" class="gr-btn gr-btn-danger">Cancel</a>
	</form>
	</div>

</div>

</div>