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

	public function deleteComment($id, $target) {
		$postUID = $this->getPostUid($id, $target);
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['delete_comment']);
		$que = $this->db->query($queStr);
		$queUpStr = str_replace(array('{0}', '{1}'), array($id, (int)$postUID), $this->queArr['update_comment_count']);
		$queUp = $this->db->query($queUpStr);
		return $que;
	}
	
	public function deletePost($id, $target) {
		$postUID = (int)$target;
		$queFilesStr = str_replace(array('{0}', '{1}'), array($id, $postUID), $this->queArr['get_file_store']);
		$queFiles = $this->db->query($queFilesStr);
		while($f = $this->db->fetch($queFiles)) {
			if(!unlink('..' . $f['hash_name'])) {
				continue;
			}
		}
		$queDelFilesStr = str_replace(array('{0}', '{1}'), array($id, $postUID), $this->queArr['delete_file_store']);
		$this->db->query($queDelFilesStr);
		$queDelCommentStr = str_replace(array('{0}', '{1}'), array($id, $postUID), $this->queArr['delete_comment_list']);
		$this->db->query($queDelCommentStr);
		$queDelPostStr = str_replace(array('{0}', '{1}'), array($id, $postUID), $this->queArr['delete_post']);
		$this->db->query($queDelPostStr);
		
		$this->db->free($queFiles);
		return true;
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
	
	public function getPostData($id, $target) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_post_data']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getPostUid($id, $target) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_post_uid']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		return $result['board_no'];
	}
}

?>