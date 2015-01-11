<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">
	
<div>
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
		
		echo $post['subject'] . ' <span class="text-info"> / ' . $post['name'] . '</span>'; 
		
		if($post['comment_count'] > 0): ?>
			<span class="badge"><?php echo $post['comment_count']; ?></span>
		<?php endif; ?>
	</a>
<?php 
	endforeach; 
	unset($post); 
endif; 
?>
</div>

</form>
</div>

<?php
$prevLink = $boardLink . '/mobile/list/' . ($ext_page - $boardInfo['page_per_list']);
$nextLink = $boardLink . '/mobile/list/' . ($ext_page + $boardInfo['page_per_list']);
$pageLink = $boardLink . '/mobile/list/';
if(isset($option)) {
	$prevLink = $boardLink . '/mobile/' . $option . '/' . $value . '/' . ($ext_page - $boardInfo['page_per_list']);
	$nextLink = $boardLink . '/mobile/' . $option . '/' . $value . '/' . ($ext_page + $boardInfo['page_per_list']);
	$pageLink = $boardLink . '/mobile/' . $option . '/' . $value . '/';
}
?>

<footer>
	<ul class="pagination">
		<?php if($boardNowBlock > 1): ?>
			<li><a href="<?php echo $prevLink; ?>">Prev</a></li>
		<?php endif; ?>

		<?php foreach($boardPaging as &$pageNo): ?>
			<li><a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
		<?php endforeach; unset($pageNo); ?>

		<?php if($boardNowBlock < $boardTotalBlock): ?>
			<li><a href="<?php echo $nextLink; ?>">Next</a></li>
		<?php endif; ?>
	</ul>
</footer>

</div>

<?php unset($prevLink, $nextLink, $pageLink); ?>
