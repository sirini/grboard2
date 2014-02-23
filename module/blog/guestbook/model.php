<?php
class Model {

	private $db;
	private $queArr;
	private $grboard;

	public function __construct($DB, $_query, $_grboard) {
		$this->db = $DB;
		$this->queArr = $_query;
		$this->grboard = $_grboard;
	}

	public function getBlogInfo($columns='*') {
		$queStr = str_replace('{0}', $columns, $this->queArr['get_blog_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$result['blog_title'] = stripslashes($result['blog_title']);
		$result['blog_info'] = stripslashes($result['blog_info']);
		return $result;
	}
	
	public function getGuestbookList($preset=0, $count=10) {
		$count = (int)$count;
		$queLast = $this->db->query($this->queArr['get_last_uid']);
		$last = $this->db->fetch($queLast);
		$this->db->free($queLast);
		$queStr = str_replace(
			array('{0}', '{1}', '{2}', '{3}'), 
			array(($last['uid'] - ($count * 10)), $last['uid'], (int)$preset, $count), 
			$this->queArr['get_guestbook_list']
		);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('uid', 'name', 'homepage', 'content', 'is_secret', 'is_reply', 'signdate', 'email');
		while($post = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = str_replace(array('&amp;', '="data/'), array('&', '="/' . $this->grboard . '/data/blog/'), stripslashes($post[$col]));
			}
			$index++;
		}
		$this->db->free($que);
		return $result;
	}

	public function getGuestbookReplyList($target=1, $count=10) {
		$queStr = str_replace(array('{0}', '{1}'), array((int)$target, (int)$count), $this->queArr['get_guestbook_reply_list']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('uid', 'name', 'homepage', 'content', 'is_secret', 'signdate', 'email');
		while($post = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = str_replace(array('&amp;', '="data/'), array('&', '="/' . $this->grboard . '/data/blog/'), stripslashes($post[$col]));
			}
			$index++;
		}
		$this->db->free($que);
		return $result;
	}

	public function getGuestbookCount() {
		$que = $this->db->query($this->queArr['get_guestbook_count']);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result['total_guestbook'];
	}

	public function getBlogNotice($count=5) {
		$queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_notice']);
		$que = $this->db->query($queStr);
		$result = array();
		while($notice = $this->db->fetch($que)) {
			$result[$notice['uid']] = stripslashes($notice['subject']);
		}
		$this->db->free($que);
		return $result;
	}

	public function getBlogGuestbook($count=5) {
		$queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_guestbook']);
		$que = $this->db->query($queStr);
		$result = array();
		while($notice = $this->db->fetch($que)) {
			$result[$notice['uid']] = stripslashes($notice['content']);
		}
		$this->db->free($que);
		return $result;
	}

	public function getBlogRecentReply($count=5) {
		$queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_recent_reply']);
		$que = $this->db->query($queStr);
		$result = array();
		while($re = $this->db->fetch($que)) {
			$result[$re['uid']] = $re;
		}
		$this->db->free($que);
		return $result;
	}

	public function getBlogLink() {
		$que = $this->db->query($this->queArr['get_blog_link']);
		$result = array();
		while($notice = $this->db->fetch($que)) {
			$result[$notice['url']] = stripslashes($notice['name']);
		}
		$this->db->free($que);
		return $result;
	}

	public function getBlogReply($uid=1) {
		$queStr = str_replace('{0}', (int)$uid, $this->queArr['get_blog_reply']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('uid', 'family_uid', 'post_uid', 'is_secret', 'is_reply', 'name', 'email', 'homepage', 'ip', 'signdate', 'content', 'password', 'writer');
		while($post = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = str_replace('&amp;', '&', stripslashes($post[$col]));
			}
			$index++;
		}
		$this->db->free($que);
		return $result;
	}
}

?>