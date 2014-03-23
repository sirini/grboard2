<?php
if(!$_POST['path']) die('Wrong access.');
$path = $_POST['path'];
$pathArr = explode('/', $path);
$pathName = end($pathArr);
$tempDir = '../../../data/blog/__gr2_dnd_temp__/';
unlink($tempDir . $pathName);
?>