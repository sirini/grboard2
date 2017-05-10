<?php
class Model {

	private $db;
	private $queArr;
	private $grboard;
	private $common;

	public function __construct($DB, $_query, $_grboard, $_common) {
		$this->db = $DB;
		$this->queArr = $_query;
		$this->grboard = $_grboard;
		$this->common = $_common;
	}

	public function escape($str) {
		$result = addcslashes(addslashes($str), '%_');
		return $result;
	}

	public function login($id, $pw) {
		$id = $this->escape($id);
		$pw = md5($pw);
		$queStr = str_replace(array('{0}', '{1}'), array($id, $pw), $this->queArr['get_blog_login']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$uid = (int)$result['no'];
		if( $uid > 0 ) {
			$this->common->setSessionKey($uid);
			return true;
		}
		return false;
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
}

?>