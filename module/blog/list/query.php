<?php
$query = array(
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
	'get_blog_post' => 'select * from ' . $db_prefix_blog . 'post where uid between {0} and {1} order by uid desc limit {2},{3}' ,
	'get_last_uid' => 'select uid from ' . $db_prefix_blog . 'post order by uid desc limit 1' ,
	'get_blog_post_count' => 'select count(*) as total_post from ' . $db_prefix_blog . 'post' ,
	'get_blog_notice' => 'select uid, subject from ' . $db_prefix_blog . 'post where post_condition = 2 order by uid desc limit {0}' ,
	'get_blog_recent_reply' => 'select uid, post_uid, content from ' . $db_prefix_blog . 'comment order by uid desc limit {0}' ,
	'get_blog_guestbook' => 'select uid, content from ' . $db_prefix_blog . 'guestbook order by uid desc limit {0}' ,
	'get_blog_link' => 'select url, name from ' . $db_prefix_blog . 'link order by uid asc' ,
	'get_blog_view' => 'select * from ' . $db_prefix_blog . 'post where uid = {0} limit 1' ,
	'get_blog_reply' => 'select * from ' . $db_prefix_blog . 'comment where post_uid = {0} order by family_uid asc, uid asc'
);
?>