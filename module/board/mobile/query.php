<?php
$query = array(
	'get_user_info' => 'select * from ' . $db_prefix_board . 'member_list where no = {0}' ,
	'get_board_post_count' => 'select count(*) as post_count from ' . $db_prefix_board . 'bbs_{0}' ,
	'get_board_post_count_find' => 'select count(*) as post_count from ' . $db_prefix_board . 'bbs_{0} where {1} like \'%{2}%\' order by no desc limit {3}' ,
	'get_board_notice_count' => 'select count(*) as notice_count from ' . $db_prefix_board . 'bbs_{0} where is_notice = 1' ,
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_last_uid' => 'select no from ' . $db_prefix_board . 'bbs_{0} order by no desc limit 1' ,
	'get_board_notice' => 'select * from ' . $db_prefix_board . 'bbs_{0} where is_notice = 1 order by no desc' ,
	'get_board_category' => 'select category from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_board_post' => 'select {0} from '. $db_prefix_board . 'bbs_{1} where no between {2} and {3} order by no desc limit {4},{5}',
	'get_board_post_find' => 'select {0} from '. $db_prefix_board . 'bbs_{1} where no between {2} and {3} and {4} like \'%{5}%\' order by no desc limit {6},{7}'
);
?>