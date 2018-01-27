<?php
if(!defined('GR_BOARD_2')) exit();
if(!isset($_POST['id'])) die('invalid request.');
$id = $Common->getPlaneText($_POST['id']);
if(strlen($id) < 1) die('no keyword.');

$que = $DB->query('select id, nickname from ' . $db_prefix_board . 'member_list where id like \'%'.$id.'%\' order by no asc limit 5');
$result = '[';
while($f = $DB->fetch($que)) {
    $result .= '{"id":"'.$f['id'].'", "nickname":"'.addslashes($f['nickname']).'"},';
}

$len = strlen($result);
if($len > 1) $result = substr($result, 0, -1);
$result .= ']';
$DB->free($que);

echo $result;
unset($id, $que, $result, $len);
?>