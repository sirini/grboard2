<?php
if(!defined('GR_BOARD_2')) exit();

include 'login/query.php';
include 'login/model.php';
include 'login/error.php';

if( $Common->getSessionKey() > 0 ) $Common->error($error['msg_already_logged']);

$Model = new Model($DB, $query, $grboard, $Common);
if(!isset($ext_id)) {
	$moveBackPath = '/';
	$prePath = '/' . $grboard . '/board';
}
else {
	$moveBackPath = '/' . $grboard . '/board-' . $ext_id . '/list/1';
	$prePath = '/' . $grboard . '/board-' . $ext_id;
}

if( array_key_exists('loginProceed', $_POST) ) {
	if( $Model->login($_POST['userid'], $_POST['passwd']) ) {
		header('Location: ' . $moveBackPath);
		exit();
	} else {
		$Common->error($error['msg_wrong_input']);
	}
}

$skin = 'basic';
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/login/skin/' . $skin;
$skinPath = 'module/board/login/skin/' . $skin;

include 'login/skin/basic/index.php';

unset($Model, $skinResourcePath, $skinPath, $query);
?>