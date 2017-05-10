<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($skinResourcePrefix)) $skinResourcePrefix = '/' . $grboard . '/module/board/skin/';
if(!isset($skinPathPrefix)) $skinPathPrefix = 'module/board/skin/';
if(!isset($skinIncludePrefix)) $skinIncludePrefix = 'skin/';
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'delete/model.php';
include 'delete/query.php';
include 'delete/error.php';

if( $Common->getSessionKey() == 0 ) $Common->error($error['msg_no_permission']);

$Model = new Model($DB, $query, $grboard, $Common);
$boardInfo = $Model->getBoardInfo($ext_id);
$skinResourcePath = $skinResourcePrefix . $boardInfo['theme'];
$skinPath = $skinPathPrefix . $boardInfo['theme'];

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
	if(isset($_GET['commentNo'])) {
		$comment = (int)$_GET['commentNo'];
		$_SESSION['ISREADY2REMOVE'] = $comment;
		$oldData = $Model->getCommentData($ext_id, $comment);
		$postUID = (int)$oldData['board_no'];
		$content = nl2br(stripslashes($oldData['content']));
		
		include $skinIncludePrefix . $boardInfo['theme'] . '/index.php';
	}
}
?>