<?php
$query = array(
	'get_blog_login' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\' and password = \'{1}\' limit 1',
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
    'get_blog_notice' => 'select uid, subject from ' . $db_prefix_blog . 'post where post_condition = 2 order by uid desc limit {0}' ,
    'get_blog_category' => 'select * from ' . $db_prefix_blog . 'category order by id asc',
    'get_blog_recent_reply' => 'select uid, post_uid, content from ' . $db_prefix_blog . 'comment order by uid desc limit {0}' ,
    'get_blog_guestbook' => 'select uid, content from ' . $db_prefix_blog . 'guestbook order by uid desc limit {0}' ,
);
?>