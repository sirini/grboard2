<?php
if(!defined('GR_BOARD_2')) exit();

include 'comment/query.php';
include 'comment/model.php';
include 'comment/error.php';

$Model = new Model($DB, $query, $grboard, $Common);
if(!isset($boardLink)) $boardLink = '/' . $grboard . '/board-' . $ext_id;

if(isset($_POST['commentProceed'])) {
	$postID = (int)$_GET['commentNo'];
	$familyID = (int)$_POST['family_uid'];
	$isSecret = 0;
	if(isset($_POST['secret'])) $isSecret = 1;
	$isReply = 0;
	if($familyID) $isReply = 1;
	if(!$postID) $Common->error($error['msg_wrong_parameter']);
	if(!$Common->getSessionKey()) {
		if( !strlen($_POST['name']) || !strlen($_POST['password'])) {
			$Common->error($error['msg_input_is_empty']);
		}
		if(isset($_POST['g-recaptcha-response'])) {
			$reCAPTCHA = array('secret'=>$gr2cfg['googleRecaptchaSecretKey'], 'response'=>$_POST['g-recaptcha-response'], 'remoteip'=>$_SERVER['REMOTE_ADDR']);
			$googleResponse = $Common->getUrlContents($gr2cfg['googleRecaptchaRequestUrl'], $reCAPTCHA);
			$resp = json_decode($googleResponse, true);
			if(intval($resp["success"]) !== 1) {
				$Common->error($error['msg_spam_filter'] . ' >>> ' . $googleResponse);
			}
		} else {
			$Common->error($error['msg_spam_filter']);
		}
	}
	if(!strlen($_POST['content'])) $Common->error($error['msg_input_is_empty']);
	if($Model->writeComment($ext_id, $_POST, $postID, $familyID, $isSecret) === true) {
		header('Location: ' . $boardLink . '/view/' . $postID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
} else if(isset($_POST['modifyProceed'])) {
	$postID = (int)$_GET['commentNo'];
	if(!$postID) $Common->error($error['msg_wrong_parameter']);
	$isSecret = 0;
	if(isset($_POST['secret'])) $isSecret = 1;
	if(!strlen($_POST['content'])) $Common->error($error['msg_input_is_empty']);
	if($Model->modifyComment($ext_id, $_POST['content'], $_POST['comment_uid'], $isSecret) === true) {
		header('Location: ' . $boardLink . '/view/' . $postID);
	} else {
		$Common->error($error['msg_write_fail']);
	}
}

unset($Model, $query, $error);
?>