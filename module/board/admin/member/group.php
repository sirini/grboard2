<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if(array_key_exists('groupFormSubmit', $_POST)) {
	$Model->saveGroupConfig($_POST);
}
$oldData = array('no'=>0, 'name'=>'', 'members'=>0, 'make_time'=>time());
$submit = 'Add';
if(isset($groupId)) {
	$oldData = $Model->getMemberGroup($groupId);
	$submit = 'Modify';
} else {
	$submit = 'Add';
} 
if(isset($deleteGroupId)) {
	$Model->deleteGroup($deleteGroupId);
	$Common->message($error['msg_delete_member_group_done'], '/' . $grboard . '/board/admin/member/group');
}
$groupList = $Model->getMemberGroupList();

include $skinResourcePath . '/member.group.php';
?>
