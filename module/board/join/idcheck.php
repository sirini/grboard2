<?php
if(!isset($_POST['id'])) exit();
$id = htmlspecialchars(addcslashes(addslashes(trim($_POST['id'])), '%_'));
include '../../../dbinfo.php';
$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_dbname);
$existId = $mysqli->query('select no from ' . $db_prefix_board . 'member_list where id = \''.$id.'\' limit 1');
$result = $existId->fetch_array();
if($result['no']) echo 'true'; else echo 'false';
$existId->free();
$mysqli->close();
?>