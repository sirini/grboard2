<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($skinResourcePrefix)) $skinResourcePrefix = '/' . $grboard . '/module/board/skin/';
if(!isset($skinPathPrefix)) $skinPathPrefix = 'module/board/skin/';
if(!isset($skinIncludePrefix)) $skinIncludePrefix = 'skin/';
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'write/query.php';
include 'write/model.php';
include 'write/error.php';

$Model = new Model($DB, $query, $grboard, $Common);

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
	
	$insertID = $Model->writePost($ext_id, $_POST, $_FILES, $target); 	
	if( $insertID > 0 ) header('Location: ' . $boardLink . '/view/' . $insertID);
	else if($insertID == -1) $Common->error($error['msg_file_size_exceeded']);
	else $Common->error($error['msg_write_fail']);
}

$simplelock = substr(md5('GR_BOARD_2' . date('YmdHis') . $_SERVER['HTTP_HOST']), -5);
$_SESSION['ANTISPAM'] = $simplelock; 
$boardInfo = $Model->getBoardInfo($ext_id);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
$skinResourcePath = $skinResourcePrefix . $boardInfo['theme'];
$skinPath = $skinPathPrefix . $boardInfo['theme'];
$postTarget = 0;
$oldFile = array(array());

if($userInfo['level'] < $boardInfo['write_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}

if(isset($_GET['articleNo'])) {
	$postTarget = $_GET['articleNo'];
	$oldData = $Model->getOldData($ext_id, $postTarget);
	$oldFile = $Model->getOldFileList($ext_id, $postTarget);
	
	if($oldData['is_secret'] && !isPermitted($oldData['member_key'], $Common->getSessionKey())) {
		$oldData['content'] = '<p class="red">Secret post.</p>';	
	}
	$oldData['content'] = str_replace('<br />', "\n", $oldData['content']);
}

include $skinIncludePrefix . $boardInfo['theme'] . '/index.php';

unset($Model, $query, $error, $boardInfo, $userInfo, $skinResourcePath, $skinPath, $oldData, $oldFile, $simplelock, $target);
?>