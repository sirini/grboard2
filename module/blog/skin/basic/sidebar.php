<?php if(!defined('GR_BOARD_2')) exit(); ?>

	<div id="blogSideContent" class="col-sm-4 blog-sidebar">
		<div id="blogRecentReply" class="sidebar-module sidebar-module-inset">
			<h4>Recent replies</h4>
			<ul class="list-unstyled">
			<?php foreach($blogRecentReply as $uid => $array): ?>
				<li><small><a class="text-info" href="/<?php echo $grboard; ?>/blog/view/<?php echo $array['post_uid']; ?>">
					<?php echo $Common->getSubStr(strip_tags($array['content']), 36); ?></a></small></li>
			<?php endforeach; unset($uid, $content); ?>
			</ul>
		</div>

		<div id="blogGuestbook" class="sidebar-module">
			<h4>Guestbook</h4>
			<ul class="list-unstyled">
			<?php foreach($blogGuestbook as $uid => $content): ?>
				<li><small><a class="text-info" href="/<?php echo $grboard; ?>/blog/guestbook#message<?php echo $uid; ?>">
					<?php echo $Common->getSubStr($content, 36); ?></a></small></li>
			<?php endforeach; unset($uid, $content); ?>
			</ul>
		</div>
		
		<div id="blogLink" class="sidebar-module">
			<h4>My favorites</h4>
			<ul class="list-unstyled">
			<?php foreach($blogLink as $url => $name): ?>
				<li><small><a class="text-info" href="<?php echo $url; ?>"><?php echo $name; ?></a></small></li>
			<?php endforeach; unset($url, $name); ?>
			</ul>
		</div>	
	</div>