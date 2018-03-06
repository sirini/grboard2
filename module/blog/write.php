<?php
if(!defined('GR_BOARD_2')) exit();

include 'write/query.php';
include 'write/model.php';
include 'write/error.php';

$Model = new Model($DB, $query, $grboard, $Common);

/* for save user comment in board */
if(isset($_GET['comment'])) {
	$postID = (int)$_GET['comment'];
	$familyID = (int)$_POST['family_uid'];
	$isReply = 0;
	if( $familyID ) $isReply = 1;
	if( !$postID ) $Common->error($error['msg_wrong_parameter']);
	if( !$Common->getSessionKey() ) {
		if( !strlen(trim($_POST['name'])) || !strlen(trim($_POST['password']))) {
			$Common->error($error['msg_input_is_empty']);
		}
		if(!$Common->postGoogleRecaptcha($_POST['g-recaptcha-response'], $gr2cfg)) {
		    $Common->error($error['msg_spam_google_reject']);
		}
	}
	if( !strlen($_POST['content']) ) $Common->error($error['msg_input_is_empty']);
	if( $Model->writeComment($_POST, $postID, $familyID, $isReply) === true ) {
		header('Location: /' . $grboard . '/blog/view/' . $postID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

if(isset($_GET['post'])) {
	$insertID = $Model->writePost($_POST);
	if($insertID > 0) {
		header('Location: /' . $grboard . '/blog/view/' . $insertID);
	} else {
		$Common->error($error['msg_write_fail']);
	}		
}

/* for save user comment in guestbook */
if(isset($_GET['guestbook'])) {
	$isReply = (int)$_POST['reply_uid'];
	$isSecret = 0;
	if( array_key_exists('secret', $_POST) && $_POST['secret'] ) $isSecret = 1;
	if( !$Common->getSessionKey() ) {
		if( !strlen($_POST['name']) || !strlen($_POST['password'])) {
			$Common->error($error['msg_input_is_empty']);
		}
		if(!$Common->postGoogleRecaptcha($_POST['g-recaptcha-response'], $gr2cfg)) {
		    $Common->error($error['msg_spam_google_reject']);
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
$blogCategory = $Model->getBlogCategory();
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $query, $error, $blogInfo, $skinResourcePath, $blogCategory, $skinPath);
?>