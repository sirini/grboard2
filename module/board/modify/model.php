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

	public function getBoardInfo($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}

	public function getCommentData($id, $target) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_comment_data']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
}

?>