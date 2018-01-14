<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">
	
<div class="card bg-light">
	<div class="card-header"><?php echo $boardInfo['name']; ?>'s posts</div>
	<div class="card-body">
        <form id="managePostForm" method="post" action="<?php echo $boardLink; ?>/managepost/0">
        <div class="hiddenInputs">
        	<input type="hidden" name="boardLink" value="<?php echo $boardLink; ?>" />
        </div>
        
        <div class="list-group">
            <?php 
            if(isset($boardNotice[0]['no'])): 
            	foreach($boardNotice as &$notice): 
            		$link = $boardLink . '/view/' . $notice['no'];
            ?>
            
            	<a href="<?php echo $link; ?>" class="list-group-item">
            		<?php echo $notice['subject']; 
            		if($notice['comment_count'] > 0): ?>
            			<span class="badge"><?php echo $notice['comment_count']; ?></span>
            		<?php endif; ?>
            	</a>
            
            <?php 
            	endforeach; 
            	unset($notice); 
            endif; 
            
            if(isset($boardPost[0]['no'])): 
            	foreach($boardPost as &$post): 
            		$link = $boardLink . '/view/' . $post['no'];
            ?>
            	<a href="<?php echo $link; ?>" class="list-group-item">
            		<?php if($isAdmin): ?>
            			<input type="checkbox" class="checkedPost" name="checkedArticle[]" value="<?php echo $post['no']; ?>" />
            		<?php endif; 
            		
            		if(isset($boardCategory[0]) && strlen($post['category']) > 0): ?>
            			<span class="text-primary">[<?php echo $post['category']; ?>]</span>
            		<?php endif;
            		
            		echo $post['subject'] . ' &nbsp; <span class="text-secondary"> / ' . $post['name'] . ' ('.date('m/d H:i', $post['signdate']).')</span>'; 
            		
            		if($post['comment_count'] > 0): ?>
            			<span class="badge badge-light"><?php echo $post['comment_count']; ?></span>
            		<?php endif; ?>
            	</a>
            <?php 
            	endforeach; 
            	unset($post); 
            endif; 
            ?>
        </div>
        </form>
        
    <?php
    $prevLink = $boardLink . '/list/' . ($ext_page - $boardInfo['page_per_list']);
    $nextLink = $boardLink . '/list/' . ($ext_page + $boardInfo['page_per_list']);
    $pageLink = $boardLink . '/list/';
    if(isset($option)) {
    	$prevLink = $boardLink . '/' . $option . '/' . $value . '/' . ($ext_page - $boardInfo['page_per_list']);
    	$nextLink = $boardLink . '/' . $option . '/' . $value . '/' . ($ext_page + $boardInfo['page_per_list']);
    	$pageLink = $boardLink . '/' . $option . '/' . $value . '/';
    }
    ?>
        
	<ul class="pagination">
		<?php if($boardNowBlock > 1): ?>
			<li class="page-item"><a href="<?php echo $prevLink; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>			
			</a></li>
		<?php endif; ?>

		<?php foreach($boardPaging as &$pageNo): ?>
			<li class="page-item <?php echo ($pageNo == $ext_page)?' active':''; ?>">
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
	
</div>

</div>

<?php unset($prevLink, $nextLink, $pageLink); ?>
