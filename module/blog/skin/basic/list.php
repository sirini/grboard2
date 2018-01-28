<?php 
if(!defined('GR_BOARD_2')) exit(); 
$pagingPrefix = '/' . $grboard . '/blog/list/page/';
if(strlen($searchValue) > 0) $pagingPrefix = '/' . $grboard . '/blog/search/all/' . $searchValue . '/';
?>
    <h4 class="blog-title"><?php echo $blogInfo['blog_title']; ?></h4>
    <p class="blog-description"><?php echo $blogInfo['blog_info']; ?></p>
    
    <div id="blogMainBody">
    	
    	<div id="blogMainContent" class="col-sm-8">

			<?php foreach($blogPost as &$post): if(isset($post['uid'])): ?>
			<div class="card bg-light">
				<div class="card-body">
					<h5>
						<?php if($post['post_condition'] == 0): ?>draft | <?php endif; ?>
						<?php echo $post['subject']; ?>
					</h5>
					<?php echo $Common->getSubStr(strip_tags($post['content']), 300); ?>
				</div>
				<div class="card-footer">
					<a class="btn btn-primary" href="/<?php echo $grboard; ?>/blog/view/<?php echo $post['uid']; ?>">Read more</a>
					<small class="text-muted"><?php echo date('Y.m.d H:i', $post['signdate']); ?>, <?php echo $post['comment_count']; ?> Responses</small>
				</div>
			</div>
			<?php endif; endforeach; unset($post, $blogPost); ?>
    		
    		<ul id="blogPage" class="pagination">		
    			<li class="<?php echo ($blogNowBlock < 2)?'disabled':''; ?>">
    				<a href="<?php echo $pagingPrefix; echo ($blogNowBlock > 1)?$ext_page-$blogInfo['num_per_page']:'1'; ?>">&laquo;</a></li>
    	
    			<?php foreach($blogPaging as &$pageNo): ?>
    				<li class="<?php echo ($pageNo==$ext_page)?'active':''; ?>">
    					<a href="<?php echo $pagingPrefix; echo $pageNo; ?>"><?php echo $pageNo; ?></a></li>
    			<?php endforeach; unset($pageNo, $blogPaging); ?>
    	
    			<li class="<?php echo ($blogNowBlock >= $blogTotalBlock)?'disabled':''; ?>">
    				<a href="<?php echo $pagingPrefix; echo ($ext_page + $blogInfo['num_per_page']); ?>">&raquo;</a></li>
    		</ul>	
    	</div>