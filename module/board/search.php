<?php
if(!defined('GR_BOARD_2')) exit();

include 'list/query.php';
include 'list/model.php';
include 'list/error.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$searchOption = '';
$searchValue = '';
if(array_key_exists('option', $_GET)) {
	$searchOption = $Common->getPlaneText($_GET['option']);
}
if(array_key_exists('value', $_GET)) {
	$searchValue = $Common->getPlaneText($_GET['value']);
}
$boardTotalRecord = $Model->getBoardPostCount($ext_id, $searchOption, $searchValue);
$boardInfo = $Model->getBoardInfo($ext_id);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
if($userInfo['level'] < $boardInfo['enter_level']) {
	$Common->error($error['msg_no_permission']);
}
$Paging = new Paging($boardInfo['page_num'], $boardInfo['page_per_list'], $ext_page, $boardTotalRecord);
$boardPost = $Model->getBoardPost($ext_id, $Paging->getStartRecord(), $boardInfo['page_num'], $searchOption, $searchValue);
$boardNotice = $Model->getBoardNotice($ext_id);
$boardCategory = $Model->getBoardCategory($ext_id);
$skinResourcePath = '/' . $grboard . '/module/board/skin/' . $boardInfo['theme'];
$skinPath = 'module/board/skin/' . $boardInfo['theme'];
$boardPaging = $Paging->getPaging();
$boardTotalPage = $Paging->getTotalPage();
$boardTotalBlock = $Paging->getTotalBlock();
$boardNowBlock = $Paging->getNowBlock();
$boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'skin/' . $boardInfo['theme'] . '/index.php';

unset($Model, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query);
?>