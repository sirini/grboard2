<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">

<?php if(isset($boardCategory[0])): ?>
<header>
	<div class="category">

	<?php foreach($boardCategory as &$category): ?>
		<a href="<?php echo $boardLink; ?>/category/<?php echo $category; ?>/1">
		<?php echo $category; ?></a> <span>|</span>
	<?php endforeach; unset($category); ?>
	
	</div>
</header>
<?php endif; ?>

<h2 class="title"><?php echo $boardPost['subject']; ?></h2>

<div class="info">
	<?php echo $boardPost['name']; ?>
	<ul class="info">
		<?php if($boardPost['homepage']): ?><li><a href="<?php echo $boardPost['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">(home)</a></li><?php endif; ?>
		<li><?php echo date('Y.m.d H:i:s', $boardPost['signdate']); ?></li>
		<li>hit(<?php echo $boardPost['hit']; ?>)</li>
		<li>good(<?php echo $boardPost['good']; ?>)</li>
	</ul>
</div>

<div class="content">
	<?php if($fileList != false): ?>
	<ul class="fileList">
		<?php foreach($fileList as &$file): ?>
			<li> - <a href="/<?php echo $grboard; ?>/board/download/<?php echo $file['uid']; ?>" title="클릭 하시면 파일을 내려 받습니다"><?php echo $file['real_name']; ?></a></li>
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
	<li><a href="<?php echo $boardLink; ?>/list/1">List</a></li>
	<li><a href="<?php echo $boardLink; ?>/write">Write</a></li>
	<?php if(isPermitted($boardPost['member_key'], $Common->getSessionKey())): ?>
		<li><a href="<?php echo $boardLink; ?>/deletepost/<?php echo $boardPost['no']; ?>">Delete</a></li>
		<li><a href="<?php echo $boardLink; ?>/write/<?php echo $boardPost['no']; ?>">Modify</a></li>
	<?php endif; ?>
	<?php if (!$Common->getSessionKey()): ?>
		<li><a href="<?php echo $boardLink; ?>/login">Login</a></li>
	<?php else: ?>
		<li><a href="<?php echo $boardLink; ?>/logout">Logout</a></li>
	<?php endif; ?>
</ul>

</div>