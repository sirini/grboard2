<?php
if(!defined('GR_BOARD_2')) exit();

include 'list/query.php';
include 'list/model.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$blogInfo = $Model->getBlogInfo();
$blogPost = $Model->getBlogView($ext_articleNo);
$blogReply = $Model->getBlogReply($ext_articleNo);
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
$blogLink = $Model->getBlogLink();
$simplelock = substr(md5($blogPost['uid'] . 'GR_BOARD_2' . date('YmdH')), -4);

include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $blogInfo, $blogPost, $skinResourcePath, $skinPath, $blogLink, $query);
?>