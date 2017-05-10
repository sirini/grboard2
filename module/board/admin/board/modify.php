<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if($boardId != '') {
	$title = 'Modify a board';
	$mode = 'modify';
	$oldData = $Model->getOldData($boardId);	
	$oldData['head_form'] = stripslashes($oldData['head_form']);
	$oldData['foot_form'] = stripslashes($oldData['foot_form']);
}
include 'add.php';
?>
