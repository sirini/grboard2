<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
if(!isset($title)) {
	$title = 'Add a new board';
	$mode = 'add';
	$oldData = array('no'=>'0', 'id'=>'', 'head_file'=>'', 'foot_file'=>'', 'head_form'=>'', 'foot_form'=>'', 'category'=>'',
		'page_num'=>'10', 'page_per_list'=>'20', 'enter_level'=>'1', 'master'=>'', 'theme'=>'basic', 'comment_page_num'=>'10',
		'comment_page_per_list'=>'100', 'num_file'=>'10', 'view_level'=>'1', 'write_level'=>'2', 'comment_write_level'=>'2',
		'cut_subject'=>'0', 'group_no'=>'1', 'name'=>'', 'down_level'=>'1');
	$oldData['head_form'] = '<!doctype html><head><meta charset="utf-8" /><title>GR Board 2 Board Page</title>' . "\n" .
		'<link rel="stylesheet" type="text/css" href="/'.$grboard.'/module/board/skin/[grboard2skinname]/style.css" />' . "\n" .
		'<script src="/'.$grboard.'/lib/jquery.js"></script>' . "\n" . 
		'<script src="/'.$grboard.'/module/board/skin/[grboard2skinname]/[grboard2action].skin.js"></script>' . "\n" .
		'</head><body style="text-align: center"><div style="width: 650px; margin: auto">';
	$oldData['foot_form'] = '</div></body></html>';
}
include $skinResourcePath . '/board.add.php';
?>