<?php
$query = array(
	'get_user_info' => 'select * from ' . $db_prefix_board . 'member_list where no = {0}' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_writer_info' => 'select {0} from ' . $db_prefix_board . 'member_list where no = {1} limit 1' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'',
	'get_old_data' => 'select * from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1' ,
	'get_old_file_list' => 'select uid as fid, real_name from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'get_delete_file_path' => 'select hash_name from ' . $db_prefix_board . 'file_store where uid = {0} limit 1' ,
	'write_post' => 'insert into ' . $db_prefix_board . 'bbs_{0} (no,member_key,name,password,email,homepage,ip,signdate,hit,good,comment_count,is_notice,is_secret,category,subject,content,tag) values ({1})' ,
	'modify_post' => 'update ' . $db_prefix_board . 'bbs_{0} set {1} where no = {2} limit 1' ,
	'delete_file' => 'delete from ' . $db_prefix_board . 'file_store where uid = {0} limit 1' ,
	'file_update' => 'insert into ' . $db_prefix_board . 'file_store (uid,board_id,board_no,member_key,real_name,hash_name,signdate,hit) values ({0})'
);
?>