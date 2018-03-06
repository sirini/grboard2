<?php
if(!defined('GR_BOARD_2')) exit();

include 'guestbook/query.php';
include 'guestbook/model.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$blogInfo = $Model->getBlogInfo();
$guestbookCount = $Model->getGuestbookCount();
$Paging = new Paging($blogInfo['num_view_post'], $blogInfo['num_per_page'], $ext_page, $guestbookCount);
$guestbookList = $Model->getGuestbookList($Paging->getStartRecord(), $blogInfo['num_view_post']);
$skinResourcePath = '/' . $grboard . '/module/blog/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];

$blogPaging = $Paging->getPaging();
$blogTotalPage = $Paging->getTotalPage();
$blogTotalBlock = $Paging->getTotalBlock();
$blogNowBlock = $Paging->getNowBlock();
$blogLink = $Model->getBlogLink();

include 'skin/' . $blogInfo['theme'] . '/guestbook.php';

unset($Model, $blogInfo, $guestbookCount, $Paging, $guestbookList, $skinResourcePath, $skinPath, $blogPaging, $blogTotalPage, $blogTotalBlock, $blogNowBlock, $blogLink, $query);
?>