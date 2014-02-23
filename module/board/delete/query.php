<?php
$query = array(
	'delete_comment' => 'delete from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_comment_data' => 'select board_no, content from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_post_data' => 'select content from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1' ,
	'get_post_uid' => 'select board_no from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'update_comment_count' => 'update ' . $db_prefix_board . 'bbs_{0} set comment_count = comment_count - 1 where no = {1} limit 1' ,
	'get_file_store' => 'select hash_name from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'delete_file_store' => 'delete from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'delete_comment_list' => 'delete from ' . $db_prefix_board . 'comment_{0} where board_no = {1}' ,
	'delete_post' => 'delete from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1'
);
?>