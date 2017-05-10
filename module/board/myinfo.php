<?php
if(!defined('GR_BOARD_2')) exit();

include 'myinfo/query.php';
include 'myinfo/model.php';
include 'myinfo/error.php';

if( $Common->getSessionKey() == 0 ) {
	$Common->error($error['msg_not_logged_in']);
}
if(!isset($ext_id)) {
	$moveBackPath = '/';
	$prePath = '/' . $grboard . '/board';
}
else {
	$moveBackPath = '/' . $grboard . '/board-' . $ext_id . '/list/1';
	$prePath = '/' . $grboard . '/board-' . $ext_id;
}

$Model = new Model($DB, $query, $grboard, $Common);
$myinfo = $Model->getMyInfo();

if(isset($_POST['updateMyInfoProceed'])) {
	$ret = $Model->updateMyInfo($_POST);
	if($ret == true) {
		$Common->info($error['msg_ok'], $moveBackPath);
		exit();
	} elseif($ret == -1) {
		$Common->error($error['msg_empty_form']);
	} else {
		$Common->error($error['msg_failed_to_update']);
	}
}

$skin = 'basic';
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/myinfo/skin/' . $skin;
$skinPath = 'module/board/myinfo/skin/' . $skin;
include 'myinfo/skin/'.$skin.'/index.php';

unset($Model, $skinResourcePath, $skinPath, $skin, $query);
?>