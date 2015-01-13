<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($searchOption)) $searchOption = '';
if(!isset($searchValue)) $searchValue = '';

if(isset($_GET['list'])) { $mobileAction = 'list'; $ext_page = $_GET['list']; }
elseif(isset($_GET['view'])) { $mobileAction = 'view'; $ext_articleNo = $_GET['view']; }
elseif(isset($_GET['write'])) { 
	$mobileAction = 'write';
	$_GET['articleNo'] = $_GET['write'];
	if(isset($_POST['gr2content'])) {
		$_POST['gr2content'] = nl2br($_POST['gr2content']);
	}
}
elseif(isset($_GET['comment'])) { $mobileAction = 'comment'; $_GET['commentNo'] = $_GET['comment']; }
elseif(isset($_GET['modifycomment'])) { $mobileAction = 'modifycomment'; $_GET['commentNo'] = $_GET['modifycomment']; }
elseif(isset($_GET['deletecomment'])) { $mobileAction = 'deletecomment'; $_GET['commentNo'] = $_GET['deletecomment']; }
elseif(isset($_GET['login'])) {
	$mobileAction = 'login';
	$moveBackPath = '/' . $grboard . '/board-' . $ext_id . '/mobile/list/1';
	$prePath = '/' . $grboard . '/board-' . $ext_id . '/mobile';
}
elseif(isset($_GET['logout'])) $mobileAction = 'logout';
elseif(isset($_GET['join'])) $mobileAction = 'join';
elseif(isset($_GET['managepost'])) $mobileAction = 'managepost';
elseif(isset($_GET['option']) && isset($_GET['value'])) $mobileAction = 'search';

$isAdmin = (($Common->getSessionKey() == 1) ? true : false);
$isMember = (($Common->getSessionKey() > 0) ? true : false);
$mobilePath = 'module/board';
$skinResourcePrefix = '/' . $grboard . '/module/board/mobile/skin/';
$skinPathPrefix = $mobilePath . '/mobile/skin/';
$skinIncludePrefix = 'mobile/skin/';
$boardLink = '/' . $grboard . '/board-' . $ext_id . '/mobile';

include 'module/board/' . $mobileAction . '.php';
unset($isAdmin, $isMember, $mobilePath, $mobileAction, $skinResourcePrefix, $skinPathPrefix, $skinIncludePrefix, $boardLink);
?>