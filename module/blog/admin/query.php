<?php
$query = array(
	'get_blog_info' => 'select * from ' . $db_prefix_blog . 'config limit 1' ,
	'get_blog_link' => 'select * from ' . $db_prefix_blog . 'link' ,
	'get_blog_category' => 'select * from ' . $db_prefix_blog . 'category order by id asc',
	'update_blog_config' => 'update ' . $db_prefix_blog . 'config set {0} limit 1' ,
	'save_blog_category' => 'insert into ' . $db_prefix_blog . 'category (uid,id,name,depth) values (NULL, \'{0}\', \'{1}\', \'{2}\')',
	'update_blog_category' => 'update ' . $db_prefix_blog . 'category set id = \'{0}\', name = \'{1}\', depth = \'{2}\' where uid = {3} limit 1',
	'delete_blog_category' => 'delete from ' . $db_prefix_blog . 'category where uid = {0} limit 1',
	'save_blog_link' => 'insert into ' . $db_prefix_blog . 'link (uid,url,name,info) values (NULL, \'{0}\', \'{1}\', \'{2}\')' ,
	'update_blog_link' => 'update ' . $db_prefix_blog . 'link set url = \'{0}\', name = \'{1}\', info = \'{2}\' where uid = {3} limit 1' ,
	'delete_blog_link' => 'delete from ' . $db_prefix_blog . 'link where uid = {0} limit 1' ,
);
?>