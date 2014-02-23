<?php
$query = array(
	'write_comment' => 'insert into ' . $db_prefix_blog . 'comment (uid, family_uid, post_uid, is_secret, is_reply, name, email, homepage, ip, signdate, content, password, writer) values ({0})' ,
	'update_family_id' => 'update ' . $db_prefix_blog . 'comment set family_uid = {0} where uid = {0} limit 1' ,
	'update_comment_count' => 'update ' . $db_prefix_blog . 'post set comment_count = comment_count + 1 where uid = {0} limit 1' ,
	'get_blog_info' => 'select {0} from ' . $db_prefix_blog . 'config order by uid asc limit 1' ,
	'get_writer_info' => 'select {0} from ' . $db_prefix_board . 'member_list where no = {1} limit 1' ,
	'write_post' => 'insert into ' . $db_prefix_blog . 'post (uid, category, signdate, subject, content, post_condition, comment_condition, trackback, open_rss, comment_count, trackback_count, tag, writer, make_html) values ({0})' ,
	'modify_post' => 'update ' . $db_prefix_blog . 'post set {0} where uid = {1} limit 1' ,
	'write_guestbook' => 'insert into ' . $db_prefix_blog . 'guestbook (uid, name, password, homepage, content, is_secret, is_reply, signdate, email) values ({0})' ,
	'get_blog_post' => 'select {0} from ' . $db_prefix_blog . 'post where uid = {1} limit 1' ,
	'file_update' => 'insert into ' . $db_prefix_board . 'file_store (uid,board_id,board_no,member_key,real_name,hash_name,signdate,hit) values ({0})'
);
?>