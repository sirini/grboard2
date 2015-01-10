<?php
if(!defined('GR_BOARD_2')) exit();
if(array_key_exists('option', $_GET)) $searchOption = $Common->getPlaneText($_GET['option']);
if(array_key_exists('value', $_GET)) $searchValue = $Common->getPlaneText($_GET['value']);
include 'list.php';
?>