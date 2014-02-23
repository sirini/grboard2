<?php if(!defined('GR_BOARD_2')) exit(); ?>

<fieldset>
<legend>Member group list</legend>

<form id="groupAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/member/group">
<div class="hiddenInputs">
	<input type="hidden" name="groupFormSubmit" value="true" />
	<input type="hidden" name="groupId" value="<?php echo $oldData['no']; ?>" />
</div>

<div class="form-group">
	<label for="name" class="col-md-2 control-label">Name</label>
	<div class="col-md-3">
		<input type="text" name="name" class="form-control" required="true" maxlength="50" value="<?php echo $oldData['name']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_group_name']; ?></span>
</div>	

<div class="form-group text-right">
	<input type="submit" value="<?php echo $submit; ?>" class="btn btn-lg btn-primary" />
</div>

</form>
</fieldset>

<div class="table-responsive">
<table rules="none" id="memberGroupList" class="table table-striped table-hover">
	<colgroup>
		<col class="col-md-4" />
		<col class="col-md-2" />
		<col class="col-md-2" />
		<col class="col-md-2" />
		<col class="col-md-2" />
	</colgroup>
	<thead>
		<tr>
			<th>Name</th>
			<th>Members</th>
			<th>Signdate</th>
			<th>Modify</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($groupList as &$group) { ?>
		<tr>
			<td><?php echo $group['name']; ?></td>
			<td><?php echo number_format($group['members']); ?></td>
			<td><?php echo date('Y.m.d', $group['make_time']); ?></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/modify2membergroup/<?php echo $group['no']; ?>" title="<?php echo $lang['member_group_modify']; ?>">modify</a></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/delete2membergroup/<?php echo $group['no']; ?>" title="<?php echo $lang['member_group_delete']; ?>">delete</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>