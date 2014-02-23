<?php
if(!defined('GR_BOARD_2')) exit();

include 'write/query.php';
include 'write/model.php';
include 'write/error.php';

$Model = new Model($DB, $query, $grboard, $Common);

if( array_key_exists('post', $_GET) ) {
	$target = (int)$_GET['post'];
	$insertID = $Model->writePost($_POST, $target);
	if($insertID > 0) {
		header('Location: /' . $grboard . '/blog/view/' . $insertID);
	} else {
		$Common->error($error['msg_modify_fail']);
	}
}

$ext_articleNo = (int)$_GET['articleNo'];
$blogModify = $Model->getBlogPost($ext_articleNo);
$blogInfo = $Model->getBlogInfo('blog_title, blog_info, theme');
$skinResourcePath = '/' . $grboard . '/module/blog/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $query, $error, $blogModify, $blogInfo, $skinResourcePath, $skinPath);
?>