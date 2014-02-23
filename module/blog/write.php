<?php
if(!defined('GR_BOARD_2')) exit();

include 'write/query.php';
include 'write/model.php';
include 'write/error.php';

$Model = new Model($DB, $query, $grboard, $Common);

if( array_key_exists('comment', $_GET) ) {
	$postID = (int)$_GET['comment'];
	$familyID = (int)$_POST['family_uid'];
	$isReply = 0;
	if( $familyID ) $isReply = 1;
	if( !$postID ) $Common->error($error['msg_wrong_parameter']);
	if( !$Common->getSessionKey() ) {
		if( !strlen(trim($_POST['name'])) || !strlen(trim($_POST['password']))) {
			$Common->error($error['msg_input_is_empty']);
		}
		if( !strlen($_POST['simplelock']) || 
			$_POST['simplelock'] != substr(md5($postID . 'GR_BOARD_2' . date('YmdH')), -4) ) {
			$Common->error($error['msg_input_is_empty']);
		}
	}
	if( !strlen($_POST['content']) ) $Common->error($error['msg_input_is_empty']);
	if( $Model->writeComment($_POST, $postID, $familyID, $isReply) === true ) {
		header('Location: /' . $grboard . '/blog/view/' . $postID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

if( array_key_exists('post', $_GET) ) {
	$insertID = $Model->writePost($_POST);
	if($insertID > 0) {
		header('Location: /' . $grboard . '/blog/view/' . $insertID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

if( array_key_exists('guestbook', $_GET) ) {
	$isReply = (int)$_POST['reply_uid'];
	$isSecret = 0;
	if( array_key_exists('secret', $_POST) && $_POST['secret'] ) $isSecret = 1;
	if( !$Common->getSessionKey() ) {
		if( !strlen($_POST['name']) || !strlen($_POST['password'])) {
			$Common->error($error['msg_input_is_empty']);
		}
		if( !strlen($_POST['simplelock']) || 
			$_POST['simplelock'] != substr(md5('GR_BOARD_2' . date('YmdH') . 'GUESTBOOK'), -4) ) {
			$Common->error($error['msg_input_is_empty']);
		}
	}
	if( !strlen($_POST['content']) ) $Common->error($error['msg_input_is_empty']);
	if( $Model->writeGuestbook($_POST, $isReply, $isSecret) === true ) {
		header('Location: /' . $grboard . '/blog/guestbook');
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

$blogInfo = $Model->getBlogInfo('blog_title, blog_info, theme');
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $query, $error, $blogInfo, $skinResourcePath, $skinPath);
?>