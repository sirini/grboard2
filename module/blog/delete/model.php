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

	public function deleteComment($target) {
		$postUID = $this->getPostUid($target);
		$queStr = str_replace('{0}', (int)$target, $this->queArr['delete_comment']);
		$que = $this->db->query($queStr);

		$queUpStr = str_replace('{0}', (int)$postUID, $this->queArr['update_comment_count']);
		$queUp = $this->db->query($queUpStr);

		return $que;
	}

	public function getPostUid($target) {
		$queGetStr = str_replace('{0}', (int)$target, $this->queArr['get_post_uid']);
		$queGet = $this->db->query($queGetStr);
		$result = $this->db->fetch($queGet);
		$this->db->free($queGet);
		return $result['post_uid'];
	}
}

?>