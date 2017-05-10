<?php
if(!defined('GR_BOARD_2')) exit();

if( $Common->getSessionKey() != 1 ) $Common->error($error['msg_no_permission']);

include 'delete/model.php';
include 'delete/query.php';
include 'delete/error.php';

$Model = new Model($DB, $query, $grboard, $Common);

if( !array_key_exists('ISREADY2REMOVE', $_SESSION) || $_SESSION['ISREADY2REMOVE'] == 0 ) {

	if( array_key_exists('comment', $_GET) ) {
		$comment = (int)$_GET['comment'];
		$_SESSION['ISREADY2REMOVE'] = $comment;
		$postUID = $Model->getPostUid($comment);
		include 'delete/template.comment.php';
	}

	if( array_key_exists('post', $_GET) ) {
		// TODO
	}
	
	exit();

} else {

	if( array_key_exists('comment', $_GET) ) {
		$comment = (int)$_GET['comment'];
		$postUID = $Model->getPostUid($comment);
		
		if( $comment != (int)$_SESSION['ISREADY2REMOVE'] ) {
			$_SESSION['ISREADY2REMOVE'] = 0;
			$Common->error($error['msg_wrong_target'], '/' . $grboard . '/blog/view/' . $postUID);
		}

		$_SESSION['ISREADY2REMOVE'] = 0;
		if( $Model->deleteComment($comment) === true ) {
			header('Location: /' . $grboard . '/blog');
		} else {
			$Common->error($error['msg_delete_fail'], '/' . $grboard . '/blog/view/' . $postUID);
		}
	}

	if( array_key_exists('post', $_GET) ) {
		// TODO
	}
}
?>