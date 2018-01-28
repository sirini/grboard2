<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Saved</h4>

<div class="card-body">
	<table role="table" id="boardAdd" class="table">
		<thead>
			<tr>
				<th scope="col" class="text-center">Item</th>
				<th scope="col" class="text-center">Information</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center">Status</td>
				<td class="text-center"><?php echo $lang['board_save_status']; ?></td>
			</tr>
			<tr>
				<td class="text-center">Link</td>
				<td class="text-center">
					<a href="/<?php echo $grboard; ?>/board-<?php echo $boardId; ?>/list/1">
						<?php echo $lang['board_save_link']; ?></a></td>
			</tr>
			<tr>
				<td class="text-center">Modify</td>
				<td class="text-center">				
					<a href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $boardId; ?>">
						<?php echo $lang['board_save_modify']; ?></a></td>
			</tr>
		</tbody>
	</table>
</div>