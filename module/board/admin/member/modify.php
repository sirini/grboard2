<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if($memberId != 0) {
	$title = 'Modify a member information';
	$mode = 'modify';
	$oldData = $Model->getOldData($memberId);	
}
include 'add.php';
?>
