<?php
class Model {

	private $db;
	private $queArr;
	private $grboard;
	private $commentColArr;

	public function __construct($DB, $_query, $_grboard) {
		$this->db = $DB;
		$this->queArr = $_query;
		$this->grboard = $_grboard;
		$this->commentColArr = array('board_no','family_no','thread','member_key','is_grcode','name','password','email','homepage','ip',
									'signdate','good','bad','subject','content','is_secret','order_key');
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
		return $this->db->getData($queStr);
	}

	public function getCommentData($id, $target) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_comment_data']);
		$result = $this->db->getData($queStr);
		return $result;
	}
	
	public function getPostData($id, $target) {
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_post_data']);
		return $this->db->getData($queStr);
	}
		
	public function copyPost($srcID, $srcTarget, $destID) {
		$postUID = (int)$srcTarget;
		$srcPost = $this->getPostData($srcID, $srcTarget);
		$insertID = $this->insertPost($destID, $srcPost);
		$allComments = $this->getAllComment($srcID, $postUID);
		if(count($allComments[0]) > 0) {
			foreach($allComments as $comment) {
				$this->insertCommentData($destID, $insertID, $comment);
			}			
		}
		$this->insertFile($srcID, $srcTarget, $destID, $insertID);
	}
	
	public function getBoardList() {
		$que = $this->db->query($this->queArr['get_board_list']);
		$result = array();
		while($f = $this->db->fetch($que)) {
			$result[] = $f['id'];
		}
		return $result;
	}

	private function insertPost($id, $posts) {
		$colArr = array('member_key','name','password','email','homepage','ip','signdate','hit','good',
						'comment_count','is_notice','is_secret','category','subject','content','tag');
		$colSize = count($colArr);
		$queStr = str_replace('{0}', $id, $this->queArr['insert_post']);
		for($i=0; $i<$colSize; $i++) {
			$queStr = str_replace('{'.($i + 1).'}', $posts[$colArr[$i]], $queStr);
		}
		$this->db->query($queStr);
		return $this->db->getInsertID();
	}	
	
	private function insertCommentData($id, $insertID, $datas) {
		$colSize = count($this->commentColArr);
		$queStr = str_replace('{0}', $id, $this->queArr['insert_comment']);
		$datas['board_no'] = $insertID;
		for($i=0; $i<$colSize; $i++) {
			$queStr = str_replace('{'.($i + 1).'}', $datas[$this->commentColArr[$i]], $queStr);
		}
		$this->db->query($queStr);
		return $this->db->getInsertID();
	}
	
	private function getAllComment($id, $target) {
		$colSize = count($this->commentColArr);
		$queStr = str_replace(array('{0}', '{1}'), array($id, (int)$target), $this->queArr['get_all_comment']);
		$que = $this->db->query($queStr);
		$results = array(array());
		$i = 0;
		while($c = $this->db->fetch($que)) {
			foreach($this->commentColArr as &$col) {
				$results[$i][$col] = $c[$col];
			}
			$i++;
		}
		$this->db->free($que);
		return $results;
	}
	
	private function insertFile($srcID, $srcTarget, $destID, $destTarget) {
		$queFilesStr = str_replace(array('{0}', '{1}'), array($srcID, (int)$srcTarget), $this->queArr['get_file_store']);
		$queFiles = $this->db->query($queFilesStr);
		$moveToPath = 'data/board/' . $destID;
		$this->makeDirectoryByYmd($moveToPath);
		
		while($f = $this->db->fetch($queFiles)) {
			$oldYmd = $this->getYmdFromPath($f['real_name']);
			$newRealName = str_replace(
				array('/'.$srcID, '/'.$oldYmd[0], '/'.$oldYmd[1], '/'.$oldYmd[2]),
				array('/'.$destID, '/'.date('Y'), '/'.date('m'), '/'.date('d')),
				$f['real_name']);
			$newHashName = str_replace(
				array('/'.$srcID, '/'.$oldYmd[0], '/'.$oldYmd[1], '/'.$oldYmd[2]),
				array('/'.$destID, '/'.date('Y'), '/'.date('m'), '/'.date('d')), 
				$f['hash_name']);			
			$oldHashName = $f['hash_name'];
			
			$newHashName = substr($newHashName, 0, -32) . md5('GRBOARD2' . $f['uid'] . time());
			$f['board_id'] = $destID;
			$f['board_no'] = $destTarget; 
			$f['real_name'] = $newRealName;
			$f['hash_name'] = $newHashName;
			
			$this->copyFile('..' . $oldHashName, '..' . $newHashName, $f);
		}
	}

	private function copyFile($oldPath, $newPath, $sqlStrArr) {
		if(copy($oldPath, $newPath)) {
			$queStr = $this->queArr['insert_file_store'];
			$colArr = array('board_id','board_no','member_key','real_name','hash_name','signdate','hit');
			$colSize = count($colArr);
			for($i=0; $i<$colSize; $i++) {
				$queStr = str_replace('{'.$i.'}', $sqlStrArr[$colArr[$i]], $queStr);
			}
			$this->db->query($queStr);
		}
	}
	
	private function makeDirectoryByYmd($moveToPath) {
		if(!is_dir($moveToPath)) mkdir($moveToPath, 0707);
		$moveToPath .= '/' . date('Y');
		if(!is_dir($moveToPath)) mkdir($moveToPath, 0707);
		$moveToPath .= '/' . date('m');
		if(!is_dir($moveToPath)) mkdir($moveToPath, 0707);
		$moveToPath .= '/' . date('d');
		if(!is_dir($moveToPath)) mkdir($moveToPath, 0707);
	}
	
	private function getYmdFromPath($path) {
		$arr = explode('/', $path);
		$ret = array($arr[5], $arr[6], $arr[7]);
		return $ret;
	}
}
?>