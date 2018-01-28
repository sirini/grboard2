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

    <h4 class="card-header">게시글 관리</h4>
    <div class="card-body">
    	
    	<form id="boardManageForm" method="post" action="<?php echo $boardLink; ?>/managepost">
    		<div class="hiddenInputs">
    			<input type="hidden" name="manageProceed" value="yes" />
    			<input type="hidden" name="manageTargets" value="<?php echo $checkedStr; ?>" />
    		</div>
    		
			<div class="card-title"><?php echo $ext_id; ?> 게시판에서 선택하신 <?php echo $checkedSize; ?> 개의 게시글(들)에 대하여</div>
			
            <table class="table table-borderless">
				<thead>
				<tr>
					<th scope="col">SELECT</th>
					<th scope="col">TARGET</th>
					<th scope="col">ACTION</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<th scope="row"><input type="radio" class="form-check-input" name="manageAction" value="delete" id="deleteAction" /></th>
					<td>-</td>
					<td><?php echo $checkedSize; ?>개 모두 삭제 합니다 (글에 달린 댓글과 첨부 파일까지 모두 삭제)</td>
                </tr>
                <tr>
                    <th scope="row"><input type="radio" class="form-check-input" name="manageAction" value="move" id="moveAction" /></th>
                    <td>
        				<select name="moveBoard" class="custom-select">
        					<?php foreach($boardLists as &$board): ?>
        					<option name="<?php echo $board; ?>" value="<?php echo $board; ?>"><?php echo $board; ?></option>	
        					<?php endforeach; ?>
        				</select>   
                    </td>
                    <td>게시글을 지정된 게시판으로 이동 합니다</td>
                </tr>
                <tr>
                    <th scope="row"><input type="radio" class="form-check-input" name="manageAction" value="copy" id="copyAction" /></th>
                    <td>
        				<select name="copyBoard" class="custom-select">
        					<?php foreach($boardLists as &$board): ?>
        					<option name="<?php echo $board; ?>" value="<?php echo $board; ?>"><?php echo $board; ?></option>	
        					<?php endforeach; ?>
        				</select>	
                    </td>
                    <td>게시글을 지정된 게시판에 복사 합니다</td>
                </tr>
                </tbody>
            </table>			
			
    		<div class="form-group">
    		    <input type="submit" value="OK" class="btn btn-outline-primary" />
    			<a href="<?php echo $boardLink; ?>/list" class="btn btn-outline-danger">Cancel</a>
    		</div>

    	</form>
    
    </div>

</div>