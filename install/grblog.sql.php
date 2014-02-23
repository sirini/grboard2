<?php
$queBlogArr = array();
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'category`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'category` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT \'0\',
  `name` varchar(100) NOT NULL DEFAULT \'\',
  `depth` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`uid`),
  KEY `id` (`id`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'comment`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'comment` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `family_uid` int(11) NOT NULL DEFAULT \'0\',
  `post_uid` int(11) NOT NULL DEFAULT \'0\',
  `is_secret` tinyint(4) NOT NULL DEFAULT \'0\',
  `is_reply` tinyint(4) NOT NULL DEFAULT \'0\',
  `name` varchar(100) NOT NULL DEFAULT \'\',
  `email` varchar(255) NOT NULL DEFAULT \'\',
  `homepage` varchar(255) NOT NULL DEFAULT \'\',
  `ip` varchar(20) NOT NULL DEFAULT \'\',
  `signdate` int(10) NOT NULL DEFAULT \'0\',
  `content` text,
  `password` varchar(32) NOT NULL DEFAULT \'\',
  `writer` varchar(50) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`uid`),
  KEY `family_uid` (`family_uid`),
  KEY `post_uid` (`post_uid`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'config`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'config` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT \'\',
  `homepage` varchar(255) NOT NULL DEFAULT \'\',
  `email` varchar(255) NOT NULL DEFAULT \'\',
  `blog_title` varchar(255) NOT NULL DEFAULT \'\',
  `blog_info` varchar(255) NOT NULL DEFAULT \'\',
  `theme` varchar(255) NOT NULL DEFAULT \'\',
  `num_view_post` tinyint(4) NOT NULL DEFAULT \'5\',
  `num_rss_post` tinyint(4) NOT NULL DEFAULT \'10\',
  `use_comment` tinyint(4) NOT NULL DEFAULT \'0\',
  `use_rss` tinyint(4) NOT NULL DEFAULT \'0\',
  `num_rss_content` int(5) NOT NULL DEFAULT \'300\',
  `num_per_page` tinyint(4) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`uid`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'guestbook`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'guestbook` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT \'\',
  `password` char(32) NOT NULL DEFAULT \'\',
  `homepage` varchar(255) NOT NULL DEFAULT \'\',
  `content` text,
  `is_secret` tinyint(2) NOT NULL DEFAULT \'0\',
  `is_reply` int(11) NOT NULL DEFAULT \'0\',
  `signdate` int(11) NOT NULL DEFAULT \'0\',
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `is_reply` (`is_reply`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'image`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'image` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `file_route` varchar(255) NOT NULL DEFAULT \'\',
  `signdate` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`uid`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'link`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'link` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT \'\',
  `name` varchar(100) NOT NULL DEFAULT \'\',
  `info` varchar(255) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`uid`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'post`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'post` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(4) NOT NULL DEFAULT \'0\',
  `signdate` int(10) NOT NULL DEFAULT \'0\',
  `subject` varchar(255) NOT NULL DEFAULT \'\',
  `content` text,
  `post_condition` tinyint(4) NOT NULL DEFAULT \'0\',
  `comment_condition` tinyint(4) NOT NULL DEFAULT \'0\',
  `trackback` varchar(255) NOT NULL DEFAULT \'\',
  `open_rss` tinyint(4) NOT NULL DEFAULT \'0\',
  `comment_count` tinyint(4) NOT NULL DEFAULT \'0\',
  `trackback_count` int(11) NOT NULL DEFAULT \'0\',
  `tag` varchar(255) NOT NULL DEFAULT \'\',
  `writer` varchar(50) NOT NULL DEFAULT \'sirini\',
  `make_html` tinyint(1) NOT NULL DEFAULT \'1\',
  PRIMARY KEY (`uid`),
  KEY `category` (`category`),
  KEY `signdate` (`signdate`),
  KEY `open_rss` (`open_rss`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'rss`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'rss` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT \'\',
  `name` varchar(100) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`uid`),
  KEY `name` (`name`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_blog.'tag`';
$queBlogArr[] = 'CREATE TABLE `'.$db_prefix_blog.'tag` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL DEFAULT \'\',
  `count` int(7) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`uid`)
) DEFAULT CHARSET=utf8';
$queBlogArr[] = 'INSERT INTO `'.$db_prefix_blog.'config` (
  uid,name,homepage,email,blog_title,blog_info,theme,num_view_post,num_rss_post,use_comment,use_rss,num_rss_content,num_per_page) 
  VALUES (NULL,\'Admin\',\'\',\'\',\'GR Board 2 Blog\',\'Welcome my blog\',\'basic\',5,10,1,1,300,5)';
$queBlogArr[] = 'INSERT INTO  `test`.`gbl_post` (
  `uid`,`category`,`signdate`,`subject`,`content`,`post_condition`,`comment_condition`,`trackback`,`open_rss`,`comment_count`,
  `trackback_count`,`tag`,`writer`,`make_html`) VALUES (
  NULL, \'0\', '.time().', \'Welcome to the GR Board 2 Blog!\', \'Hi, this is sample content of blog.\', 0, 0, \'\', 0, 0, 0, \'\', \'GR Board 2\', 1)';
$queBlogArr[] = 'INSERT INTO `test`.`gbl_guestbook` (
  `uid`, `name`, `password`, `homepage`, `content`, `is_secret`, `is_reply`, `signdate`, `email`) VALUES (
  NULL, \'GR Board 2\', MD5(\'GR Board 2\'), \'http://sirini.net\', \'Welcome to the GR Board 2 Blog! This is a  sample post.\', 0, 0, '.time().', \'\');'
?>