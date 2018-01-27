<h4 class="card-header">내 쪽지함 - 쪽지 목록</h4>
<div class="card-body">

    <table role="table" class="table table-striped">
    	<thead>
    		<tr>
    			<th scope="col" class="text-center">No</th>
    			<th scope="col" class="text-center">Contents</th>
    			<th scope="col" class="text-center">From</th>
    			<th scope="col" class="text-center">Date</th>
    			<th scope="col" class="text-center">Status</th>
    			<th scope="col" class="text-center">Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php 
    		if(isset($memoList[0]['no'])): 
    			foreach($memoList as &$memo):
    				$content = nl2br($memo['memo']);
    				$from = $memo['from'];
    				$date = date('Y.m.d H:i', $memo['signdate']);
    				$status = $memo['status'];
    				if($memo['status'] == 'send'):
    					$content = '<span class="text-muted">' . $content . '</span>';
    					$from = '<span class="text-muted">-</span>';
    					$date = '<span class="text-muted">' . $date . '</span>';
    					$status = '<span class="text-muted">sent</span>';
    				endif;
    		?>
    		<tr>
    			<th scope="row" class="text-center"><?php echo $memo['no']; ?></th>
    			<td><?php echo $content; ?></td>
    			<td class="text-center"><?php echo $from; ?></td>
    			<td class="text-center"><?php echo $date; ?></td>
    			<td class="text-center" data-toggle="tooltip" title="내가 보낸 쪽지 이며 상대방에게 전달 하였습니다"><?php echo $status; ?></td>
    			<td class="text-center">
    				<?php if(!$memo['is_mine']): ?>
    				<a href="<?php echo $prePath; ?>/memo/write/<?php echo $memo['no']; ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="여기를 클릭하여 답장을 보낼 수 있습니다">Reply</a>
    				<?php endif; ?>
    			</td>
    		</tr>
    		<?php endforeach; unset($memo); endif; ?>
    	</tbody>
    </table>
    	
    <div class="row">
    	<div class="col">
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
    	<div class="col text-right">
    		<a href="<?php echo $prePath; ?>/memo/write/0" class="btn btn-lg btn-primary" data-toggle="tooltip" title="새로운 쪽지를 작성 합니다. 보내고자 하는 분의 ID 를 알아야 합니다.">Write</a>
    	</div>
    </div>
</div>