<?php 
if(!defined('GR_BOARD_2')) exit(); 
include 'util/common/image.resize.php';

function getThumbnailPath($Model, $id, $no, $width, $height) {
	global $skinResourcePath;
	$firstAttach = $Model->getFirstAttached($id, $no);
	$resized = $skinResourcePath . '/no_image.png';
	if(strlen($firstAttach['real_name']) > 0) {
		$pathArr = explode('.', $firstAttach['real_name']);
		$ext = end($pathArr);
		if(preg_match('/(jpg|png|gif|bmp)/i', $ext)) {
			$resized = gr2ResizeImage('..' . $firstAttach['real_name'], '..' . $firstAttach['hash_name'], $width, $height, '__gallery__');
			$resized = str_replace('../', '/', $resized); 
		}
	}
	return $resized;
}
?>

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
?>
</div>

<div id="gr2thumbnails">
<?php
if(isset($boardPost[0]['no'])): 
	foreach($boardPost as &$post): 
		$link = $boardLink . '/view/' . $post['no'];
		$thumbnail = getThumbnailPath($Model, $ext_id, $post['no'], 150, 150);
?>
	<div class="gr-thumbnail">
	<a href="<?php echo $link; ?>">

		<img src="<?php echo $thumbnail; ?>" alt="preview" class="img-thumbnail">
		
		<?php if($isAdmin): ?>
			<input type="checkbox" class="checkedPost" name="checkedArticle[]" value="<?php echo $post['no']; ?>" />
		<?php endif; ?>
	</a>
	</div>
<?php 
	endforeach; 
	unset($post); 
endif; 
?>
	<div class="gr-clear"></div>
</div>

</form>
</div>

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

<footer>
	<ul class="pagination">
		<?php if($boardNowBlock > 1): ?>
			<li><a href="<?php echo $prevLink; ?>" aria-label="Previous">&laquo;</a></li>
		<?php endif; ?>

		<?php foreach($boardPaging as &$pageNo): ?>
			<li <?php echo ($pageNo == $ext_page)?'class="active"':''; ?>>
				<a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
		<?php endforeach; unset($pageNo); ?>

		<?php if($boardNowBlock < $boardTotalBlock): ?>
			<li><a href="<?php echo $nextLink; ?>" aria-label="Next">&raquo;</a></li>
		<?php endif; ?>
	</ul>
</footer>

</div>

<?php unset($prevLink, $nextLink, $pageLink); ?>
