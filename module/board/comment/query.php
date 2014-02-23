<?php
$query = array(
	'get_writer_info' => 'select {0} from ' . $db_prefix_board . 'member_list where no = {1} limit 1' ,
	'get_parent_thread' => 'select family_no, thread from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'write_comment' => 'insert into ' . $db_prefix_board . 'comment_{0} (no,board_no,family_no,thread,member_key,is_grcode,name,password,email,homepage,ip,signdate,good,bad,subject,content,is_secret,order_key) values ({1})' ,
	'update_family_id' => 'update ' . $db_prefix_board . 'comment_{0} set family_no = {1} where no = {1} limit 1' ,
	'update_comment_count' => 'update ' . $db_prefix_board . 'bbs_{0} set comment_count = comment_count + 1 where no = {1} limit 1' ,
);
?>