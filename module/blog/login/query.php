<?php
$query = array(
	'get_blog_login' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\' and password = \'{1}\' limit 1',
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
);
?>