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

// update .htaccess
if(file_exists('../.htaccess')) {
	chmod('../.htaccess', 0707);
	unlink('../.htaccess');
}
$grboardArr = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$grboard = $grboardArr[count($grboardArr)-2];
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

// create common.config.php file if not exist
$cfgFile = '<?php'."\n".
	'// Please refer this url: https://www.google.com/recaptcha/ for get your own key.'."\n".
	'$gr2cfg[\'googleRecaptchaApiUrl\'] = \'https://www.google.com/recaptcha/api.js\';'."\n".
	'$gr2cfg[\'googleRecaptchaSiteKey\'] = \'\';  // Please update this key for your own'."\n".
	'$gr2cfg[\'googleRecaptchaSecretKey\'] = \'\';  // Please update this key for your own (Be sure keep it a secret)'."\n".
	'$gr2cfg[\'googleRecaptchaRequestUrl\'] = \'https://www.google.com/recaptcha/api/siteverify\';'."\n".
	'?>';
file_put_contents('../common.config.php', $cfgFile);
?>