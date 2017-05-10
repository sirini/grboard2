<?php
$query = array(
	'delete_comment' => 'delete from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_comment_data' => 'select board_no, content from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_all_comment' => 'select * from ' . $db_prefix_board . 'comment_{0} where board_no = {1}' ,
	'insert_comment' => 'insert into ' . $db_prefix_board . 'comment_{0} (no,board_no,family_no,thread,member_key,' . 
						'is_grcode,name,password,email,homepage,ip,signdate,good,bad,subject,content,is_secret,order_key) ' . 
						'values (\'\', \'{1}\', \'{2}\', \'{3}\', \'{4}\', \'{5}\', \'{6}\', \'{7}\', \'{8}\',' .
						' \'{9}\', \'{10}\', \'{11}\', \'{12}\', \'{13}\', \'{14}\', \'{15}\', \'{16}\', \'{17}\')' ,
	'get_post_data' => 'select * from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1' ,
	'insert_post' => 'insert into ' . $db_prefix_board . 'bbs_{0} (no,member_key,name,password,email,homepage,ip,' . 
						'signdate,hit,good,comment_count,is_notice,is_secret,category,subject,content,tag)' . 
						' values (\'\', \'{1}\', \'{2}\', \'{3}\', \'{4}\', \'{5}\', \'{6}\', \'{7}\', \'{8}\',' . 
						' \'{9}\', \'{10}\', \'{11}\', \'{12}\', \'{13}\', \'{14}\', \'{15}\', \'{16}\' )' ,
	'get_post_uid' => 'select board_no from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_file_store' => 'select * from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'insert_file_store' => 'insert into ' . $db_prefix_board . 'file_store (uid,board_id,board_no,member_key,real_name,hash_name,signdate,hit) ' . 
							'values (\'\', \'{0}\', \'{1}\', \'{2}\', \'{3}\', \'{4}\', \'{5}\', \'{6}\')' ,
	'delete_file_store' => 'delete from ' . $db_prefix_board . 'file_store where board_id = \'{0}\' and board_no = {1}' ,
	'delete_comment_list' => 'delete from ' . $db_prefix_board . 'comment_{0} where board_no = {1}' ,
	'get_board_list' => 'select (select name from '.$db_prefix_board.'group_list where no = '.$db_prefix_board.'board_list.group_no) as groupname, '.
							'no, id, make_time, master, theme as skin, name from '.$db_prefix_board.'board_list order by no desc' ,
	'delete_post' => 'delete from ' . $db_prefix_board . 'bbs_{0} where no = {1} limit 1'
);
?>