<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h2>Board list</h2>

<div class="table-responsive">
<table rules="none" id="boardList" class="table table-striped table-hover">
	<colgroup>
		<col class="col-md-1" />
		<col class="col-md-2" />
		<col class="col-md-2"/>
		<col class="col-md-3" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
	</colgroup>
	<thead>
		<tr>
			<th>Group</th>
			<th>ID</th>
			<th>Name</th>
			<th>Skin</th>
			<th>Master</th>
			<th>Signdate</th>
			<th>Modify</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($boardList as &$board) { ?>
		<tr>
			<td><?php echo $board['groupname']; ?></td>
			<td><a href="/<?php echo $grboard; ?>/board-<?php echo $board['id']; ?>/list" title="<?php echo $lang['board_list_id']; ?>"><?php echo $board['id']; ?></a></td>
			<td><?php echo $board['name']; ?></td>
			<td><?php echo $board['skin']; ?></td>
			<td><?php echo $board['master']; ?></td>
			<td><?php echo date('Y.m.d', $board['make_time']); ?></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $board['no']; ?>" title="<?php echo $lang['board_list_modify']; ?>">modify</a></td>
			<td><a href="/<?php echo $grboard; ?>/board/admin/delete2board/<?php echo $board['no']; ?>" title="<?php echo $lang['board_list_delete']; ?>">delete</a></td>
		</tr>
		<?php } unset($board); ?>
	</tbody>
</table>
</div>

<ul class="pagination">
	<?php if($boardNowBlock > 1): ?>
		<li><a href="<?php echo $prevLink; ?>">&laquo;</a></li>
	<?php endif; ?>

	<?php foreach($boardPaging as &$pageNo): ?>
		<li <?php echo (($pageNo==$page)?'class="active"':''); ?>><a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
	<?php endforeach; unset($pageNo); ?>

	<?php if($boardNowBlock < $boardTotalBlock): ?>
		<li><a href="<?php echo $nextLink; ?>">&raquo;</a></li>
	<?php endif; ?>
</ul>