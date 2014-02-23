<?php 
if(!defined('GR_BOARD_2')) exit(); 

$blogNotice = $Model->getBlogNotice(5);
$blogRecentReply = $Model->getBlogRecentReply(5);
$blogGuestbook = $Model->getBlogGuestbook(5);

include $skinPath . '/header.php';
?>

	<div class="blog-header">
		<h1 class="blog-title"><?php echo $blogInfo['blog_title']; ?></h1>
		<p class="lead blog-description"><?php echo $blogInfo['blog_info']; ?></p>
	</div>
	
	<div id="blogMainBody" class="row">
	<?php		
	include $skinPath . '/guestbook.list.php';
	include $skinPath . '/sidebar.php';	
	unset($blogNotice, $blogRecentReply, $blogGuestbook);
	?>
	</div>

<?php include $skinPath . '/footer.php'; ?>