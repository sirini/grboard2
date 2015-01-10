<?php
if(!defined('GR_BOARD_2')) exit();
if(isset($_GET['option'])) $searchOption = $Common->getPlaneText($_GET['option']);
if(isset($_GET['value'])) $searchValue = $Common->getPlaneText($_GET['value']);
include $mobilePath . '/mobile/list.php';
?>