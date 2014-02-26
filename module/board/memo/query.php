<?php
$query = array(
	'get_memo_list' => 'select * from ' . $db_prefix_board . 'message_box where to_uid = {0} order by no desc limit {1}, {2}' ,
	'get_from_nick' => 'select nickname from ' . $db_prefix_board . 'member_list where no = {0} limit 1' ,
	'get_total_message' => 'select count(*) as cnt from ' . $db_prefix_board . 'message_box where to_uid = {0}' ,
	'get_target_info' => 'select from_uid, memo from ' . $db_prefix_board . 'message_box where no = {0} limit 1' ,
	'get_from_id' => 'select id from ' . $db_prefix_board . 'member_list where no = {0} limit 1' ,
	'get_target_uid' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\' limit 1' ,
	'write_memo' => 'insert into ' . $db_prefix_board . 'message_box (no,from_uid,to_uid,memo,signdate,status) values ({0})'
);
?>