<?php
$query = array(
	'get_user_info' => 'select * from ' . $db_prefix_board . 'member_list where no = {0}' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_board_category' => 'select category from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_reply_list' => 'select * from ' . $db_prefix_board . 'comment_{0} where board_no = {1} order by family_no asc, no asc' ,
	'get_post' => 'select * from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1' ,
	'get_file_list' => 'select uid, real_name from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'update_hit' => 'update ' . $db_prefix_board . 'bbs_{0} set hit = hit + 1 where no = {1} limit 1'
);
?>