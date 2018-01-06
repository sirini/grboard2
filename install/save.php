<?php
header('Content-type: text/html; charset=utf-8');

$docRootArr = explode(DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']);
$root = $docRootArr[count($docRootArr) - 1];
$grboardArr = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$grboard = $grboardArr[count($grboardArr) - 2];
if($root == $grboard) $grboard = '.';

include '../util/common/common.php';
$common = new Common($grboard);

if(!isset($_POST['db_hostname'])) $common->error('Unknown DB hostname - DB 호스트네임 값이 넘어오지 않았습니다');
else $db_hostname = trim($_POST['db_hostname']);
if(!isset($_POST['db_username'])) $common->error('Unknown DB user name - DB 사용자명 값이 넘어오지 않았습니다');
else $db_username = trim($_POST['db_username']);
if(!isset($_POST['db_password'])) $common->error('Unknown DB user password - DB 사용자 비밀번호 값이 넘어오지 않았습니다');
else $db_password = trim($_POST['db_password']);
if(!isset($_POST['db_dbname'])) $common->error('Unknown DB name - DB 이름 값이 넘어오지 않았습니다');
else $db_dbname = trim($_POST['db_dbname']);
if(!isset($_POST['db_prefix_board'])) $common->error('Unknown db table prefix (board) - DB 테이블 앞에 공통으로 들어가는 문자열이 넘어오지 않았습니다');
else $db_prefix_board = trim($_POST['db_prefix_board']);
if(!isset($_POST['db_prefix_blog'])) $common->error('Unknown db table prefix (blog) - DB 테이블 앞에 공통으로 들어가는 문자열이 넘어오지 않았습니다');
else $db_prefix_blog = trim($_POST['db_prefix_blog']);
if(!isset($_POST['admin_id'])) $common->error('Unknown administrator ID - 관리자 아이디 값이 넘어오지 않았습니다');
else $admin_id = trim($_POST['admin_id']);
if(!isset($_POST['admin_pw'])) $common->error('Unknown administrator password- 관리자 비밀번호 값이 넘어오지 않았습니다');
else $admin_pw = trim($_POST['admin_pw']);

include 'grblog.sql.php';
include 'grboard.sql.php';

$dbLink = @mysqli_connect($db_hostname, $db_username, $db_password, $db_dbname);
if(!$dbLink) {
	$common->error('Failed to connect to MySQLi server - MySQL DB서버에 연결 할 수 없습니다 ('.$db_hostname.', '.$db_username.', '.$db_password.', '.$db_dbname.')');
}
foreach($queBoardArr as &$que) {
	mysqli_query($dbLink, $que);
}
foreach($queBlogArr as &$que) {
	mysqli_query($dbLink, $que);
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
    'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)$ index.php?module=$1&action=$2&$3=$4'. "\n" .
	'RewriteRule ^([a-zA-Z0-9]+)\/([a-zA-Z0-9_]+)\/([a-zA-Z0-9_]+)\/(.+)\/([0-9]+)$ index.php?module=$1&action=$2&option=$3&value=$4&page=$5'. "\n\n" .

    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)$ index.php?module=$1&id=$3&action=$4'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&page=$5&articleNo=$5&commentNo=$5'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([a-zA-Z]+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&$5=$6'. "\n" .
    'RewriteRule ^([a-zA-Z0-9]+)(\-)([a-zA-Z0-9_]+)\/([a-zA-Z0-9]+)\/([a-zA-Z]+)\/(.+)\/([0-9]+)$ index.php?module=$1&id=$3&action=$4&option=$5&value=$6&page=$7'. "\n" .
'</IfModule>';
file_put_contents('../.htaccess', $htaccess);

$cfgFile = '<?php'."\n".
	'// Please refer this url: https://www.google.com/recaptcha/ for get your own key.'."\n".
	'$gr2cfg[\'googleRecaptchaApiUrl\'] = \'https://www.google.com/recaptcha/api.js\';'."\n".
	'$gr2cfg[\'googleRecaptchaSiteKey\'] = \''.$_POST['google_recaptcha_sitekey_id'].'\';  // Please update this key for your own'."\n".
	'$gr2cfg[\'googleRecaptchaSecretKey\'] = \''.$_POST['google_recaptcha_secretkey_id'].'\';  // Please update this key for your own (Be sure keep it a secret)'."\n".
	'$gr2cfg[\'googleRecaptchaRequestUrl\'] = \'https://www.google.com/recaptcha/api/siteverify\';'."\n".
	'?>';
file_put_contents('../common.config.php', $cfgFile);

$msg = file_get_contents('../page/info/install_complete.txt');
$msg = str_replace('{grboard}', $grboard, $msg);
$moveBackPath = '/' . $grboard . '/board-test/login';
include '../message.php';
?>