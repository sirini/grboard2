<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($skinResourcePrefix)) $skinResourcePrefix = '/' . $grboard . '/module/board/skin/';
if(!isset($skinPathPrefix)) $skinPathPrefix = 'module/board/skin/';
if(!isset($skinIncludePrefix)) $skinIncludePrefix = 'skin/';
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'view/query.php';
include 'view/model.php';
include 'view/error.php';

$Model = new Model($DB, $query, $grboard);
$boardInfo = $Model->getBoardInfo($ext_id);
if(!isset($mobilePath)) $boardTheme = $boardInfo['theme'];
else $boardTheme = $boardInfo['theme_mobile'];
$userInfo = $Model->getUserInfo($Common->getSessionKey());
if($userInfo['level'] < $boardInfo['view_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}
$boardCategory = $Model->getBoardCategory($ext_id);
$Model->updateHit($ext_id, $ext_articleNo);
$boardPost = $Model->getPost($ext_id, $ext_articleNo);
$replyList = $Model->getReplyList($ext_id, $ext_articleNo);
$skinResourcePath = $skinResourcePrefix . $boardTheme;
$skinPath = $skinPathPrefix . $boardTheme;
$fileList = $Model->getFileList($ext_id, $ext_articleNo);

function isPermitted($db_key, $now_session) {
	if($now_session == 1) return true;
	if($db_key == 0 && $now_session == 0) return false;
	if($db_key == $now_session) return true;
	else return false;
}

function isImageFile($filename) {
	if(preg_match('/\.(gif|jpg|png|bmp)$/i', $filename)) {
		return true;
	}
	return false;
}

if($boardPost['is_secret'] && !isPermitted($boardPost['member_key'], $Common->getSessionKey())) {
	$boardPost['name'] = 'Hidden';
	$boardPost['content'] = '<div class="alert alert-primary" role="alert">'.$error['msg_secret_post'].'</div>';	
}

include $skinIncludePrefix . $boardTheme . '/index.php';

unset($Model, $error, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query, $fileList, $boardTheme);
?>