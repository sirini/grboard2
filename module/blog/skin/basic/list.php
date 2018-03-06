<?php 
if(!defined('GR_BOARD_2')) exit(); 
$pagingPrefix = '/' . $grboard . '/blog/list/page/';
if(strlen($searchValue) > 0) $pagingPrefix = '/' . $grboard . '/blog/search/all/' . $searchValue . '/';
?>
   	<div id="blogPostLists" class="col-9">
		<?php foreach($blogPost as &$post): if(isset($post['uid'])): ?>
		<div class="card">
			<h5 class="card-header">
				<a href="/<?php echo $grboard; ?>/blog/view/<?php echo $post['uid']; ?>"><?php if($post['post_condition'] == 0): ?>draft | <?php endif; ?>
				<?php echo $post['subject']; ?></a>				
			</h5>
			<div class="card-body">
				<p class="card-text"><?php echo $Common->getSubStr(strip_tags($post['content']), 300); ?></p>
			</div>
			<div class="card-footer bg-light">
				<div class="row">
					<div class="col">
						<a class="btn btn-sm btn-primary" href="/<?php echo $grboard; ?>/blog/view/<?php echo $post['uid']; ?>">Read more</a>
					</div>
					<div class="col text-right text-muted">
						<?php echo date('y.m.d H:i', $post['signdate']); ?>, <?php echo $post['comment_count']; ?> Responses
					</div>
				</div>
			</div>
		</div>
		<?php endif; endforeach; unset($post, $blogPost); ?>
	</div>
