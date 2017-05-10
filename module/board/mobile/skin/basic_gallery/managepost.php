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
	<form id="boardManageForm" method="post" action="<?php echo $boardLink; ?>/managepost/0">
		<div class="hiddenInputs">
			<input type="hidden" name="manageProceed" value="yes" />
			<input type="hidden" name="manageTargets" value="<?php echo $checkedStr; ?>" />
		</div>
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h3 class="panel-title">Managing posts</h3>
			</div>
			
			<div class="panel-body">				
				<strong><?php echo $ext_id; ?></strong> 게시판에서 선택하신 <strong><?php echo $checkedSize; ?></strong> 개의 게시글(들)에 대하여
			</div>
			
			<ul class="list-group">
				<li class="list-group-item">
					<input type="radio" name="manageAction" value="delete" id="deleteAction" /> 
					<label for="deleteAction" class="text-danger">
						<?php echo $checkedSize; ?>개 모두 삭제 합니다 (글에 달린 댓글과 첨부 파일까지 모두 삭제)</label>
				</li>
				<li class="list-group-item">
					<input type="radio" name="manageAction" value="move" id="moveAction" />
					<select name="moveBoard">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>"><?php echo $board; ?></option>	
						<?php endforeach; ?>
					</select>
					 <label for="moveAction">(으)로 <strong>이동</strong> 합니다</label>
				</li>
				<li class="list-group-item">
					<input type="radio" name="manageAction" value="copy" id="copyAction" />
					<select name="copyBoard">
						<?php foreach($boardLists as &$board): ?>
						<option name="<?php echo $board; ?>"><?php echo $board; ?></option>	
						<?php endforeach; ?>
					</select>
					 <label for="copyAction">(으)로 <strong>복사</strong> 합니다</label>
				</li>
				<li class="list-group-item"><input type="submit" value="Execute" class="btn btn-primary gr-width-full" />
				<li class="list-group-item"><a href="<?php echo $boardLink; ?>/list/1" class="btn btn-default gr-width-full">Cancel</a>				
			</ul>
			
		</div>
	</form>
</div>