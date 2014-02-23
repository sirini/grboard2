<?php
if(!defined('GR_BOARD_2')) exit();

include 'join/query.php';
include 'join/model.php';
include 'join/error.php';

if( $Common->getSessionKey() > 0 ) $Common->error($error['msg_already_logged']);
if(!isset($ext_id)) {
	$moveBackPath = '/';
	$prePath = '/' . $grboard . '/board';
}
else {
	$moveBackPath = '/' . $grboard . '/board-' . $ext_id . '/list/1';
	$prePath = '/' . $grboard . '/board-' . $ext_id;
}

$Model = new Model($DB, $query, $grboard, $Common);

if( array_key_exists('joinProceed', $_POST) ) {
	$ret = $Model->joinUs($_POST);
	if($ret == true) {
		header('Location: ' . $moveBackPath);
		exit();
	} elseif($ret == -1) {
		$Common->error($error['msg_empty_form']);
	} else {
		$Common->error($error['msg_id_exist']);
	}
}

$skin = 'basic';
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/join/skin/' . $skin;
$skinPath = 'module/board/join/skin/' . $skin;

include 'join/skin/basic/index.php';

unset($Model, $skinResourcePath, $skinPath, $query);
?>