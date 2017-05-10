<?php
$query = array(
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
	'get_blog_post' => 'select * from ' . $db_prefix_blog . 'post order by uid desc limit {0}' ,
	'get_last_update_time' => 'select signdate from ' . $db_prefix_blog . 'post order by uid desc limit 1' ,
	'get_category_text' => 'select name from ' . $db_prefix_blog . 'category where uid = {0} limit 1'
);
?>