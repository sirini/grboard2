<?php
if(!defined('GR_BOARD_2')) exit();

include 'list/query.php';
include 'list/model.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$blogInfo = $Model->getBlogInfo();
$blogTotalRecord = $Model->getBlogPostCount();
$Paging = new Paging($blogInfo['num_view_post'], $blogInfo['num_per_page'], $ext_page, $blogTotalRecord);
$blogPost = $Model->getBlogPost($Paging->getStartRecord(), $blogInfo['num_view_post'], $ext_page);
$skinResourcePath = '/' . $grboard . '/module/blog/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
$blogPaging = $Paging->getPaging();
$blogTotalPage = $Paging->getTotalPage();
$blogTotalBlock = $Paging->getTotalBlock();
$blogNowBlock = $Paging->getNowBlock();
$blogLink = $Model->getBlogLink();

include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $blogInfo, $blogTotalRecord, $Paging, $blogPost, $skinResourcePath, $skinPath, $blogPaging, $blogTotalBlock, $blogNowBlock, $blogGuestbook, $blogLink, $query);
?>