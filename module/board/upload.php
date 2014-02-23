<?php
if(!defined('GR_BOARD_2')) exit();

include 'upload/error.php';

if(!$Common->getSessionKey()) die('{"status":"error", "msg":"'.$error['msg_need_login'].'"}');

$uploadPath = 'data/board/' . $ext_id;
if(!is_dir('data/')) mkdir('data/', 0707);
if(!is_dir('data/board/')) mkdir('data/board/', 0707);
if(!is_dir($uploadPath)) mkdir($uploadPath, 0707);
$uploadPath .= '/' . date('Y');
if(!is_dir($uploadPath)) mkdir($uploadPath, 0707);
$uploadPath .= '/' . date('m');
if(!is_dir($uploadPath)) mkdir($uploadPath, 0707);
$uploadPath .= '/' . date('d');
if(!is_dir($uploadPath)) mkdir($uploadPath, 0707);
$uploadPath .= '/';

if(array_key_exists('mode', $_POST)) {
	$mode = $_POST['mode'];
	if ($mode == 'dnd') {
		$uploadPath = 'data/board/__gr2_dnd_temp__/';
		if(!is_dir($uploadPath)) mkdir($uploadPath, 0707);
	} 
} else $mode = '';

$uploadedList = array(array());
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && !empty($_FILES)) {
	foreach($_FILES['file']['tmp_name'] as $index => $tmpName) {
		if(!empty($_FILES['file']['error'][$index])) {
			die('{"status":"error", "msg":"' . $_FILES['file']['error'][$index] . '"}');
		}
		$now = time();
		$realname = strtolower($_FILES['file']['name'][$index]);
		$hashed = md5($now . $ext_id . $realname);
		$user = $Common->getSessionKey();
		if(!empty($tmpName) && is_uploaded_file($tmpName)) {
			if(move_uploaded_file($tmpName, $uploadPath . $hashed)) {
				$uploadedList[] = array('hash' => $hashed, 'real' => $realname);
			} else die('{"status":"error", "msg":"'.$error['msg_failed_upload'].'"}');
		} else die('{"status":"error", "msg":"'.$error['msg_failed_upload'].'"}');
	}
} else {
	$Common->error('Sorry, wrong access.');
}
$result = '{"status":"OK", "list":[';

foreach($uploadedList as &$file) {
	if(!array_key_exists('hash', $file)) continue;
	$result .= '{"hash":"' .'/'. $grboard .'/'. $uploadPath . $file['hash'] . '", "real":"' .
		'/'. $grboard .'/'. $uploadPath . $file['real'] . '"},';
}
$result = substr($result, 0, -1);
$result .= ']}';
echo $result;

unset($uploadPath, $mode, $uploadedList, $result);
?>