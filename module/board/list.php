<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($searchOption)) $searchOption = '';
if(!isset($searchValue)) $searchValue = '';
if(!isset($skinResourcePrefix)) $skinResourcePrefix = '/' . $grboard . '/module/board/skin/';
if(!isset($skinPathPrefix)) $skinPathPrefix = 'module/board/skin/';
if(!isset($skinIncludePrefix)) $skinIncludePrefix = 'skin/';
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

include 'list/query.php';
include 'list/model.php';
include 'list/error.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$boardTotalRecord = $Model->getBoardPostCount($ext_id, $searchOption, $searchValue);
$boardInfo = $Model->getBoardInfo($ext_id);
if(!isset($mobilePath)) $boardTheme = $boardInfo['theme'];
else $boardTheme = $boardInfo['theme_mobile'];
$userInfo = $Model->getUserInfo($Common->getSessionKey());
if($userInfo['level'] < $boardInfo['enter_level']) {
	$Common->error($error['msg_no_permission']);
}
$Paging = new Paging($boardInfo['page_num'], $boardInfo['page_per_list'], $ext_page, $boardTotalRecord);
$boardPost = $Model->getBoardPost($ext_id, $Paging->getStartRecord(), $boardInfo['page_num'], $searchOption, $searchValue);
$boardNotice = $Model->getBoardNotice($ext_id);
$boardCategory = $Model->getBoardCategory($ext_id);
$skinResourcePath = $skinResourcePrefix . $boardTheme;
$skinPath = $skinPathPrefix . $boardTheme;
$boardPaging = $Paging->getPaging();
$boardTotalPage = $Paging->getTotalPage();
$boardTotalBlock = $Paging->getTotalBlock();
$boardNowBlock = $Paging->getNowBlock();

include $skinIncludePrefix . $boardTheme . '/index.php';

unset($Model, $boardTotalRecord, $Paging, $boardPost, $boardInfo, $skinResourcePath, $skinPath, $boardPaging, $boardTotalBlock, $boardNowBlock, $query, $boardTheme);
?>