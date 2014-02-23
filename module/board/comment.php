<?php
if(!defined('GR_BOARD_2')) exit();

include 'comment/query.php';
include 'comment/model.php';
include 'comment/error.php';

$Model = new Model($DB, $query, $grboard, $Common);
$boardLink = '/' . $grboard . '/board-' . $ext_id;
$simplelock = substr(md5('GR_BOARD_2' . date('YmdH')), -4);

if( array_key_exists('commentProceed', $_POST) ) {
	$postID = (int)$_GET['commentNo'];
	$familyID = (int)$_POST['family_uid'];
	$isSecret = 0;
	if( array_key_exists('secret', $_POST)) $isSecret = 1;
	$isReply = 0;
	if( $familyID ) $isReply = 1;
	if( !$postID ) $Common->error($error['msg_wrong_parameter']);
	if( !$Common->getSessionKey() ) {
		if( !strlen($_POST['name']) || !strlen($_POST['password'])) {
			$Common->error($error['msg_input_is_empty']);
		}
		if( !strlen($_POST['simplelock']) || 
			$_POST['simplelock'] != substr(md5($postID . 'GR_BOARD_2' . date('YmdH')), -4) ) {
			$Common->error($error['msg_spam_filter']);
		}
	}
	if( !strlen($_POST['content']) ) $Common->error($error['msg_input_is_empty']);
	if( $Model->writeComment($ext_id, $_POST, $postID, $familyID, $isSecret) === true ) {
		header('Location: ' . $boardLink . '/view/' . $postID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

unset($Model, $query, $error, $simplelock);
?>