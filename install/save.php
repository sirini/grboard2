<?php
header('Content-type: text/html; charset=utf-8');

$docRootArr = explode('/', $_SERVER['DOCUMENT_ROOT']);
$root = $docRootArr[count($docRootArr) - 2];
$grboardArr = explode(DIRECTORY_SEPARATOR, dirname('../'));
$grboard = end($grboardArr);
if($root == $grboard) $grboard = '.';

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

if(file_exists('../.htaccess')) {
	chmod('../.htaccess', 0707);
	unlink('../.htaccess');
}
$htaccess = '<IfModule mod_rewrite.c>' . "\n" .
	'RewriteBase /'.$grboard. "\n" .
    'RewriteEngine On'. "\n" .
    'RewriteCond %{REQUEST_FILENAME} !-d'. "\n" .
    'RewriteCond %{REQUEST_FILENAME} !-f'. "\n\n" .

    'RewriteRule ^([a-zA-Z0-9]+)$ index.php?module=$1&action=list&page=1'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)$ index.php?module=$1&action=$2'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)\/([a-zA-Z]+)$ index.php?module=$1&action=$2&$3'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)\/([0-9]+)$ index.php?module=$1&action=$2&articleNo=$3&target=$3&page=$3'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)$ index.php?module=$1&action=$2&$3=$4'. "\n\n" .

    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)$ index.php?module=$1&id=$3&action=$4'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&page=$5&articleNo=$5&commentNo=$5'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([a-zA-Z]+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&$5=$6'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)/([a-zA-Z]+)\/(.+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&option=$5&value=$6&page=$7'. "\n" .
'</IfModule>';
file_put_contents('../.htaccess', $htaccess);

$msg = file_get_contents('../page/info/install_complete.txt');
$msg = str_replace('{grboard}', $grboard, $msg);
$moveBackPath = '/' . $grboard . '/board-test/login';
include '../message.php';
?>