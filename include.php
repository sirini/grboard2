<?php
if(!isset($grboard)) die('Please setup the $grboard path in your page.');
if(!defined('GR_BOARD_2')) {
	header('Content-type: text/html; charset=utf-8');
	@session_save_path($grboard . '/session');
	@session_start();
	include $grboard . '/util/common/common.php';
	include $grboard . '/dbinfo.php';
	include $grboard . '/util/db/mysql.php';
	$Common = new Common($grboard);
	$DB = new MySQL($db_hostname, $db_username, $db_password, $db_dbname, $db_is_utf8);
	unset($db_hostname, $db_username, $db_password, $db_dbname);
}

$queArr = array(
	'list' => 'select no, subject, name from ' . $db_prefix_board . 'bbs_{0} order by no {1} limit {2}'
);

function gr2data($que, $colArr) {
	global $DB;
	$ret = $DB->query($que);
	$result = array(array());
	$index = 0;
	while($f = $ret->fetch_array()) {
		foreach($colArr as &$col) {
			$result[$index][$col] = stripslashes($f[$col]);
		}
		++$index;
	}
	$ret->free();
	return $result;
}

function gr2list($id, $orderBy='desc', $limit=5, $cutstr=0) {
	global $Common, $DB, $queArr;
	$que = str_replace(array('{0}', '{1}', '{2}'), array($id, $orderBy, $limit), $queArr['list']);
	$colArr = array('no', 'subject', 'name');
	$data = gr2data($que, $colArr);
	if($cutstr > 0) {
		for($i=0; $i<$limit; $i++) {
			$data[$i]['subject'] = $Common->getSubStr($data[$i]['subject'], $cutstr);
		}
	}
	return $data;
}

function gr2session() {
	global $Common;
	return $Common->getSessionKey();
}
?>