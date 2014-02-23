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
	if( array_key_exists('commentNo', $_GET) ) {
		$comment = (int)$_GET['commentNo'];
		$postUID = (int)$_POST['postUID'];
		
		if( $comment != (int)$_SESSION['ISREADY2REMOVE'] ) {
			$_SESSION['ISREADY2REMOVE'] = 0;
			$Common->error($error['msg_wrong_target'], $boardLink . '/view/' . $postUID);
		}

		$_SESSION['ISREADY2REMOVE'] = 0;
		if( $Model->deleteComment($ext_id, $comment) === true ) {
			header('Location: ' . $boardLink . '/view/' . $postUID);
		} else {
			$Common->error($error['msg_delete_fail'], $boardLink . '/view/' . $postUID);
		}
	}	
} else {		
	if( array_key_exists('commentNo', $_GET) ) {
		$comment = (int)$_GET['commentNo'];
		$_SESSION['ISREADY2REMOVE'] = $comment;
		$oldData = $Model->getCommentData($ext_id, $comment);
		$postUID = (int)$oldData['board_no'];
		$content = stripslashes($oldData['content']);
		
		include 'skin/' . $boardInfo['theme'] . '/index.php';
	}
}
?>