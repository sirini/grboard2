<?php
if(!defined('GR_BOARD_2')) exit();

include 'view/query.php';
include 'view/model.php';
include 'view/error.php';

$Model = new Model($DB, $query, $grboard);
$boardInfo = $Model->getBoardInfo($ext_id);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
if($userInfo['level'] < $boardInfo['view_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}
$boardCategory = $Model->getBoardCategory($ext_id);
$boardPost = $Model->getPost($ext_id, $ext_articleNo);
$replyList = $Model->getReplyList($ext_id, $ext_articleNo);
$skinResourcePath = '/' . $grboard . '/module/board/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$simplelock = substr(md5($boardPost['no'] . 'GR_BOARD_2' . date('YmdH')), -4);
$fileList = $Model->getFileList($ext_id, $ext_articleNo);
$Model->updateHit($ext_id, $ext_articleNo);

function isPermitted($db_key, $now_session) {
	if($now_session == 1) return true;
	if($db_key == 0 && $now_session == 0) return false;
	if($db_key == $now_session) return true;
	else return false;
}

if($boardPost['is_secret'] && !isPermitted($boardPost['member_key'], $Common->getSessionKey())) {
	$boardPost['content'] = '<p class="red">비밀글 입니다.</p>';	
}

include 'skin/' . $boardInfo['theme'] . '/index.php';

unset($Model, $error, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query, $fileList);
?>