<?php
if(!defined('GR_BOARD_2')) exit();

include 'write/query.php';
include 'write/model.php';
include 'write/error.php';

$Model = new Model($DB, $query, $grboard, $Common);
$boardLink = '/' . $grboard . '/board-' . $ext_id;

function isPermitted($db_key, $now_session) {
	if($now_session == 1) return true;
	if($db_key == 0 && $now_session == 0) return false;
	if($db_key == $now_session) return true;
	else return false;
}

if(isset($_POST['writeProceed'])) {
	if(!$Common->getSessionKey()) {
		if($_SESSION['ANTISPAM'] != $_POST['gr2simplelock']) {
			$Common->error($error['msg_spam_filter']);
		}
	}
	$target = 0;
	if( array_key_exists('articleNo', $_GET)) {
		$target = $_GET['articleNo'];
	}
	$insertID = $Model->writePost($ext_id, $_POST, $target); 	
	if( $insertID > 0 ) {
		header('Location: ' . $boardLink . '/view/' . $insertID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

$simplelock = substr(md5('GR_BOARD_2' . date('YmdHis') . $_SERVER['HTTP_HOST']), -5);
$_SESSION['ANTISPAM'] = $simplelock; 
$boardInfo = $Model->getBoardInfo($ext_id);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];
$postTarget = 0;
$oldFile = array(array());

if($userInfo['level'] < $boardInfo['write_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}

if(array_key_exists('articleNo', $_GET)) {
	$postTarget = $_GET['articleNo'];
	$oldData = $Model->getOldData($ext_id, $postTarget);
	$oldFile = $Model->getOldFileList($ext_id, $postTarget);
	
	if($oldData['is_secret'] && !isPermitted($oldData['member_key'], $Common->getSessionKey())) {
		$oldData['content'] = '<p class="red">비밀글 입니다.</p>';	
	}
}

include 'skin/' . $boardInfo['theme'] . '/index.php';

unset($Model, $query, $error, $boardInfo, $userInfo, $skinResourcePath, $skinPath, $oldData, $oldFile, $simplelock, $target);
?>