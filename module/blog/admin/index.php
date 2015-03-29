<?php
if(!defined('GR_BOARD_2')) exit();

if(isset($_POST['blogConfigSave'])) {
	$ret = $Model->saveBlogConfig($_POST);
	if($ret == true) {
		$Common->error($error['msg_config_saved'], '/' . $grboard . '/blog', 'message');
	} else {
		$Common->error($error['msg_config_failed'], '/' . $grboard . '/blog/admin', 'error');
	}
}

if(isset($_POST['blogLinkSave'])) {
	$action = $_POST['blogLinkAction'];
	if($action == 'add') {
		if($Model->saveBlogLink($_POST) == false) {
			$Common->error($error['msg_link_failed'], '/' . $grboard . '/blog/admin/manage/link', 'error');
		}		
	} elseif ($action == 'update') {
		$Model->updateBlogLink($_POST);
		
	} elseif ($action == 'delete') {
		$Model->deleteBlogLink($_POST);
	}
	header('Location: /' . $grboard . '/blog/admin/manage/link');
}

$oldData = $Model->getBlogConfig();
$manage = 'config';
if(isset($_GET['manage'])) {
	$manage = $Common->getPlaneText($_GET['manage']);
	$oldLink = $Model->getBlogLink();
}

$skin = 'basic';
$skinResourcePath = $grboard . '/module/blog/admin/skin/' . $skin;
include 'skin/' . $skin . '/index.php';
?>