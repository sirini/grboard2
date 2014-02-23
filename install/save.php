<?php
header('Content-type: text/html; charset=utf-8');

$grboardArr = explode(DIRECTORY_SEPARATOR, realpath('../'));
$grboard = end($grboardArr);

if(!isset($_POST['db_hostname'])) die('<h2>Failed</h2> Unknown DB hostname.');
else $db_hostname = trim($_POST['db_hostname']);
if(!isset($_POST['db_username'])) die('<h2>Failed</h2> Unknown DB user name.');
else $db_username = trim($_POST['db_username']);
if(!isset($_POST['db_password'])) die('<h2>Failed</h2> Unknown DB user password.');
else $db_password = trim($_POST['db_password']);
if(!isset($_POST['db_dbname'])) die('<h2>Failed</h2> Unknown DB name.');
else $db_dbname = trim($_POST['db_dbname']);
if(!isset($_POST['db_prefix_board'])) die('<h2>Failed</h2> Unknown db table prefix (board).');
else $db_prefix_board = trim($_POST['db_prefix_board']);
if(!isset($_POST['db_prefix_blog'])) die('<h2>Failed</h2> Unknown db table prefix (blog).');
else $db_prefix_blog = trim($_POST['db_prefix_blog']);
if(!isset($_POST['admin_id'])) die('<h2>Failed</h2> Unknown administrator ID.');
else $admin_id = trim($_POST['admin_id']);
if(!isset($_POST['admin_pw'])) die('<h2>Failed</h2> Unknown administrator password.');
else $admin_pw = trim($_POST['admin_pw']);

include 'grblog.sql.php';
include 'grboard.sql.php';

$dbLink = mysqli_connect($db_hostname, $db_username, $db_password, $db_dbname) or die('<h2>Failed</h2>' . mysqli_error($dbLink));
foreach($queBoardArr as &$que) {
	mysqli_query($dbLink, $que) or die('<h2>Failed</h2>' . mysqli_error($dbLink));
}
foreach($queBlogArr as &$que) {
	mysqli_query($dbLink, $que) or die('<h2>Failed</h2>' . mysqli_error($dbLink));
}
mysqli_close($dbLink);

$dbinfo = '<?php'."\n".
'$db_hostname = \''.$db_hostname.'\';'."\n".
'$db_username = \''.$db_username.'\';'."\n".
'$db_password = \''.$db_password.'\';'."\n".
'$db_dbname = \''.$db_dbname.'\';'."\n".
'$db_prefix_board = \''.$db_prefix_board.'\';'."\n".
'$db_prefix_blog = \''.$db_prefix_blog.'\';'."\n".
'$db_is_utf8 = true;'."\n".
'?>';
file_put_contents('../dbinfo.php', $dbinfo);

if(!is_dir('../data/')) mkdir('../data', 0707);
if(!is_dir('../data/blog/')) mkdir('../data/blog', 0707);
if(!is_dir('../data/board/')) mkdir('../data/board', 0707);
if(!is_dir('../session/')) mkdir('../session', 0707);

$msg = '<p>설치가 완료 되었습니다! <a href="/'.$grboard.'/board-test/login">여기를 클릭 하여 로그인 하세요!</a></p>' . 
		'<p>Installation has been completed! <a href="/'.$grboard.'/board-test/login">Please go to the login page now! (Click this)</a></p>';
$moveBackPath = '/' . $grboard . '/board-test/login';
include '../message.php';
?>