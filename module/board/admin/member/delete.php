<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
$memberInfo = $Model->getOldData($memberId);
if(isset($_POST['memberDeleteId'])) {
	$mId = (int)$_POST['memberDeleteId'];
	$Model->deleteMember($mId, $memberInfo['id']);
	$Common->message($error['msg_delete_member_done'], '/' . $grboard . '/board/admin/member/list');
}
if($memberId == 1) {
	$Common->message($error['msg_cant_delete_admin'], '/' . $grboard . '/board/admin/member/list');
}

include $skinResourcePath . '/member.delete.php';
?>
