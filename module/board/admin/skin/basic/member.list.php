<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Member list</h4>

<div class="card-body">
	<table role="table" id="memberList" class="table table-hover">
		<thead>
			<tr>
				<th scope="col" class="text-center">Group</th>
				<th scope="col" class="text-center">ID</th>
				<th scope="col" class="text-center">Nickname (Realname)</th>
				<th scope="col" class="text-center">Lv (Point)</th>
				<th scope="col" class="text-center">Last login</th>
				<th scope="col" class="text-center">Retry</th>
				<th scope="col" class="text-center">Signdate</th>
				<th scope="col" class="text-center">Modify</th>
				<th scope="col" class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($memberList as &$member) { ?>
			<tr>
				<td class="text-center"><?php echo $member['groupname']; ?></td>
				<td class="text-center"><?php echo $member['id']; ?></td>
				<td class="text-center"><?php echo $member['nickname']; ?> (<?php echo $member['realname']; ?>)</td>
				<td class="text-center"><?php echo $member['level']; ?> (<?php echo $member['point']; ?>)</td>
				<td class="text-center"><?php echo date('Y.m.d', $member['lastlogin']); ?></td>
				<td class="text-center"><?php echo $member['blocks']; ?></td>
				<td class="text-center"><?php echo date('Y.m.d', $member['make_time']); ?></td>
				<td class="text-center"><a class="btn btn-primary" href="/<?php echo $grboard; ?>/board/admin/modify2member/<?php echo $member['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['member_list_modify']; ?>">modify</a></td>
				<td class="text-center"><a class="btn btn-danger" href="/<?php echo $grboard; ?>/board/admin/delete2member/<?php echo $member['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['member_list_delete']; ?>">delete</a></td>
			</tr>
			<?php } unset($member); ?>
		</tbody>
	</table>
	
	<ul class="pagination">
		<?php if($memberNowBlock > 1): ?>
			<li class="page-item"><a class="page-link" href="<?php echo $prevLink; ?>" aria-label="Previous">
			    <span aria-hidden="true">&laquo;</span>
    			<span class="sr-only">Prev</span>
			</a></li>
		<?php endif; ?>
	
		<?php foreach($memberPaging as &$pageNo): ?>
			<li class="page-item<?php echo (($pageNo==$page)?' active':''); ?>">
				<a class="page-link" href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
		<?php endforeach; unset($pageNo); ?>
	
		<?php if($memberNowBlock < $memberTotalBlock): ?>
			<li class="page-item"><a class="page-link" href="<?php echo $nextLink; ?>" aria-label="Next">
    			<span aria-hidden="true">&raquo;</span>
    			<span class="sr-only">Next</span>
			</a></li>
		<?php endif; ?>
	</ul>

</div>