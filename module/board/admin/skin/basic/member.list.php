<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h2>Member list</h2>

<div class="table-responsive">
<table rules="none" id="memberList" class="table table-striped table-hover">
	<colgroup>
		<col class="col-md-1" />
		<col class="col-md-2" />
		<col class="col-md-2" />
		<col class="col-md-2" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
	</colgroup>
	<thead>
		<tr>
			<th>Group</th>
			<th>ID</th>
			<th>Nickname (Realname)</th>
			<th>Lv (Point)</th>
			<th>Last login</th>
			<th>Retry</th>
			<th>Signdate</th>
			<th>Modify</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($memberList as &$member) { ?>
		<tr>
			<td><?php echo $member['groupname']; ?></td>
			<td><?php echo $member['id']; ?></td>
			<td><?php echo $member['nickname']; ?> (<?php echo $member['realname']; ?>)</td>
			<td><?php echo $member['level']; ?> (<?php echo $member['point']; ?>)</td>
			<td><?php echo date('Y.m.d', $member['lastlogin']); ?></td>
			<td><?php echo $member['blocks']; ?></td>
			<td><?php echo date('Y.m.d', $member['make_time']); ?></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/modify2member/<?php echo $member['no']; ?>" title="<?php echo $lang['member_list_modify']; ?>">modify</a></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/delete2member/<?php echo $member['no']; ?>" title="<?php echo $lang['member_list_delete']; ?>">delete</a></td>
		</tr>
		<?php } unset($member); ?>
	</tbody>
</table>
</div>

<ul class="pagination">
	<?php if($memberNowBlock > 1): ?>
		<li><a href="<?php echo $prevLink; ?>">&laquo;</a></li>
	<?php endif; ?>

	<?php foreach($memberPaging as &$pageNo): ?>
		<li <?php echo (($pageNo==$page)?'class="active"':''); ?>><a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
	<?php endforeach; unset($pageNo); ?>

	<?php if($memberNowBlock < $memberTotalBlock): ?>
		<li><a href="<?php echo $nextLink; ?>">&raquo;</a></li>
	<?php endif; ?>
</ul>