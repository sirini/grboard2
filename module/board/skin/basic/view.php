<?php 
if(!defined('GR_BOARD_2')) exit(); 
include 'util/common/image.resize.php';

function makeThumbnailPath($file, $width, $height) {
	$filenameArr = explode('.', $file['real_name']);
	$ext = end($filenameArr);
	$resized = false;
	if(preg_match('/(jpg|png|gif|bmp)/i', $ext)) {
		$resized = gr2ResizeImage('..' . $file['real_name'], '..' . $file['hash_name'], $width, $height, '__bbs_preview__');
		$resized = str_replace('../', '/', $resized); 
	}
	return $resized;
}
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">

<?php if(isset($boardCategory[0])): ?>
<header>
	<div class="category">

	<?php foreach($boardCategory as &$category): ?>
		<a href="<?php echo $boardLink; ?>/search/category/:<?php echo $category; ?>/1">
		<?php echo $category; ?></a> <span>|</span>
	<?php endforeach; unset($category); ?>
	
	</div>
</header>
<?php endif; ?>

<h2 class="title">
	<?php if(strlen($boardPost['category']) > 0): ?>
		<span class="category">[<?php echo $boardPost['category']; ?>]</span>
	<?php endif; ?>
	<?php echo $boardPost['subject']; ?>
</h2>

<div class="info">
	&nbsp;&nbsp;&middot; <?php echo $boardPost['name']; ?> (<span id="gr2userId"><?php echo $boardPost['writer_id']; ?></span>)
	<ul class="info">
		<?php if($boardPost['homepage']): ?><li>&middot; <a href="<?php echo $boardPost['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">homepage</a></li><?php endif; ?>
		<li>&middot; <?php echo date('Y.m.d H:i:s', $boardPost['signdate']); ?></li>
		<li>&middot; hit (<?php echo $boardPost['hit']; ?>)</li>
		<li>&middot; good (<?php echo $boardPost['good']; ?>)</li>
	</ul>
</div>

<div id="gr2viewContent" class="content">
	<?php if($fileList != false): ?>
	<ul class="fileList">
		<?php 
		foreach($fileList as &$file): 
			$filenameArr = explode('/', $file['real_name']);
			$filename = end($filenameArr);
			$thumbnail = makeThumbnailPath($file, 200, 200);
			$down = '/'.$grboard.'/board-'.$ext_id.'/download/'.$file['uid'];
		?>
			<li><a href="<?php echo $down; ?>" class="gr-btn gr-btn-info gr-btn-sm" title="클릭 하시면 파일을 내려 받습니다">Download</a> 
				<?php echo $filename; ?>
				
				<?php if($thumbnail): ?>
				<div class="thumbnailBox">
					<a href="<?php echo $down; ?>"><img src="<?php echo $thumbnail; ?>" alt="preview" class="gr-img-thumbnail" /></a>
				</div>	
				<?php endif; ?>
			</li>
		<?php endforeach; unset($file); ?>
	</ul>
	<?php endif; ?>
	
	<?php echo $boardPost['content']; ?>
</div>

<?php if(strlen($boardPost['tag']) > 0): ?>
<div class="tag"><?php echo $boardPost['tag']; ?></div>
<?php endif; ?>

<?php if(isset($replyList[0]['no'])): 
include 'view.comment.list.php'; 
endif; ?>

<?php if($userInfo['level'] >= $boardInfo['comment_write_level']): 
include 'view.comment.write.php'; 
endif; ?>

<ul class="viewBottoms">
	<li><a href="<?php echo $boardLink; ?>/list/1" class="gr-btn gr-btn-default">List</a></li>
	<li><a href="<?php echo $boardLink; ?>/write" class="gr-btn gr-btn-default">Write</a></li>
	<?php if (!$Common->getSessionKey()): ?>
		<li><a href="<?php echo $boardLink; ?>/login" class="gr-btn gr-btn-default">Login</a></li>
	<?php else: ?>
		<li><a href="<?php echo $boardLink; ?>/logout" class="gr-btn gr-btn-default">Logout</a></li>
	<?php endif; if(isPermitted($boardPost['member_key'], $Common->getSessionKey())): ?>
		<li><a href="<?php echo $boardLink; ?>/write/<?php echo $boardPost['no']; ?>" class="gr-btn gr-btn-default">Modify</a></li>
		<li><a href="<?php echo $boardLink; ?>/deletepost/<?php echo $boardPost['no']; ?>" class="gr-btn gr-btn-danger">Delete</a></li>
	<?php endif; ?>
</ul>

</div>