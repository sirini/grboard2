<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($skinResourcePrefix)) $skinResourcePrefix = '/' . $grboard . '/module/board/skin/';
if(!isset($skinPathPrefix)) $skinPathPrefix = 'module/board/skin/';
if(!isset($skinIncludePrefix)) $skinIncludePrefix = 'skin/';
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'modify/model.php';
include 'modify/query.php';
include 'modify/error.php';

if( $Common->getSessionKey() == 0 ) $Common->error($error['msg_no_permission']);

$Model = new Model($DB, $query, $grboard, $Common);
$boardInfo = $Model->getBoardInfo($ext_id);
$skinResourcePath = $skinResourcePrefix . $boardInfo['theme'];
$skinPath = $skinPathPrefix . $boardInfo['theme'];

if(isset($_GET['commentNo'])) {
	$comment = (int)$_GET['commentNo'];
	$oldData = $Model->getCommentData($ext_id, $comment);
	$postUID = (int)$oldData['board_no'];
	$content = str_replace('<br />', "\n", stripslashes($oldData['content']));
	include $skinIncludePrefix . $boardInfo['theme'] . '/index.php';
} else {
	$Common->error($error['msg_wrong_target']);
}
?>