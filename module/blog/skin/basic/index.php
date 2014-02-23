<?php 
if(!defined('GR_BOARD_2')) exit(); 
if($ext_action == 'modify') $ext_action = 'write';
$isSidebarOpen = ($ext_action != 'login' && $ext_action != 'write');
if($isSidebarOpen):
	$blogNotice = $Model->getBlogNotice(5);
	$blogRecentReply = $Model->getBlogRecentReply(10);
	$blogGuestbook = $Model->getBlogGuestbook(10);
	include $skinPath . '/header.php';
endif;
		
include $skinPath . '/' . $ext_action . '.php';
if($isSidebarOpen) include $skinPath . '/sidebar.php';	
unset($blogNotice, $blogRecentReply, $blogGuestbook);

include $skinPath . '/footer.php'; 
?>
