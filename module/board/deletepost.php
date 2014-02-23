<?php
if(!defined('GR_BOARD_2')) exit();

include 'delete/model.php';
include 'delete/query.php';
include 'delete/error.php';

if( $Common->getSessionKey() == 0 ) $Common->error($error['msg_no_permission']);

$Model = new Model($DB, $query, $grboard, $Common);
$boardInfo = $Model->getBoardInfo($ext_id);
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$skinResourcePath = '/' . $grboard . '/module/board/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];

if( array_key_exists('deleteProceed', $_POST) ) {
	if( array_key_exists('articleNo', $_GET) ) {
		$postUID = (int)$_GET['articleNo'];
		
		if( $postUID != (int)$_SESSION['ISREADY2REMOVE'] ) {
			$_SESSION['ISREADY2REMOVE'] = 0;
			$Common->error($error['msg_wrong_target'], $boardLink . '/view/' . $postUID);
		}

		$_SESSION['ISREADY2REMOVE'] = 0;
		if( $Model->deletePost($ext_id, $postUID) === true ) {
			header('Location: ' . $boardLink . '/list/1');
		} else {
			$Common->error($error['msg_delete_fail'], $boardLink . '/view/' . $postUID);
		}
	}	
} else {		
	if( array_key_exists('articleNo', $_GET) ) {
		$postUID = (int)$_GET['articleNo'];
		$_SESSION['ISREADY2REMOVE'] = $postUID;
		$oldData = $Model->getPostData($ext_id, $postUID);
		$content = stripslashes($oldData['content']);
		
		include 'skin/' . $boardInfo['theme'] . '/index.php';
	}
}
?>