<?php
if(!defined('GR_BOARD_2')) exit();

$mobileAction = 'list';
if(isset($_GET['view'])) {
	$mobileAction = 'view';
	$ext_articleNo = $_GET['view'];
}
elseif(isset($_GET['write'])) {
	$mobileAction = 'write';
	$articleNo = $_GET['write'];
}
elseif(isset($_GET['option']) && isset($_GET['value'])) {
	$mobileAction = 'search';
}

$isAdmin = (($Common->getSessionKey() == 1) ? true : false);
$isMember = (($Common->getSessionKey() > 0) ? true : false);
$mobilePath = 'module/board';
include 'mobile/' . $mobileAction . '.php';
unset($mobilePath, $mobileAction);
?>