<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Board list</h4>

<div class="card-body">
	<table role="table" id="boardList" class="table table-hover">
		<thead>
			<tr>
				<th scope="col" class="text-center">Group</th>
				<th scope="col" class="text-center">ID</th>
				<th scope="col" class="text-center">Name</th>
				<th scope="col" class="text-center">Skin</th>
				<th scope="col" class="text-center">Master</th>
				<th scope="col" class="text-center">Signdate</th>
				<th scope="col" class="text-center">Modify</th>
				<th scope="col" class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($boardList as &$board): ?>
			<tr>
				<td class="text-center"><?php echo $board['groupname']; ?></td>
				<td class="text-center"><a href="/<?php echo $grboard; ?>/board-<?php echo $board['id']; ?>/list" title="<?php echo $lang['board_list_id']; ?>"><?php echo $board['id']; ?></a></td>
				<td class="text-center"><?php echo $board['name']; ?></td>
				<td class="text-center"><?php echo $board['skin']; ?></td>
				<td class="text-center"><?php echo $board['master']; ?></td>
				<td class="text-center"><?php echo date('Y.m.d', $board['make_time']); ?></td>
				<td class="text-center"><a class="btn btn-primary" href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $board['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['board_list_modify']; ?>">modify</a></td>
				<td class="text-center"><a class="btn btn-danger" href="/<?php echo $grboard; ?>/board/admin/delete2board/<?php echo $board['no']; ?>" data-toggle="tooltip" title="<?php echo $lang['board_list_delete']; ?>">delete</a></td>
			</tr>
			<?php endforeach; unset($board); ?>
		</tbody>
	</table>
	
    <ul class="pagination">
    	<?php if($boardNowBlock > 1): ?>
    		<li class="page-item"><a class="page-link" href="<?php echo $prevLink; ?>" aria-label="Previous">
    			<span aria-hidden="true">&laquo;</span>
    			<span class="sr-only">Prev</span>
    		</a></li>
    	<?php endif; ?>
    
    	<?php foreach($boardPaging as &$pageNo): ?>
    		<li class="page-item<?php echo (($pageNo==$page)?' active':''); ?>">
    			<a class="page-link" href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
    	<?php endforeach; unset($pageNo); ?>
    
    	<?php if($boardNowBlock < $boardTotalBlock): ?>
    		<li class="page-item"><a class="page-link" href="<?php echo $nextLink; ?>" aria-label="Next">
    			<span aria-hidden="true">&raquo;</span>
    			<span class="sr-only">Next</span>
    		</a></li>
    	<?php endif; ?>
    </ul>	
	
</div>