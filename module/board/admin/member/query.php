<?php
$query = array(
	'get_old_data' => 'select * from ' . $db_prefix_board . 'member_list where no = {0} limit 1' ,
	'get_member_group_list' => 'select * from ' . $db_prefix_board . 'member_group' ,
	'get_member_group' => 'select * from ' . $db_prefix_board . 'member_group where no = {0}' ,
	'add_new_member' => 'insert into ' . $db_prefix_board . 'member_list (no,id,password,nickname,realname,email,homepage,'.
		'make_time,level,point,self_info,photo,nametag,group_no,icon,lastlogin,blocks) values ({0})' ,
	'update_exist_member' => 'update ' . $db_prefix_board . 'member_list set {0} where no = {1} limit 1' ,
	'is_member_exist' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\' limit 1' ,
	'get_member_list' => 'select (select name from '.$db_prefix_board.'member_group where no = '.$db_prefix_board.'member_list.group_no) as groupname,'.
		'no,id,nickname,realname,make_time,level,point,lastlogin,blocks from ' . $db_prefix_board . 'member_list order by no desc limit {0}, {1}' ,
	'get_member_total_count' => 'select count(*) as cnt from ' . $db_prefix_board . 'member_list' ,
	'get_member_count_group' => 'select count(*) as cnt from ' . $db_prefix_board . 'member_list where group_no = {0}' ,
	'delete_member' => 'delete from ' . $db_prefix_board . 'member_list where no = {0} limit 1' ,
	'save_group_add' => 'insert into ' . $db_prefix_board . 'member_group (no,name,make_time) values ({0})' ,
	'save_group_modify' => 'update ' . $db_prefix_board . 'member_group set {0} where no = {1} limit 1' ,
	'delete_group' => 'delete from ' . $db_prefix_board . 'member_group where no = {0} limit 1' ,
	'set_default_group' => 'update ' . $db_prefix_board . 'member_list set group_no = (select no from '.$db_prefix_board.
		'member_group order by no asc limit 1) where group_no = {0}'
);
?>