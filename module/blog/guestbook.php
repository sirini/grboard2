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
$guestbookPaging = $Paging->getPaging();
$guestbookTotalPage = $Paging->getTotalPage();
$guestbookTotalBlock = $Paging->getTotalBlock();
$guestbookNowBlock = $Paging->getNowBlock();
$blogLink = $Model->getBlogLink();
$simplelock = substr(md5('GR_BOARD_2' . date('YmdH') . 'GUESTBOOK'), -4);

include 'skin/' . $blogInfo['theme'] . '/guestbook.php';

unset($Model, $blogInfo, $guestbookCount, $Paging, $guestbookList, $skinResourcePath, $skinPath, $guestbookPaging, $guestbookTotalPage, $guestbookTotalBlock, $guestbookNowBlock, $blogLink, $query);
?>