<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($searchOption)) $searchOption = '';
if(!isset($searchValue)) $searchValue = '';

include $mobilePath . '/list/query.php';
include $mobilePath . '/list/model.php';
include $mobilePath . '/list/error.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
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
$skinResourcePath = '/' . $grboard . '/module/board/mobile/skin/' . $boardInfo['theme_mobile'];
$skinPath = $mobilePath . '/mobile/skin/' . $boardInfo['theme_mobile'];
$boardPaging = $Paging->getPaging();
$boardTotalPage = $Paging->getTotalPage();
$boardTotalBlock = $Paging->getTotalBlock();
$boardNowBlock = $Paging->getNowBlock();
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$mobileAction = 'list';
include $skinPath . '/index.php';

unset($Model, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query);
?>