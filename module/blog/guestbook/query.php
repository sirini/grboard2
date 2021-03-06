<?php
$query = array(
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
	'get_guestbook_list' => 'select * from ' . $db_prefix_blog . 'guestbook where uid between {0} and {1} and is_reply = 0 order by uid desc limit {2},{3}' ,
	'get_guestbook_reply_list' => 'select * from ' . $db_prefix_blog . 'guestbook where is_reply = {0} order by uid asc limit {1}' ,
	'get_last_uid' => 'select uid from ' . $db_prefix_blog . 'guestbook order by uid desc limit 1' ,
	'get_guestbook_count' => 'select count(*) as total_guestbook from ' . $db_prefix_blog . 'guestbook' ,
	'get_blog_notice' => 'select uid, subject from ' . $db_prefix_blog . 'post where post_condition = 2 order by uid desc limit {0}' ,
	'get_blog_recent_reply' => 'select uid, post_uid, content from ' . $db_prefix_blog . 'comment order by uid desc limit {0}' ,
	'get_blog_guestbook' => 'select uid, content from ' . $db_prefix_blog . 'guestbook order by uid desc limit {0}' ,
	'get_blog_link' => 'select url, name from ' . $db_prefix_blog . 'link order by uid asc' ,
	'get_blog_reply' => 'select * from ' . $db_prefix_blog . 'comment where post_uid = {0} and is_secret = 0 order by family_uid asc, uid asc',
    'get_blog_category' => 'select * from ' . $db_prefix_blog . 'category order by id asc',
);
?>