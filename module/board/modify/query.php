<?php
$query = array(
	'get_board_info' => 'select * from ' . $db_prefix_board . 'board_list where id = \'{0}\'' ,
	'get_comment_data' => 'select board_no, content, is_secret from ' . $db_prefix_board . 'comment_{0} where no = {1} limit 1' 
);
?>