<?php
if(!defined('GR_BOARD_2')) exit();

include 'memo/query.php';
include 'memo/model.php';
include 'memo/error.php';

$moveBackPath = '/';
$prePath = '/' . $grboard . '/board';
if(isset($ext_id)) {
	$moveBackPath = '/' . $grboard . '/board-' . $ext_id . '/list/1';
	$prePath = '/' . $grboard . '/board-' . $ext_id;
}

$userSessionKey = $Common->getSessionKey();
if( $userSessionKey < 1 ) $Common->error($error['msg_no_permission'], $prePath . '/login');
$Model = new Model($DB, $query, $grboard, $Common);

if(isset($_POST['memoSendProceed'])) {
	$ret = $Model->sendMemo($userSessionKey, $_POST);
	if($ret == true) {
		$Common->error($error['msg_send_success'], '/' . $grboard . '/board/memo', 'message', 3000);
	} elseif($ret == -1) {
		$Common->error($error['msg_unknown_id'], '/' . $grboard . '/board/memo');
	} else {
		$Common->error($error['msg_send_fail'], '/' . $grboard . '/board/memo');
	}
}

$mode = 'list';
$page = 1;
$pageNum = 10;
$pagePerList = 10;
$memoList = false;
$totalMessage = 0;

if(isset($_GET['write'])) {
	$mode = 'write';
	$target = (int)$_GET['write'];
	$oldData = array('id'=>'', 'memo'=>'');
	if($target) {
		$oldData = $Model->getTargetInfo($target);
	}
}
else {
	if(isset($_GET['page'])) $page = (int)$_GET['page'];
	$page = ($page > 0) ? $page : 1;
	$memoList = $Model->getMemoList($userSessionKey, $page, $pageNum);
	$totalMessage = $Model->getTotalMessage($userSessionKey);
	
	include 'util/common/paging.php';
	$Paging = new Paging($pageNum, $pagePerList, $page, $totalMessage);
	$memoPaging = $Paging->getPaging();
	$memoTotalPage = $Paging->getTotalPage();
	$memoTotalBlock = $Paging->getTotalBlock();
	$memoNowBlock = $Paging->getNowBlock();
	$memoLink = $prePath . '/memo/';
	$prevLink = $memoLink . ($ext_page - $pagePerList);
	$nextLink = $memoLink . ($ext_page + $pagePerList);
	$pageLink = $memoLink;
}

$skin = 'basic';
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/memo/skin/' . $skin;
$skinPath = 'module/board/memo/skin/' . $skin;

include 'memo/skin/'.$skin.'/index.php';

unset($Model, $skinResourcePath, $skinPath, $query, $mode, $memo, $page, $pageNum, $pagePerList, $memoList, $totalMessage, $target, $oldData,
	$Paging, $memoPaging, $memoTotalPage, $memoTotalBlock, $memoNowBlock, $memoLink, $prevLink, $nextLink, $pageLink);
?>