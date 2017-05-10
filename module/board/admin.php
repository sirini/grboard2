<?php
if(!defined('GR_BOARD_2')) exit();

include 'admin/error.php';
include 'admin/lang.korean.php';

if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);

$panel = 'board';
$target = 'add';
$boardId = '';
$memberId = 0;
$groupId = 0;
$page = 1;

if(isset($_GET['member'])) { $panel = 'member'; $target = $Common->getPlaneText($_GET['member']); } 
elseif(isset($_GET['modify2member'])) { $panel = 'member'; $memberId = (int)$_GET['modify2member']; $target = 'modify'; }
elseif(isset($_GET['delete2member'])) { $panel = 'member'; $memberId = (int)$_GET['delete2member']; $target = 'delete'; }
elseif(isset($_GET['page2member'])) { $panel = 'member'; $page = (int)$_GET['page2member']; $target = 'list'; }
elseif(isset($_GET['board'])) { $target = $Common->getPlaneText($_GET['board']); }
elseif(isset($_GET['modify2board'])) { $boardId = (int)$_GET['modify2board']; $target = 'modify'; }
elseif(isset($_GET['delete2board'])) { $boardId = (int)$_GET['delete2board']; $target = 'delete'; }
elseif(isset($_GET['page2board'])) { $panel = 'board'; $page = (int)$_GET['page2board']; $target = 'list'; }
elseif(isset($_GET['save'])) { $target = 'save'; }
elseif(isset($_GET['modify2group'])) { $target = 'group'; $groupId = (int)$_GET['modify2group']; } 
elseif(isset($_GET['delete2group'])) { $target = 'group'; $deleteGroupId = (int)$_GET['delete2group']; }
elseif(isset($_GET['modify2membergroup'])) { $panel = 'member'; $target = 'group'; $groupId = (int)$_GET['modify2membergroup']; } 
elseif(isset($_GET['delete2membergroup'])) { $panel = 'member'; $target = 'group'; $deleteGroupId = (int)$_GET['delete2membergroup']; }
elseif(isset($_GET['advanced'])) { $panel = 'advanced'; $target = $Common->getPlaneText($_GET['advanced']); } 

if($panel != 'advanced') {
	include 'admin/' . $panel . '/query.php';
	include 'admin/' . $panel . '/model.php';
	$Model = new Model($DB, $query, $grboard);
}

include 'admin/index.php';

unset($panel, $target, $boardId, $memberId, $page, $includePath); 
?>
