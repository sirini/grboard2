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

	public function getBlogPost($count=10) {
		$queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_post']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('uid', 'category', 'signdate', 'subject', 'content', 'post_condition', 'comment_condition', 'trackback', 'open_rss', 'comment_count', 'trackback_count', 'tag', 'writer', 'make_html');
		while($post = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = str_replace(array('&amp;', '="data/'), array('&', '="/' . $this->grboard . '/data/blog/'), stripslashes($post[$col]));
			}
			$index++;
		}
		$this->db->free($que);
		return $result;
	}

	public function getLastUpdateTime() {
		$que = $this->db->query($this->queArr['get_last_update_time']);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$d = date('r', $result['signdate']);
		return $d;
	}

	public function getCategoryText($catID) {
		$queStr = str_replace('{0}', (int)$catID, $this->queArr['get_category_text']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$name = stripslashes($result['name']);
		return $name;
	}
}

?>