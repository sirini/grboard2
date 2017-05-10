<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h3>Saved</h3>

<table rules="none" id="memberAdd" class="table table-striped">
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
			<td>Status</td>
			<td>				
				<span><?php echo $lang['member_save_status']; ?></span></td>
		</tr>
		<?php if($memberUid > 0) { ?>
		<tr>
			<td>Modify</td>
			<td>				
				<a href="/<?php echo $grboard; ?>/board/admin/modify2member/<?php echo $memberUid; ?>"><span><?php echo $lang['member_save_modify']; ?></span></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>