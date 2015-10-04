<?php
if(!defined('GR_BOARD_2')) exit();

if(isset($_POST['blogConfigSave'])) {
	$ret = $Model->saveBlogConfig($_POST);
	if($ret == true) {
		$Common->info($error['msg_config_saved'], '/' . $grboard . '/blog');
	} else {
		$Common->error($error['msg_config_failed'], '/' . $grboard . '/blog/admin');
	}
}

if(isset($_POST['blogCategorySave'])) {
	$action = $_POST['blogCategoryAction'];
	if($action == 'add') {
		if($Model->saveBlogCategory($_POST) == false) {
			$Common->error($error['msg_category_failed'], '/' . $grboard . '/blog/admin/manage/category');
		}		
	} elseif ($action == 'update') {
		$Model->updateBlogCategory($_POST);
		
	} elseif ($action == 'delete') {
		if($Model->deleteBlogCategory($_POST) == false) {
			$Common->error($error['msg_category_minimum_count'], '/' . $grboard . '/blog/admin/manage/category');
		}
	}
	header('Location: /' . $grboard . '/blog/admin/manage/category');
}

if(isset($_POST['blogLinkSave'])) {
	$action = $_POST['blogLinkAction'];
	if($action == 'add') {
		if($Model->saveBlogLink($_POST) == false) {
			$Common->error($error['msg_link_failed'], '/' . $grboard . '/blog/admin/manage/link');
		}		
	} elseif ($action == 'update') {
		$Model->updateBlogLink($_POST);
		
	} elseif ($action == 'delete') {
		$Model->deleteBlogLink($_POST);
	}
	header('Location: /' . $grboard . '/blog/admin/manage/link');
}

$manage = 'config';
$oldData = $Model->getBlogConfig();
if(isset($_GET['manage'])) {
	$manage = $Common->getPlaneText($_GET['manage']);
	if ($manage == 'link') $oldLink = $Model->getBlogLink();
	elseif ($manage == 'category') $oldCategory = $Model->getBlogCategory();
}

$skin = 'basic';
$skinResourcePath = $grboard . '/module/blog/admin/skin/' . $skin;
include 'skin/' . $skin . '/index.php';
?>