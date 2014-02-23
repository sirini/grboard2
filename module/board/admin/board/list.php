<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
$memberTotalRecord = $Model->getTotalBoardCount();
$pageNum = 10;
$pagePerList = 20;
$boardList = $Model->getBoardList($page, $pageNum, $pagePerList);

include 'util/common/paging.php';
$Paging = new Paging($pagePerList, $pageNum, $page, $memberTotalRecord);
$boardPaging = $Paging->getPaging();
$boardTotalPage = $Paging->getTotalPage();
$boardTotalBlock = $Paging->getTotalBlock();
$boardNowBlock = $Paging->getNowBlock();
$pageLink = '/' . $grboard . '/board/admin/page2board/';
$prevLink = $pageLink . ($page - $pageNum);
$nextLink = $pageLink . ($page + $pageNum);

include $skinResourcePath . '/board.list.php';
?>
