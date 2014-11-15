<?php
if(!defined('GR_BOARD_2')) exit();

include 'manage/model.php';
include 'manage/query.php';
include 'manage/error.php';

if($Common->getSessionKey() == 0) $Common->error($error['msg_no_permission']);

$Model = new Model($DB, $query, $grboard, $Common);
$boardInfo = $Model->getBoardInfo($ext_id);
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$skinResourcePath = '/' . $grboard . '/module/board/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];

if(isset($_POST['manageProceed']) && isset($_SESSION['ISREADY2MANAGE']) ) {
	if(!isset($_POST['manageAction'])) $Common->error($error['msg_no_action'], $boardLink . '/list/1');
	$action = $_POST['manageAction'];
	$manageTargets = substr($_POST['manageTargets'], 0, -1);
	$targets = explode(';', $manageTargets);
	if($action == 'delete' ) {
		foreach($targets as &$target) {
			$Model->deletePost($ext_id, $target);
		}
	}
	elseif($action == 'move') {
		$targetBoard = $_POST['moveBoard'];
		foreach($targets as &$target) {
			$Model->copyPost($ext_id, $target, $targetBoard);
			$Model->deletePost($ext_id, $target);
		}
	}
	elseif($action == 'copy') {
		$targetBoard = $_POST['copyBoard'];
		foreach($targets as &$target) {
			$Model->copyPost($ext_id, $target, $targetBoard);
		}
	}
	header('Location: ' . $boardLink . '/list/1');
	
} else {		
	$_SESSION['ISREADY2MANAGE'] = true;	
	include 'skin/' . $boardInfo['theme'] . '/index.php';
}
?>