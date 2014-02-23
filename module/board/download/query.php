<?php
$query = array(
	'get_file_store' => 'select * from ' . $db_prefix_board . 'file_store where uid = {0}' ,
	'get_user_info' => 'select * from ' . $db_prefix_board . 'member_list where no = {0}' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'update_hit' => 'update ' . $db_prefix_board . 'file_store set hit = hit + 1 where uid = {0} limit 1'
);
?>