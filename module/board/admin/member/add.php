<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if(!isset($title)) {
	$title = 'Add a new member';
	$mode = 'add';
	$oldData = array('no'=>'0', 'id'=>'', 'nickname'=>'', 'realname'=>'', 'email'=>'', 
		'homepage'=>'', 'level'=>2, 'point'=>0, 'self_info'=>'', 'group_no'=>'', 'blocks'=>0);
}

include $skinResourcePath . '/member.add.php';
?>
