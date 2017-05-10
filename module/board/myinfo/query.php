<?php
$query = array(
	'update_myinfo' => 'update ' . $db_prefix_board . 'member_list set {0} where no = {1} limit 1',
	'get_myinfo' => 'select * from ' . $db_prefix_board . 'member_list where no = {0} limit 1'
);
?>