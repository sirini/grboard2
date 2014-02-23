<?php
if(!defined('GR_BOARD_2')) exit();

include 'admin/error.php';
include 'admin/lang.korean.php';

if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);

include 'admin/query.php';
include 'admin/model.php';

$Model = new Model($DB, $query, $grboard);
include 'admin/index.php';
?>