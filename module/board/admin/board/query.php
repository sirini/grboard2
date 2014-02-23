<?php
$query = array(
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where no = {0} limit 1' ,
	'get_board_group_list' => 'select * from ' . $db_prefix_board . 'group_list' ,
	'get_board_group' => 'select * from ' . $db_prefix_board . 'group_list where no = {0}' ,
	'get_board_count_group' => 'select count(*) as cnt from ' . $db_prefix_board . 'board_list where group_no = {0}' ,
	'get_old_data' => 'select * from ' . $db_prefix_board . 'board_list where no = {0} limit 1' ,
	'is_board_exist' => 'select no from ' . $db_prefix_board . 'board_list where id = \'{0}\' limit 1' ,
	'insert_new_board' => 'insert into ' . $db_prefix_board . 'board_list (no,id,head_file,foot_file,head_form,foot_form,category,' .
		'make_time,page_num,page_per_list,enter_level,master,theme,comment_page_num,comment_page_per_list,num_file,view_level,' .
		'write_level,comment_write_level,cut_subject,group_no,comment_sort,name,down_level,down_point) values ({0})' ,
	'create_new_board' => 'CREATE TABLE IF NOT EXISTS `' . $db_prefix_board . 'bbs_{0}` (' .
  		'`no` int(11) NOT NULL AUTO_INCREMENT, `member_key` int(11) NOT NULL DEFAULT \'0\', `name` varchar(20) NOT NULL DEFAULT \'\',' .
  		'`password` varchar(50) NOT NULL DEFAULT \'\', `email` varchar(255) DEFAULT \'\', `homepage` varchar(255) DEFAULT \'\',' .
  		'`ip` varchar(20) NOT NULL DEFAULT \'\', `signdate` int(11) NOT NULL DEFAULT \'0\', `hit` int(11) NOT NULL DEFAULT \'0\',' .
  		'`good` int(11) NOT NULL DEFAULT \'0\', `comment_count` int(11) NOT NULL DEFAULT \'0\', `is_notice` tinyint(4) DEFAULT \'0\',' .
  		'`is_secret` tinyint(4) DEFAULT \'0\', `category` varchar(50) DEFAULT \'\', `subject` varchar(255) NOT NULL DEFAULT \'\',' .
  		'`content` text, `tag` varchar(255) NOT NULL DEFAULT \'\', PRIMARY KEY (`no`), KEY `member_key` (`member_key`),' .
  		'KEY `hit` (`hit`), KEY `signdate` (`signdate`), KEY `good` (`good`), KEY `is_notice` (`is_notice`)) DEFAULT CHARSET=utf8' ,
  	'create_new_comment' => 'CREATE TABLE IF NOT EXISTS `' . $db_prefix_board . 'comment_{0}` (' .
  		'`no` int(11) NOT NULL AUTO_INCREMENT, `board_no` int(11) NOT NULL DEFAULT \'0\', `family_no` int(11) NOT NULL DEFAULT \'0\',' .
  		'`thread` tinyint(4) NOT NULL DEFAULT \'0\', `member_key` int(11) NOT NULL DEFAULT \'0\', `is_grcode` tinyint(4) NOT NULL DEFAULT \'0\',' .
  		'`name` varchar(20) NOT NULL DEFAULT \'\', `password` varchar(50) NOT NULL DEFAULT \'\', `email` varchar(255) DEFAULT \'\',' .
  		'`homepage` varchar(255) DEFAULT \'\', `ip` varchar(20) NOT NULL DEFAULT \'\', `signdate` int(11) NOT NULL DEFAULT \'0\',' .
  		'`good` int(11) NOT NULL DEFAULT \'0\', `bad` int(11) NOT NULL DEFAULT \'0\', `subject` varchar(255) NOT NULL DEFAULT \'\',' .
  		'`content` text, `is_secret` tinyint(4) NOT NULL DEFAULT \'0\', `order_key` varchar(50) NOT NULL DEFAULT \'\',' .
  		'PRIMARY KEY (`no`), KEY `board_no` (`board_no`), KEY `family_no` (`family_no`), KEY `thread` (`thread`), ' . 
  		'KEY `member_key` (`member_key`)) DEFAULT CHARSET=utf8' ,
	'modify_exist_board' => 'update ' . $db_prefix_board . 'board_list set {0} where no = {1} limit 1' ,
	'get_board_list' => 'select (select name from '.$db_prefix_board.'group_list where no = '.$db_prefix_board.'board_list.group_no) as groupname, '.
		'no, id, make_time, master, theme as skin, name from '.$db_prefix_board.'board_list order by no desc limit {0}, {1}' ,
	'delete_board_list' => 'delete from ' . $db_prefix_board . 'board_list where id = \'{0}\' limit 1' ,
	'delete_board_table' => 'drop table ' . $db_prefix_board . 'bbs_{0}' ,
	'delete_board_comment' => 'drop table ' . $db_prefix_board . 'comment_{0}' ,
	'delete_board_file' => 'delete from ' . $db_prefix_board . 'file_store where board_id = \'{0}\'' ,
	'save_group_add' => 'insert into ' . $db_prefix_board . 'group_list (no,name,master,make_time) values ({0})' ,
	'save_group_modify' => 'update ' . $db_prefix_board . 'group_list set {0} where no = {1} limit 1' ,
	'delete_group' => 'delete from ' . $db_prefix_board . 'group_list where no = {0} limit 1' ,
	'set_default_group' => 'update ' . $db_prefix_board . 'board_list set group_no = (select no from '.$db_prefix_board.
		'group_list order by no asc limit 1) where group_no = {0}' ,
	'get_board_total_count' => 'select count(*) as cnt from ' . $db_prefix_board . 'board_list'
);
?>