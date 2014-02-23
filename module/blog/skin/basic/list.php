<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="blog-header">
	<h1 class="blog-title"><?php echo $blogInfo['blog_title']; ?></h1>
	<p class="lead blog-description"><?php echo $blogInfo['blog_info']; ?></p>
</div>

<div id="blogMainBody" class="row">

	<div id="blogMainContent" class="col-sm-8 blog-main">
		<div id="blogPost">
			<?php foreach($blogPost as &$post): if(isset($post['uid'])): ?>
			<div class="blog-post">				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><a href="/<?php echo $grboard; ?>/blog/view/<?php echo $post['uid']; ?>">
							<?php echo $post['subject']; ?></a></h3>
					</div>
					<div class="panel-body size-text-normal">
						<?php echo $Common->getSubStr(strip_tags($post['content']), 300); ?>
						<hr />
						<div class="blogPostReply"><span class="badge"><?php echo $post['comment_count']; ?></span> Responses 
							<a href="/<?php echo $grboard; ?>/blog/view/<?php echo $post['uid']; ?>">
								<span class="glyphicon glyphicon-chevron-right"></span> Read more...</a></div>
					</div>
				</div>				
			</div>
			<?php endif; endforeach; unset($post, $blogPost); ?>
		</div>
		
		<ul id="blogPage" class="pagination">		
			<li class="<?php echo ($blogNowBlock < 2)?'disabled':''; ?>">
				<a href="/<?php echo $grboard; ?>/blog/list/page/<?php echo ($blogNowBlock > 1)?$ext_page-$blogInfo['num_per_page']:'1'; ?>">&laquo;</a></li>
	
			<?php foreach($blogPaging as &$pageNo): ?>
				<li class="<?php echo ($pageNo==$ext_page)?'active':''; ?>">
					<a href="/<?php echo $grboard; ?>/blog/list/page/<?php echo $pageNo; ?>"><?php echo $pageNo; ?></a></li>
			<?php endforeach; unset($pageNo, $blogPaging); ?>
	
			<li class="<?php echo ($blogNowBlock >= $blogTotalBlock)?'disabled':''; ?>">
				<a href="/<?php echo $grboard; ?>/blog/list/page/<?php echo ($ext_page + $blogInfo['num_per_page']); ?>">&raquo;</a></li>
		</ul>	
	</div>
	
