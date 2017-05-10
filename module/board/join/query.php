<?php
$query = array(
	'get_exist_id' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\'' ,
	'get_first_group' => 'select no from ' . $db_prefix_board . 'member_group order by no asc limit 1' ,
	'add_new_member' => 'insert into ' . $db_prefix_board . 'member_list (no,id,password,nickname,realname,email,homepage,'.
		'make_time,level,point,self_info,photo,nametag,group_no,icon,lastlogin,blocks) values ({0})'
);
?>