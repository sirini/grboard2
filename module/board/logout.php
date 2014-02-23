<?php
if(!defined('GR_BOARD_2')) exit();

include 'login/error.php';

if( !$Common->getSessionKey() ) $Common->error($error['msg_not_logged']);

session_destroy();

header('Location: /' . $grboard . '/board-' . $ext_id . '/list');
?>