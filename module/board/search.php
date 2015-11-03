<?php
if(!defined('GR_BOARD_2')) exit();
if(isset($_GET['option'])) {
	$searchOption = $Common->getPlaneText($_GET['option']);
	$whiteList = array('name', 'email', 'homepage', 'category', 'subject', 'content', 'tag');
	if(!in_array($searchOption, $whiteList)) {
		$searchOption = 'subject';
	}	
}
if(isset($_GET['value'])) $searchValue = str_replace(array('-', ';'), '', $_GET['value']);
include 'list.php';
?>