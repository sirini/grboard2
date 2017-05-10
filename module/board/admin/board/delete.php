<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
$boardInfo = $Model->getBoardInfo($boardId);
if(isset($_POST['boardDeleteId'])) {
	$Model->deleteBoard($_POST['boardDeleteId'], $boardInfo['id']);
	$Common->message($error['msg_delete_board_done'], '/' . $grboard . '/board/admin/board/list');
}

include $skinResourcePath . '/board.delete.php';
?>
