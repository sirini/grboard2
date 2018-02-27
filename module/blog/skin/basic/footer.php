			<?php if(isset($blogNowBlock)): ?>	
        	<ul class="pagination">		
        		<?php if($blogNowBlock > 1): ?>		
        		<li class="page-item">
        			<a href="<?php echo $pagingPrefix; echo ($blogNowBlock > 1)?$ext_page-$blogInfo['num_per_page']:'1'; ?>" aria-label="Previous">
        				<span aria-hidden="true">&laquo;</span>
        				<span class="sr-only">Prev</span></a></li>
        		<?php endif; ?>
        
        		<?php foreach($blogPaging as &$pageNo): ?>
        			<li class="page-item">
        				<a href="<?php echo $pagingPrefix; echo $pageNo; ?>" class="page-link"><?php echo $pageNo; ?></a></li>
        		<?php endforeach; unset($pageNo, $blogPaging); ?>
        
        		<?php if($blogNowBlock < $blogTotalBlock): ?>
        		<li class="page-item">
        			<a href="<?php echo $pagingPrefix; echo ($ext_page + $blogInfo['num_per_page']); ?>">
        				<span aria-hidden="true">&raquo;</span>
        				<span class="sr-only">Next</span></a></li>
        		<?php endif; ?>
        	</ul>	
        	<?php endif; ?>

        </div>
    </div>
	
	<div id="footer" class="container">
		<small class="text-muted">
			<a href="/<?php echo $grboard; ?>/blog/rss">RSS 2.0 Feed</a>,
			Powered by <a href="http://grboard.com">GR Board <sup>2</sup></a></small>
	</div>

</body>
</html>