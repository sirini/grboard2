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

	public function getUserInfo($key=0) {
		$key = (int)$key;
		if($key == 0) {
			$result = array(array());
			$result['level'] = 1;
			$result['point'] = 0;
			return $result;
		}
		$queStr = str_replace('{0}', $key, $this->queArr['get_user_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}

	public function getBoardInfo($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}

	public function getPost($id, $no) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$no), $this->queArr['get_post']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		foreach($result as &$column) {
			$column = stripslashes($column);
		}
		return $result;
	}

	public function getBoardCategory($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_category']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		if($result['category'] == '') {
			return;
		} else {
			$catArr = explode('|', $result['category']);
			$this->db->free($que);
			return $catArr;
		}
	}

	public function getReplyList($id, $no) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, $no), $this->queArr['get_reply_list']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('no', 'family_no', 'thread', 'member_key', 'is_grcode', 'name', 'password', 'email', 'homepage', 'ip', 'signdate', 'good', 'subject', 'content', 'is_secret');
		while($post = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = str_replace('&amp;', '&', stripslashes($post[$col]));
			}
			$index++;
		}
		$this->db->free($que);
		return $result;
	}
	
	public function getFileList($id, $no) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$no), $this->queArr['get_file_list']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		while($f = $this->db->fetch($que)) {
			$fArr = explode('/', $f['real_name']);
			$fname = $fArr[ count($fArr) - 1 ];
			$result[$index]['uid'] = $f['uid'];
			$result[$index]['real_name'] = $fname;
			$index++;
		}
		$this->db->free($que);
		if($index == 0) $result = false;
		return $result;
	}
	
	public function updateHit($id, $no) {
		if(!isset($_SESSION['UPDATE2HIT'][$id][$no])) {
			$_SESSION['UPDATE2HIT'][$id][$no] = true;
			$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$no), $this->queArr['update_hit']);
			$this->db->query($queStr);			
		}
	}
}

?>