<?php 
if(!defined('GR_BOARD_2')) exit(); 
$blogCategory = $Model->getBlogCategory();
$blogNotice = $Model->getBlogNotice(5);
$blogRecentReply = $Model->getBlogRecentReply(10);
$blogGuestbook = $Model->getBlogGuestbook(10);

include $skinPath . '/header.php';
include $skinPath . '/guestbook.list.php';
include $skinPath . '/footer.php'; 
?>