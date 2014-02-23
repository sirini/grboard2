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
		$queStr = str_replace(array('{0}', '{1}'), array($id, $pw), $this->queArr['get_board_login']);
		$que = $this->db->query($queStr);
		if($que == false) return false;
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$uid = (int)$result['no'];
		if( $uid > 0 ) {
			$this->common->setSessionKey($uid);
			$queUpLastStr = str_replace('{0}', $uid, $this->queArr['update_last_login']);
			$queUpBlocks = str_replace('{0}', $uid, $this->queArr['update_blocks_zero']);
			$this->db->query($queUpLastStr);
			$this->db->query($queUpBlocks);
			return true;
		}
		return false;
	}

	public function getBoardInfo($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_info']);
		$que = $this->db->query($queStr);
		if($que == false) return false;
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
}

?>