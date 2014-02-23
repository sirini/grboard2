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

$oldData = $Model->getBlogConfig();

$skin = 'basic';
$skinResourcePath = 'module/blog/admin/skin/' . $skin;
include 'skin/' . $skin . '/index.php';
?>