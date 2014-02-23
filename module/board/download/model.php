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
	
	public function getFileStore($fid) {
		$queStr = str_replace('{0}', $fid, $this->queArr['get_file_store']);
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
	
	public function updateHit($fid) {
		$queStr = str_replace('{0}', $fid, $this->queArr['update_hit']);
		$this->db->query($queStr);
	}
}

?>