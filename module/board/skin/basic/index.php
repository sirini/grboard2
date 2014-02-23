<?php
if(!defined('GR_BOARD_2')) exit();

if(strlen($boardInfo['head_file']) > 0) include $boardInfo['head_file'];
if(strlen($boardInfo['head_form']) > 0) {
	$boardInfo['head_form'] = str_replace(array('[grboard2skinname]', '[grboard2action]'), 
		array($boardInfo['theme'], $ext_action), $boardInfo['head_form']);
	echo $boardInfo['head_form'];
}

include $skinPath . '/' . $ext_action . '.php';

if(strlen($boardInfo['foot_form']) > 0) echo $boardInfo['foot_form'];
if(strlen($boardInfo['foot_file']) > 0) include $boardInfo['foot_file'];
?>