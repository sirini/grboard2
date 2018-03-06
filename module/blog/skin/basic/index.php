<?php 
if(!defined('GR_BOARD_2')) exit(); 
if($ext_action == 'modify') $ext_action = 'write';
$isSidebarOpen = ($ext_action != 'login' && $ext_action != 'write');
$blogCategory = $Model->getBlogCategory();
$blogNotice = $Model->getBlogNotice(5);
$blogRecentReply = $Model->getBlogRecentReply(10);
$blogGuestbook = $Model->getBlogGuestbook(10);

if($isSidebarOpen) include $skinPath . '/header.php';
include $skinPath . '/' . $ext_action . '.php';
if($isSidebarOpen) include $skinPath . '/sidebar.php';	
include $skinPath . '/footer.php'; 

unset($blogCategory, $blogNotice, $blogRecentReply, $blogGuestbook);
?>
