<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if(array_key_exists('groupFormSubmit', $_POST)) {
	$Model->saveGroupConfig($_POST);
}
$oldData = array('no'=>0, 'name'=>'', 'master'=>'', 'boards'=>0, 'make_time'=>time());
$submit = 'Add';
if(array_key_exists('groupId', $_POST)) {
	$groupId = (int)$_POST['groupId'];
	$submit = 'Add';
}
if(isset($groupId)) {
	$oldData = $Model->getBoardGroup($groupId);
	$submit = 'Modify';
} 
if(isset($deleteGroupId)) {
	$Model->deleteGroup($deleteGroupId);
	$Common->message($error['msg_delete_board_group_done'], '/' . $grboard . '/board/admin/board/group');
}
$groupList = $Model->getBoardGroupList();

include $skinResourcePath . '/board.group.php';
?>
