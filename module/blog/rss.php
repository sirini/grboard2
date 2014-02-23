<?php
@header('Content-Type: text/xml; charset=utf-8');

if(!defined('GR_BOARD_2')) exit();

include 'rss/query.php';
include 'rss/model.php';
include 'rss/error.php';

$Model = new Model($DB, $query, $grboard);
$blogInfo = $Model->getBlogInfo();

if (!$blogInfo['use_rss']) $Common->error($error['msg_no_permission']);

$blogPost = $Model->getBlogPost($blogInfo['num_rss_post']);
$blogLastUpdate = $Model->getLastUpdateTime();
?>
<rss version="2.0">
	<channel>
		<title><?php echo $blogInfo['blog_title']; ?></title>
		<link>http://<?php echo $_SERVER['HTTP_HOST']; ?></link>
		<description><?php echo $blogInfo['blog_info']; ?></description>
		<language>ko</language>
		<pubDate><?php $blogLastUpdate; ?></pubDate>
		<generator>GR Board 2 (http://sirini.net/)</generator>
		
		<?php 
		foreach($blogPost as &$post): 
			$subject = htmlspecialchars(stripslashes($post['subject']));
			$link = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $grboard . '/blog/view/' . $post['uid'];
			$content = $Common->getSubStr(htmlspecialchars(stripslashes($post['content'])), $blogInfo['num_rss_content']);
			$category = $Model->getCategoryText($post['category']);
			$author = htmlspecialchars(strip_tags($blogInfo['name']));
			$date = date('r', $post['signdate']);
		?>
		<item>
			<title><?php echo $subject; ?></title>
			<link><?php echo $link; ?></link>
			<description><?php echo $content; ?></description>
			<category><?php echo $category; ?></category>
			<author><?php echo $author; ?></author>
			<guid><?php echo $link; ?></guid>
			<comments><?php echo $link; ?>#blogReply</comments>
			<pubDate><?php echo $date; ?></pubDate>
		</item>
		<?php endforeach; unset($Model, $blogInfo, $blogPost, $blogLastUpdate, $subject, $link, $content, $category, $author, $date); ?>

	</channel>
</rss>