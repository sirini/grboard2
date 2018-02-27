<?php if(!defined('GR_BOARD_2')) exit(); ?>

	<div id="blogSidebar" class="col-3">
		<div id="blogCategory" class="card text-white bg-dark">
			<h5 class="card-header bg-dark">Categories</h5>
			<div class="card-body">
			<?php foreach($blogCategory as &$cat): ?>
				<p><a href="/<?php echo $grboard; ?>/blog/category/<?php echo $cat['uid']; ?>">
					<?php echo stripslashes($cat['name']); ?></a></p>
			<?php endforeach; unset($cat, $blogCategory); ?>
			</div>
		</div>		
		
		<div id="blogRecentReply" class="card text-white bg-dark">
			<h5 class="card-header bg-dark">Recent replies</h5>
			<div class="card-body">
			<?php foreach($blogRecentReply as $uid => $array): ?>
				<p><a href="/<?php echo $grboard; ?>/blog/view/<?php echo $array['post_uid']; ?>">
					<?php echo $Common->getSubStr(strip_tags($array['content']), 36); ?></a></p>
			<?php endforeach; unset($uid, $content); ?>
			</div>
		</div>

		<div id="blogGuestbook" class="card text-white bg-dark">
			<h5 class="card-header bg-dark">Guestbook</h5>
			<div class="card-body">
			<?php foreach($blogGuestbook as $uid => $content): ?>
				<p><a href="/<?php echo $grboard; ?>/blog/guestbook#message<?php echo $uid; ?>">
					<?php echo $Common->getSubStr($content, 36); ?></a></p>
			<?php endforeach; unset($uid, $content); ?>
			</div>
		</div>
		
		<div id="blogLink" class="card text-white bg-dark">
			<h5 class="card-header bg-dark">My favorites</h5>
			<div class="card-body">
			<?php foreach($blogLink as $url => $name): ?>
				<p><a href="<?php echo $url; ?>"><?php echo $name; ?></a></p>
			<?php endforeach; unset($url, $name); ?>
			</div>
		</div>
	</div>