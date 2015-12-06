<?php
if(!defined('GR_BOARD_2')) exit();
if(isset($_GET['value'])) $searchValue = str_replace(array('-', ';'), '', $_GET['value']);
include 'list.php';
?>