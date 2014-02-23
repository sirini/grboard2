<?php
$query = array(
	'get_blog_info' => 'select * from ' . $db_prefix_blog . 'config limit 1' ,
	'update_blog_config' => 'update ' . $db_prefix_blog . 'config set {0} limit 1'
);
?>