<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);

if(array_key_exists('boardFormSubmitType', $_POST)) {
	$boardId = $Model->saveBoardConfig($_POST);
	if($boardId == false) {
		$lang['board_save_status'] = $error['msg_id_exist'];
		$boardId = $Common->getPlaneText($_POST['id']);
	} elseif($boardId == -1) {
		$lang['board_save_status'] = $error['msg_empty_form'];
		$boardId = $Common->getPlaneText($_POST['id']);		
	}
}

include $skinResourcePath . '/board.save.php';
?>
