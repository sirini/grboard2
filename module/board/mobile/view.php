<?php
if(!defined('GR_BOARD_2')) exit();

include $mobilePath . '/view/query.php';
include $mobilePath . '/view/model.php';
include $mobilePath . '/view/error.php';

$Model = new Model($DB, $query, $grboard);
$boardInfo = $Model->getBoardInfo($ext_id);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
if($userInfo['level'] < $boardInfo['view_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}
$boardCategory = $Model->getBoardCategory($ext_id);
$Model->updateHit($ext_id, $ext_articleNo);
$boardPost = $Model->getPost($ext_id, $ext_articleNo);
$replyList = $Model->getReplyList($ext_id, $ext_articleNo);
$skinResourcePath = $mobilePath . '/mobile/skin/' . $boardInfo['theme_mobile'];
$skinPath = $mobilePath . '/mobile/skin/' . $boardInfo['theme_mobile'];
$boardLink = '/' . $grboard . '/board-' . $ext_id . '/mobile';
$simplelock = substr(md5($boardPost['no'] . 'GR_BOARD_2' . date('YmdH')), -4);
$fileList = $Model->getFileList($ext_id, $ext_articleNo);

function isPermitted($db_key, $now_session) {
	if($now_session == 1) return true;
	if($db_key == 0 && $now_session == 0) return false;
	if($db_key == $now_session) return true;
	else return false;
}

if($boardPost['is_secret'] && !isPermitted($boardPost['member_key'], $Common->getSessionKey())) {
	$boardPost['name'] = 'Hidden';
	$boardPost['content'] = '<p class="red">Secret post.</p>';	
}

include $skinPath . '/index.php';

unset($Model, $error, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query, $fileList);
?>