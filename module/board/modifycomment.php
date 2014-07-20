<?php
if(!defined('GR_BOARD_2')) exit();

include 'modify/model.php';
include 'modify/query.php';
include 'modify/error.php';

if( $Common->getSessionKey() == 0 ) $Common->error($error['msg_no_permission']);

$Model = new Model($DB, $query, $grboard, $Common);
$boardInfo = $Model->getBoardInfo($ext_id);
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$skinResourcePath = '/' . $grboard . '/module/board/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];

if(isset($_GET['commentNo'])) {
	$comment = (int)$_GET['commentNo'];
	$oldData = $Model->getCommentData($ext_id, $comment);
	$postUID = (int)$oldData['board_no'];
	$content = stripslashes($oldData['content']);
	include 'skin/' . $boardInfo['theme'] . '/index.php';
} else {
	$Common->error($error['msg_wrong_target']);
}
?>