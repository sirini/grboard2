<?php
if(!defined('GR_BOARD_2')) exit();

include 'list/query.php';
include 'list/model.php';
include 'util/common/paging.php';

$Model = new Model($DB, $query, $grboard);
$blogInfo = $Model->getBlogInfo();
$blogPost = $Model->getBlogView($ext_articleNo);
$blogReply = $Model->getBlogReply($ext_articleNo);
$skinResourcePath = '/' . $grboard . '/module/' . $ext_module . '/skin/' . $blogInfo['theme'];
$skinPath = 'module/blog/skin/' . $blogInfo['theme'];
$blogLink = $Model->getBlogLink();
$simplelock = substr(md5($blogPost['uid'] . 'GR_BOARD_2' . date('YmdH')), -4);

function enableSyntaxHighlighter(&$text) {
	$text = preg_replace('/\[co'.'de=([a-zA-Z]+)\]/i', '<script type="syntax'.'highlighter" class="brush: $1"><![CD'.'ATA[', $text);
	$text = str_replace('[/co'.'de]', ']]></s'.'cript>', $text);
	$text = preg_replace_callback('/<\!\[CDATA\[(.*)\]\]>/i', 
		create_function('$matches', 'return str_replace(\'<br />\', "\n", $matches[0]);'), $text);
}

include 'skin/' . $blogInfo['theme'] . '/index.php';

unset($Model, $blogInfo, $blogPost, $skinResourcePath, $skinPath, $blogLink, $query);
?>