<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Delete a board</h4>

<div class="card-body">
	<form id="boardDeleteForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/delete2board/<?php echo $boardId; ?>">
	<div class="hiddenInputs">
		<input type="hidden" name="boardDeleteId" value="<?php echo $boardInfo['id']; ?>" />
	</div>
	<table role="none" id="boardDelete" class="table">
		<thead>
			<tr>
				<th scope="col">Item</th>
				<th scope="col">Information</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Delete ID</td>
				<td><a href="/<?php echo $grboard; ?>/board-<?php echo $boardInfo['id']; ?>/list">
					<?php echo $boardInfo['id']; ?></a></td>
			</tr>
			<tr>
				<td>Board Name</td>
				<td><?php echo $boardInfo['name']; ?></td>
			</tr>
			<tr>
				<td>Message</td>
				<td><?php echo $lang['board_delete_message']; ?></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center">
					<a href="/<?php echo $grboard; ?>/board/admin/board/list" class="btn btn-lg btn-default">Cancel</a>
					<input type="submit" value="OK" class="btn btn-lg btn-danger" data-toggle="tooltip" title="이 작업은 되돌릴 수 없습니다. 반드시 삭제해야 할 경우에만 클릭 하세요." />					
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</div>