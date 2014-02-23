<?php
$query = array(
	'delete_comment' => 'delete from ' . $db_prefix_blog . 'comment where uid = {0} limit 1' ,
	'get_post_uid' => 'select post_uid from ' . $db_prefix_blog . 'comment where uid = {0} limit 1' ,
	'update_comment_count' => 'update ' . $db_prefix_blog . 'post set comment_count = comment_count - 1 where uid = {0} limit 1'
);
?>