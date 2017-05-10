<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="panel-heading">
	<h3 class="panel-title"><strong>Delete a board</strong></h3>
</div>

<div class="panel-body">
	<form id="boardDeleteForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/delete2board/<?php echo $boardId; ?>">
	<div class="hiddenInputs">
		<input type="hidden" name="boardDeleteId" value="<?php echo $boardInfo['id']; ?>" />
	</div>
	<table rules="none" id="boardDelete" class="table table-striped">
		<colgroup>
			<col class="col-md-3" />
			<col class="col-md-9" />
		</colgroup>
		<thead>
			<tr>
				<th>Item</th>
				<th>Information</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Delete ID</td>
				<td>				
					<a href="/<?php echo $grboard; ?>/board-<?php echo $boardInfo['id']; ?>/list"><span><?php echo $boardInfo['id']; ?></span></a></td>
			</tr>
			<tr>
				<td>Board Name</td>
				<td>				
					<span><?php echo $boardInfo['name']; ?></span></td>
			</tr>
			<tr>
				<td>Message</td>
				<td>				
					<span><?php echo $lang['board_delete_message']; ?></span></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">
					<a href="/<?php echo $grboard; ?>/board/admin/board/list" class="btn btn-lg btn-default">Cancel</a>
					<input type="submit" value="OK" class="btn btn-lg btn-primary" />					
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</div>