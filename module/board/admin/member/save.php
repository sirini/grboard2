<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);

if(array_key_exists('memberFormSubmitType', $_POST)) {
	$memberUid = $Model->saveMemberConfig($_POST);
	if($memberUid == false) {
		$lang['member_save_status'] = $error['msg_id_exist'];
	} elseif($memberUid == -1) {
		$lang['member_save_status'] = $error['msg_empty_form'];
	}
}

include $skinResourcePath . '/member.save.php';
?>
