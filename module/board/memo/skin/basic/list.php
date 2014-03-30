<div class="table-responsive">
<table role="table" class="table table-hover">
	<colgroup>
		<col class="col-md-1" />
		<col class="col-md-6" />
		<col class="col-md-2" />
		<col class="col-md-1" />
		<col class="col-md-1" />
		<col class="col-md-1" />
	</colgroup>
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Message</th>
			<th class="text-center">From</th>
			<th class="text-center">Date</th>
			<th class="text-center">Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($memoList[0]['no'])): foreach($memoList as &$memo): ?>
		<tr>
			<td class="text-center"><?php echo $memo['no']; ?></td>
			<td><?php echo nl2br($memo['memo']); ?></td>
			<td class="text-center"><?php echo $memo['from']; ?></td>
			<td class="text-center"><?php echo date('m.d H:i', $memo['signdate']); ?></td>
			<td class="text-center"><?php echo $memo['status']; ?></td>
			<td class="text-center">
				<?php if(!$memo['is_mine']): ?>
				<a href="<?php echo $prePath; ?>/memo/write/<?php echo $memo['no']; ?>" class="btn btn-sm btn-default">Reply</a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; unset($memo); endif; ?>
	</tbody>
</table>
</div>
	
<div class="container">
	<div class="col-md-8">
		<ul class="pagination">
			<?php if($memoNowBlock > 1): ?>
				<li><a href="<?php echo $prevLink; ?>">&laquo;</a></li>
			<?php endif; ?>
		
			<?php foreach($memoPaging as &$pageNo): ?>
				<li <?php echo (($pageNo==$page)?'class="active"':''); ?>><a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
			<?php endforeach; unset($pageNo); ?>
		
			<?php if($memoNowBlock < $memoTotalBlock): ?>
				<li><a href="<?php echo $nextLink; ?>">&raquo;</a></li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="col-md-4 text-right">
		<a href="<?php echo $prePath; ?>/memo/write/0" class="btn btn-lg btn-primary">Write</a>
	</div>
</div>