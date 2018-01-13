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
	<?php endif; echo $boardPost['subject']; ?>
</h2>

<div class="info">
	<span id="gr2userId" data-toggle="tooltip" data-placement="bottom" title="<?php echo $boardPost['writer_id']; ?>"><?php echo $boardPost['name']; ?></span>
	<ul class="info">
		<?php if($boardPost['homepage']): ?>
			<li><a href="<?php echo $boardPost['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">homepage</a></li>
		<?php endif; ?>
		<li><?php echo date('Y.m.d H:i:s', $boardPost['signdate']); ?></li>
		<li>hit: <?php echo $boardPost['hit']; ?></li>
		<li>good: <?php echo $boardPost['good']; ?></li>
	</ul>
</div>

<div id="gr2viewContent" class="content">
	<?php if($fileList != false): ?>
	<ul class="fileList">
		<?php 
		foreach($fileList as &$file): 
			if(!file_exists('..' . $file['hash_name'])) continue;

			$filenameArr = explode('/', $file['real_name']);
			$filename = end($filenameArr);
			$thumbnail = makeThumbnailPath($file, 200, 200);
			$down = '/'.$grboard.'/board-'.$ext_id.'/download/'.$file['uid'];
		?>
			<li><a href="<?php echo $down; ?>" class="btn btn-info btn-sm" title="클릭 하시면 파일을 내려 받습니다">Download</a> 
				<?php echo $filename; 
				if($thumbnail): ?>
				<div class="thumbnailBox">
					<a href="<?php echo $down; ?>"><img src="<?php echo $thumbnail; ?>" alt="preview" class="img-thumbnail" /></a>
				</div>	
				<?php endif; ?>
			</li>
		<?php endforeach; unset($file); ?>
	</ul>
	<?php endif; echo $boardPost['content']; ?>
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
	<li><a href="<?php echo $boardLink; ?>/list/1" data-toggle="tooltip" data-placement="bottom" title="첫 글 목록을 봅니다" class="btn btn-default">List</a></li>
	<li><a href="<?php echo $boardLink; ?>/write" data-toggle="tooltip" data-placement="bottom" title="새로운 글을 작성합니다" class="btn btn-default">Write</a></li>
	<?php if (!$Common->getSessionKey()): ?>
		<li><a href="<?php echo $boardLink; ?>/login" data-toggle="tooltip" data-placement="bottom" title="사이트에 로그인 합니다" class="btn btn-default">Login</a></li>
	<?php else: ?>
		<li><a href="<?php echo $boardLink; ?>/logout" data-toggle="tooltip" data-placement="bottom" title="로그아웃 합니다" class="btn btn-default">Logout</a></li>
	<?php endif; if(isPermitted($boardPost['member_key'], $Common->getSessionKey())): ?>
		<li><a href="<?php echo $boardLink; ?>/write/<?php echo $boardPost['no']; ?>" data-toggle="tooltip" data-placement="bottom" title="글을 수정 합니다" class="btn btn-default">Modify</a></li>
		<li><a href="<?php echo $boardLink; ?>/deletepost/<?php echo $boardPost['no']; ?>" data-toggle="tooltip" data-placement="bottom" title="이 글을 삭제 합니다" class="btn btn-danger">Delete</a></li>
	<?php endif; ?>
</ul>

</div>