<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Member group list</h4>

<div class="card-body">
	<form id="groupAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/member/group">
    	<div class="hiddenInputs">
    		<input type="hidden" name="groupFormSubmit" value="true" />
    		<input type="hidden" name="groupId" value="<?php echo $oldData['no']; ?>" />
    	</div>
    	
    	<div class="form-group">
    		<label for="name" class="control-label">Name</label>
    		<input type="text" name="name" id="name" class="form-control" required="true" maxlength="50" value="<?php echo $oldData['name']; ?>" />
    		<small class="form-text text-muted"><?php echo $lang['board_group_name']; ?></small>
    	</div>	
    	
    	<div class="form-group text-center">
    		<input type="submit" value="submit" class="btn btn-lg btn-primary btn-block" />
    	</div>
	
	</form>
	
	<table role="table" id="memberGroupList" class="table table-hover">
		<thead>
			<tr>
				<th scope="col" class="text-center">Name</th>
				<th scope="col" class="text-center">Members</th>
				<th scope="col" class="text-center">Signdate</th>
				<th scope="col" class="text-center">Modify</th>
				<th scope="col" class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($groupList as &$group) { ?>
			<tr>
				<td class="text-center"><?php echo $group['name']; ?></td>
				<td class="text-center"><?php echo number_format($group['members']); ?></td>
				<td class="text-center"><?php echo date('Y.m.d', $group['make_time']); ?></td>
				<td class="text-center"><a class="btn btn-primary" href="/<?php echo $grboard; ?>/board/admin/modify2membergroup/<?php echo $group['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['member_group_modify']; ?>">modify</a></td>
				<td class="text-center"><a class="btn btn-danger" href="/<?php echo $grboard; ?>/board/admin/delete2membergroup/<?php echo $group['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['member_group_delete']; ?>">delete</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</div>