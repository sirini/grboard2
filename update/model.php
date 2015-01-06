<?php
include 'lang.korean.php';
$mysqli = null;
$updates = array();

if(!file_exists('../dbinfo.php')) {
	header('location: ../index.php');
	exit();
} else {
	include '../dbinfo.php';
	$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_dbname);
	if ($mysqli->connect_errno) {
		die($lang['error_db_connection']);
	}
}

// Update to beta3 from beta2
$updates[] = "ALTER TABLE `gr_board_list` ADD `theme_mobile` VARCHAR(100) NOT NULL AFTER `theme`";
$updates[] = "UPDATE gr_board_list SET theme_mobile = 'basic' WHERE theme_mobile = ''";

// run all queries
foreach($updates as &$que) {
	$mysqli->query($que);
}

// clean up
$mysqli->close();
unset($updates, $mysqli);
?>