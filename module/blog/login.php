<?php
if(!defined('GR_BOARD_2')) exit();

include 'login/query.php';
include 'login/model.php';
include 'login/error.php';

if( $Common->getSessionKey() > 0 ) $Common->error($error['msg_already_logged']);

$Model = new Model($DB, $query, $grboard, $Common);

if( array_key_exists('loginProceed', $_POST) ) {
	if( $Model->login($_POST['userid'], $_POST['passwd']) ) {
		header('Location: /' . $grboard . '/blog');
		exit();
	} else {
		$Common->error($error['msg_wrong_input']);
	}
}

$blogInfo = $Model->getBlogInfo();
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];

include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $blogInfo, $skinResourcePath, $skinPath, $blogLink, $query);
?>