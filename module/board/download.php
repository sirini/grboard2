<?php
if(!defined('GR_BOARD_2')) exit();

include 'download/query.php';
include 'download/model.php';
include 'download/error.php';

if(array_key_exists('target', $_GET)) {
	$target = (int)$_GET['target'];
} else {
	$Common->error($error['msg_wrong_access'], $boardLink . '/list/1');
}
$Model = new Model($DB, $query, $grboard);
$fileInfo = $Model->getFileStore($target);
$boardInfo = $Model->getBoardInfo($fileInfo['board_id']);
$userInfo = $Model->getUserInfo($Common->getSessionKey());
$boardLink = '/' . $grboard . '/board-' . $fileInfo['board_id'];
if($userInfo['level'] < $boardInfo['view_level']) {
	$Common->error($error['msg_no_permission'], $boardLink . '/list/1');
}

$hash = '..' . $fileInfo['hash_name'];
$realArr = explode('/', $fileInfo['real_name']);
$real = $realArr[ count($realArr) - 1 ];
header('Content-type: file/unknown'); 
header('Content-Length: ' . filesize($hash)); 
header('Content-Disposition: attachment; filename=' . $real);
header('Content-Transfer-Encoding: binary'); 
header('Content-Description: GR Board 2 Generated Data'); 
header('Cache-Control: cache, must-revalidate');  
header('Pragma: no-cache'); 
header('Expires: 0'); 

$fp = fopen($hash, 'rb');
echo fread($fp, filesize($hash));
flush();
fclose($fp);

unset($Model, $error, $query, $fileInfo, $boardInfo, $userInfo, $boardLink, $fp);
?>