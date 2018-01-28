<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Board group list</h4>

<div class="card-body">
	<form id="groupAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/board/group">
	<div class="hiddenInputs">
		<input type="hidden" name="groupFormSubmit" value="true" />
		<input type="hidden" name="groupId" value="<?php echo $oldData['no']; ?>" />
	</div>
	
	<div class="row">
		<div class="col">
        	<div class="form-group">
        		<label for="name" class="control-label">Name</label>
        		<input type="text" name="name" class="form-control" required="true" maxlength="50" value="<?php echo $oldData['name']; ?>" />
        		<small class="form-text text-muted"><?php echo $lang['board_group_name']; ?></small>
        	</div>
		</div>
		<div class="col">
        	<div class="form-group">
        		<label for="master" class="control-label">Masters</label>
        		<input type="text" name="master" class="form-control" maxlength="50" value="<?php echo $oldData['master']; ?>" />
        		<small class="form-text text-muted"><?php echo $lang['board_group_master']; ?></small>
        	</div>	
		</div>
	</div>
	
	<div class="form-group">
		<input type="submit" value="<?php echo $submit; ?>" class="btn btn-lg btn-primary btn-block" />
	</div>					
	</form>
	
	<table role="table" id="boardGroupList" class="table">
		<thead>
			<tr>
				<th scope="col" class="text-center">Name</th>
				<th scope="col" class="text-center">Master</th>
				<th scope="col" class="text-center">Boards</th>
				<th scope="col" class="text-center">Signdate</th>
				<th scope="col" class="text-center">Modify</th>
				<th scope="col" class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($groupList as &$group) { ?>
			<tr>
				<td class="text-center"><?php echo $group['name']; ?></td>
				<td class="text-center"><?php echo $group['master']; ?></td>
				<td class="text-center"><?php echo number_format($group['boards']); ?></td>
				<td class="text-center"><?php echo date('Y.m.d', $group['make_time']); ?></td>
				<td class="text-center"><a class="btn btn-primary" href="/<?php echo $grboard; ?>/board/admin/modify2group/<?php echo $group['no']; ?>" title="<?php echo $lang['board_group_modify']; ?>">modify</a></td>
				<td class="text-center"><a class="btn btn-danger" href="/<?php echo $grboard; ?>/board/admin/delete2group/<?php echo $group['no']; ?>" title="<?php echo $lang['board_group_delete']; ?>">delete</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
	
</div>