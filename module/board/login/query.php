<?php
$query = array(
	'get_board_login' => 'select no from ' . $db_prefix_board . 'member_list where id = \'{0}\' and password = \'{1}\' limit 1',
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'update_last_login' => 'update ' . $db_prefix_board . 'member_list set lastlogin = \''.time().'\' where no = {0} limit 1' ,
	'update_blocks_zero' => 'update ' . $db_prefix_board . 'member_list set blocks = 0 where no = {0} limit 1'
);
?>