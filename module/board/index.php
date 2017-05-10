<?php
if(!defined('GR_BOARD_2')) exit();
if(isset($_GET['page'])) $ext_page = (int)$_GET['page']; else $ext_page = 1;
if(isset($_GET['articleNo'])) $ext_articleNo = (int)$_GET['articleNo']; else $ext_articleNo = 0;
if(isset($_GET['id'])) $ext_id = $Common->getPlaneText($_GET['id']);
include $ext_action . '.php';
?>
