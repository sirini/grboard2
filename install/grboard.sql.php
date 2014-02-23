<?php
$queBoardArr = array();
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'bbs_test`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'bbs_test` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `member_key` int(11) NOT NULL DEFAULT \'0\',
  `name` varchar(20) NOT NULL DEFAULT \'\',
  `password` varchar(50) NOT NULL DEFAULT \'\',
  `email` varchar(255) DEFAULT \'\',
  `homepage` varchar(255) DEFAULT \'\',
  `ip` varchar(20) NOT NULL DEFAULT \'\',
  `signdate` int(11) NOT NULL DEFAULT \'0\',
  `hit` int(11) NOT NULL DEFAULT \'0\',
  `good` int(11) NOT NULL DEFAULT \'0\',
  `comment_count` int(11) NOT NULL DEFAULT \'0\',
  `is_notice` tinyint(4) DEFAULT \'0\',
  `is_secret` tinyint(4) DEFAULT \'0\',
  `category` varchar(50) DEFAULT \'\',
  `subject` varchar(255) NOT NULL DEFAULT \'\',
  `content` text,
  `tag` varchar(255) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`no`),
  KEY `member_key` (`member_key`),
  KEY `hit` (`hit`),
  KEY `signdate` (`signdate`),
  KEY `good` (`good`),
  KEY `is_notice` (`is_notice`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'comment_test`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'comment_test` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `board_no` int(11) NOT NULL DEFAULT \'0\',
  `family_no` int(11) NOT NULL DEFAULT \'0\',
  `thread` tinyint(4) NOT NULL DEFAULT \'0\',
  `member_key` int(11) NOT NULL DEFAULT \'0\',
  `is_grcode` tinyint(4) NOT NULL DEFAULT \'0\',
  `name` varchar(20) NOT NULL DEFAULT \'\',
  `password` varchar(50) NOT NULL DEFAULT \'\',
  `email` varchar(255) DEFAULT \'\',
  `homepage` varchar(255) DEFAULT \'\',
  `ip` varchar(20) NOT NULL DEFAULT \'\',
  `signdate` int(11) NOT NULL DEFAULT \'0\',
  `good` int(11) NOT NULL DEFAULT \'0\',
  `bad` int(11) NOT NULL DEFAULT \'0\',
  `subject` varchar(255) NOT NULL DEFAULT \'\',
  `content` text,
  `is_secret` tinyint(4) NOT NULL DEFAULT \'0\',
  `order_key` varchar(50) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`no`),
  KEY `board_no` (`board_no`),
  KEY `family_no` (`family_no`),
  KEY `thread` (`thread`),
  KEY `member_key` (`member_key`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'board_list`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'board_list` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL DEFAULT \'\',
  `head_file` varchar(255) NOT NULL DEFAULT \'\',
  `foot_file` varchar(255) NOT NULL DEFAULT \'\',
  `head_form` text,
  `foot_form` text,
  `category` varchar(255) DEFAULT NULL,
  `make_time` int(11) NOT NULL DEFAULT \'0\',
  `page_num` tinyint(4) NOT NULL DEFAULT \'10\',
  `page_per_list` tinyint(4) NOT NULL DEFAULT \'10\',
  `enter_level` tinyint(4) NOT NULL DEFAULT \'1\',
  `master` varchar(255) NOT NULL DEFAULT \'\',
  `theme` varchar(100) NOT NULL DEFAULT \'\',
  `comment_page_num` tinyint(4) NOT NULL DEFAULT \'50\',
  `comment_page_per_list` tinyint(4) NOT NULL DEFAULT \'5\',
  `num_file` tinyint(4) DEFAULT \'0\',
  `view_level` tinyint(4) NOT NULL DEFAULT \'0\',
  `write_level` tinyint(4) NOT NULL DEFAULT \'0\',
  `comment_write_level` tinyint(4) NOT NULL DEFAULT \'0\',
  `cut_subject` tinyint(4) NOT NULL DEFAULT \'0\',
  `group_no` tinyint(2) NOT NULL DEFAULT \'1\',
  `comment_sort` tinyint(1) NOT NULL DEFAULT \'1\',
  `name` varchar(100) NOT NULL DEFAULT \'\',
  `down_level` tinyint(4) NOT NULL DEFAULT \'0\',
  `down_point` tinyint(4) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`no`),
  KEY `id` (`id`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'file_store`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'file_store` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` varchar(255) NOT NULL,
  `board_no` int(11) NOT NULL,
  `member_key` int(11) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `hash_name` varchar(255) NOT NULL,
  `signdate` int(11) NOT NULL,
  `hit` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `hash_name` (`hash_name`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'group_list`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'group_list` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT \'Normal\',
  `master` varchar(200) NOT NULL DEFAULT \'\',
  `make_time` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`no`),
  KEY `name` (`name`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'member_group`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'member_group` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT \'\',
  `make_time` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`no`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'DROP TABLE IF EXISTS `'.$db_prefix_board.'member_list`';
$queBoardArr[] = 'CREATE TABLE `'.$db_prefix_board.'member_list` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL DEFAULT \'\',
  `password` varchar(50) NOT NULL DEFAULT \'\',
  `nickname` varchar(20) NOT NULL DEFAULT \'\',
  `realname` varchar(15) NOT NULL DEFAULT \'\',
  `email` varchar(255) NOT NULL DEFAULT \'\',
  `homepage` varchar(255) NOT NULL DEFAULT \'\',
  `make_time` int(11) NOT NULL DEFAULT \'0\',
  `level` tinyint(4) NOT NULL DEFAULT \'1\',
  `point` int(11) NOT NULL DEFAULT \'0\',
  `self_info` varchar(255) NOT NULL DEFAULT \'\',
  `photo` varchar(255) NOT NULL DEFAULT \'\',
  `nametag` varchar(255) NOT NULL DEFAULT \'\',
  `group_no` tinyint(2) NOT NULL DEFAULT \'1\',
  `icon` varchar(255) NOT NULL DEFAULT \'\',
  `lastlogin` int(11) NOT NULL DEFAULT \'0\',
  `blocks` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`no`),
  KEY `id` (`id`)
) DEFAULT CHARSET=utf8';
$queBoardArr[] = 'INSERT INTO `'.$db_prefix_board.'board_list` (
	`no`,`id`,`head_file`,`foot_file`,`head_form`,`foot_form`,`category`,`make_time`,`page_num`,`page_per_list`,`enter_level`,
	`master`,`theme`,`comment_page_num`,`comment_page_per_list`,`num_file`,`view_level`,`write_level`,`comment_write_level`,
	`cut_subject`,`group_no`,`comment_sort`,`name`,`down_level`,`down_point` ) VALUES (
	NULL , \'test\', \'\', \'\', \'<!doctype html><head><meta charset="utf-8" /><title>GR Board 2 Board Page</title>
	<link rel="stylesheet" type="text/css" href="/'.$grboard.'/module/board/skin/[grboard2skinname]/style.css" />
	<script src="/'.$grboard.'/lib/jquery.js"></script>
	<script src="/'.$grboard.'/module/board/skin/[grboard2skinname]/[grboard2action].skin.js"></script>
	</head><body style="text-align: center"><div style="width: 650px; margin: auto">\', \'</div></body></html>\', 
	NULL , '.time().', \'20\', \'10\', \'1\', \'\', \'basic\', \'50\', \'5\', \'10\', \'1\', \'1\', \'1\', \'0\', 
	\'1\', \'1\', \'Test board\', \'0\', \'0\')';
$queBoardArr[] = 'INSERT INTO `'.$db_prefix_board.'member_list` (`no`, `id`, `password`, `nickname`, `realname`, `email`, 
	`homepage`, `make_time`, `level`, `point`, `self_info`, `photo`, `nametag`, `group_no`, `icon`, `lastlogin`, `blocks`
	) VALUES (NULL, \''.$admin_id.'\', MD5(\''.$admin_pw.'\'), \'Admin\', \'Administrator\', \'\', \'\', '.time().', 99,
	 0, \'\', \'\', \'\', 1, \'\', 0, 0)';
$queBoardArr[] = 'INSERT INTO `'.$db_prefix_board.'group_list` (`no`, `name`, `master`, `make_time`) VALUES (NULL, \'Normal\', \'\', '.time().')';
$queBoardArr[] = 'INSERT INTO `'.$db_prefix_board.'member_group` (`no`, `name`, `make_time`) VALUES (NULL, \'Regular\', '.time().')';
?>