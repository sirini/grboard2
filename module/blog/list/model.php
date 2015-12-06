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

	public function getBlogPost($common, $preset=0, $count=10, $page=1, $cat=0, $searchValue='') {
		$count = (int)$count;
		$queLast = $this->db->query($this->queArr['get_last_uid']);
		$last = $this->db->fetch($queLast);
		$this->db->free($queLast);
		$isAdmin = ($common->getSessionKey() == 1) ? true : false;
		if($cat) {
			$queStr = str_replace(array('{0}', '{1}', '{2}', '{3}'), 
				array($cat, (($isAdmin)?'':'and post_condition > 0'), 0, $count), 
				$this->queArr['get_blog_post_by_category']);	
		} elseif(strlen($searchValue) > 0) {
			$queStr = str_replace(array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}', '{6}'), 
				array(($last['uid'] - ($count * $page * 10)), $last['uid'], (($isAdmin)?'':'and post_condition > 0'), $searchValue, (int)$preset, $count, $cat), 
				$this->queArr['get_blog_post_by_search']);
		} else {
			$queStr = str_replace(array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}'), 
				array(($last['uid'] - ($count * $page * 10)), $last['uid'], (($isAdmin)?'':'and post_condition > 0'), (int)$preset, $count, $cat), 
				$this->queArr['get_blog_post']);
		}
		
		$result = array(array());
		$colArr = array('uid', 'category', 'signdate', 'subject', 'content', 'post_condition', 'comment_condition', 'trackback', 'open_rss', 'comment_count', 'trackback_count', 'tag', 'writer', 'make_html');
		$que = $this->db->query($queStr);
		if($que) {
			$index = 0;
			while($post = $this->db->fetch($que)) {
				foreach($colArr as &$col) {
					$result[$index][$col] = str_replace(array('&amp;', '="data/'), array('&', '="/' . $this->grboard . '/data/blog/'), stripslashes($post[$col]));
				}
				$index++;
			}
			$this->db->free($que);	
		} else {
			foreach($colArr as &$col) {
				$result[0][$col] = '';
			}
			$result[0]['subject'] = 'There are no post exist.';
			$result[0]['content'] = 'Click write button and start writing your first post.';
		}				
		return $result;
	}

	public function getBlogPostCount($cat=0, $searchValue='') {
		$queStr = $this->queArr['get_blog_post_count'];
		if($cat) $queStr = str_replace('{0}', $cat, $this->queArr['get_blog_post_count_by_category']);
		if(strlen($searchValue) > 0) $queStr = str_replace('{0}', $searchValue, $this->queArr['get_blog_post_count_by_search']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result['total_post'];
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

	public function getBlogView($uid=1) {
		$queStr = str_replace('{0}', (int)$uid, $this->queArr['get_blog_view']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$result['content'] = str_replace(array('&amp;', '="data/'), array('&', '="/' . $this->grboard . '/data/blog/'), stripslashes($result['content']));
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

	public function getBlogCategory() {
		$que = $this->db->query($this->queArr['get_blog_category']);
		$result = array();
		while($f = $this->db->fetch($que)) {
			$result[] = $f;
		}
		$this->db->free($que);
		return $result;
	}
}

?>