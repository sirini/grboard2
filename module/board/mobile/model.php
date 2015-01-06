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

	public function getBoardPostCount($id, $findOption='', $findValue='') {
		if($findOption != '' && $findValue != '') {
			$queStr = str_replace(array('{0}', '{1}', '{2}', '{3}'), array($id, $findOption, $findValue, 1000), $this->queArr['get_board_post_count_find']);	
		} else {
			$queStr = str_replace('{0}', $id, $this->queArr['get_board_post_count']);
		}
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result['post_count'];
	}

	public function getBoardInfo($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}

	public function getBoardPost($id, $preset=0, $count=10, $findOption='', $findValue='') {
		$count = (int)$count;
		$queLastStr = str_replace('{0}', $id, $this->queArr['get_last_uid']);
		$queLast = $this->db->query($queLastStr);
		$queNoticeStr = str_replace('{0}', $id, $this->queArr['get_board_notice_count']);
		$queNotice = $this->db->query($queNoticeStr);
		$notice = $this->db->fetch($queNotice);
		$last = $this->db->fetch($queLast);
		$this->db->free($queLast);
		$this->db->free($queNotice);
		$selectColumns = 'no,member_key,name,signdate,hit,good,comment_count,is_secret,category,subject';
		$startRange = $last['no'] - ($count * 100);
		$limitTerm = $count - (int)$notice['notice_count'];
		
		if($findOption != '' && $findValue != '') {
			$queStr = str_replace(
				array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}'), 
				array($selectColumns, $id, $startRange, $last['no'], $findOption, $findValue, (int)$preset, $limitTerm), 
				$this->queArr['get_board_post_find']
			);
		} else {
			$queStr = str_replace(
				array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}'), 
				array($selectColumns, $id, $startRange, $last['no'], (int)$preset, $limitTerm), 
				$this->queArr['get_board_post']
			);			
		}

		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('no', 'member_key', 'name', 'signdate', 'hit', 'good', 'comment_count', 'is_secret', 'category', 'subject');
		if($que==true) {
			while($post = $this->db->fetch($que)) {
				foreach($colArr as &$col) {
					$result[$index][$col] = str_replace('&amp;', '&', stripslashes($post[$col]));
				}
				++$index;
			}
			$this->db->free($que);
		}	
		return $result;
	}

	public function getBoardNotice($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_notice']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$index = 0;
		$colArr = array('no', 'member_key', 'name', 'email', 'homepage', 'ip', 'signdate', 'hit', 'good', 'comment_count', 'is_notice', 'is_secret', 'category', 'subject', 'content', 'tag');
		if($que==true) {
			while($post = $this->db->fetch($que)) {
				foreach($colArr as &$col) {
					$result[$index][$col] = str_replace('&amp;', '&', stripslashes($post[$col]));
				}
				++$index;
			}
			$this->db->free($que);
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
}

?>