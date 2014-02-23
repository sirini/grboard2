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
	
	private function getRowById($uid, $column) {
		$queStr = str_replace('{0}', (int)$uid, $this->queArr[$column]);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getBoardInfo($uid) { return $this->getRowById($uid, 'get_board_info'); }
	public function getBoardGroup($uid) { return $this->getRowById($uid, 'get_board_group'); }
	public function getOldData($uid) { return $this->getRowById($uid, 'get_old_data'); }
	
	public function getBoardGroupList() {
		$que = $this->db->query($this->queArr['get_board_group_list']);
		$result = array(array());
		$colArr = array('no', 'name', 'master', 'make_time');
		$index = 0;
		while($f = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = stripslashes($f[$col]);
			}
			$result[$index]['boards'] = $this->getBoardCountGroup($f['no']);
			++$index;
		}
		$this->db->free($que);
		return $result;
	}
		
	public function saveBoardConfig($post) {
		$mode = $post['boardFormSubmitType'];
		$boardId = str_replace(
			array(' ','`','~','!','@','#','$','%','^','&','*','(',')','-','+','\\','|',',','.','<','>','/','?','\'','"','{','}','[',']'), 
			'', strtolower(trim($post['id'])));
		$makeIntegerArr = array('page_num','page_per_list','enter_level','comment_page_num','comment_page_per_list','num_file',
			'view_level','write_level','comment_write_level','cut_subject','group_no','comment_sort','down_level');
		foreach($makeIntegerArr as &$col) {
			$post[$col] = (int)$post[$col];
		}
		if(strlen($boardId) < 1) return -1;
		if($mode == 'add') {
			$queIsExistStr = str_replace('{0}', $boardId, $this->queArr['is_board_exist']);
			$queIsExist = $this->db->query($queIsExistStr);
			$fetchIsExist = $this->db->fetch($queIsExist);
			$this->db->free($queIsExist);
			if($fetchIsExist['no'] > 0) {
				return false;
			}
			$strInsert = 'NULL,\''.$boardId.'\',\''.$post['head_file'].'\',\''.$post['foot_file'].'\',\''.$post['head_form'].'\',\''.
				$post['foot_form'].'\',\''.$post['category'].'\',\''.time().'\',\''.$post['page_num'].'\',\''.
				$post['page_per_list'].'\',\''.$post['enter_level'].'\',\''.$post['master'].'\',\''.$post['theme'].'\',\''.
				$post['comment_page_num'].'\',\''.$post['comment_page_per_list'].'\',\''.$post['num_file'].'\',\''.
				$post['view_level'].'\',\''.$post['write_level'].'\',\''.$post['comment_write_level'].'\',\''.$post['cut_subject'].'\',\''.
				$post['group_no'].'\',\''.$post['comment_sort'].'\',\''.$post['name'].'\',\''.$post['down_level'].'\',\''.
				$post['down_point'].'\'';   
			$queInsert = str_replace('{0}', $strInsert, $this->queArr['insert_new_board']);
			$this->db->query($queInsert);
			$queCreateBbs = str_replace('{0}', $boardId, $this->queArr['create_new_board']);
			$this->db->query($queCreateBbs);
			$queCreateComment = str_replace('{0}', $boardId, $this->queArr['create_new_comment']);
			$this->db->query($queCreateComment);
		} else {
			$boardId = $post['boardId'];
			$strModify = 'head_file=\''.$post['head_file'].'\',foot_file=\''.$post['foot_file'].'\',head_form=\''.$post['head_form'].'\','.
				'foot_form=\''.$post['foot_form'].'\',category=\''.$post['category'].'\',page_num=\''.$post['page_num'].'\','.
				'page_per_list=\''.$post['page_per_list'].'\',enter_level=\''.$post['enter_level'].'\','.
				'master=\''.$post['master'].'\',theme=\''.$post['theme'].'\',comment_page_num=\''.$post['comment_page_num'].'\','.
				'comment_page_per_list=\''.$post['comment_page_per_list'].'\',num_file=\''.$post['num_file'].'\','.
				'view_level=\''.$post['view_level'].'\',write_level=\''.$post['write_level'].'\','.
				'comment_write_level=\''.$post['comment_write_level'].'\',cut_subject=\''.$post['cut_subject'].'\','.
				'group_no=\''.$post['group_no'].'\',comment_sort=\''.$post['comment_sort'].'\',name=\''.$post['name'].'\','.
				'down_level=\''.$post['down_level'].'\',down_point=\''.$post['down_point'].'\'';
			$queModify = str_replace(array('{0}', '{1}'), array($strModify, (int)$post['boardUid']), $this->queArr['modify_exist_board']);
			$this->db->query($queModify);	
		}
		return $boardId;
	}

	public function getBoardList($page, $pageNum=10, $pagePerList=30) {
		$page = (int)$page;
		$pageNum = (int)$pageNum;
		$pagePerList = (int)$pagePerList;
		$startRecord = ($page - 1) * $pagePerList;
		$queListStr = str_replace(array('{0}', '{1}'), array($startRecord, $pagePerList), $this->queArr['get_board_list']);
		$queList = $this->db->query($queListStr);
		$result = array(array());
		$colArr = array('groupname', 'no', 'id', 'name', 'skin', 'master', 'make_time');
		if($queList == true) {
			$index = 0;
			while($f = $this->db->fetch($queList)) {
				foreach($colArr as &$col) {
					$result[$index][$col] = stripslashes($f[$col]);
				}
				$index++;
			}
			$this->db->free($queList);
		}
		if(!isset($result[0]['no'])) {
			$result[0] = array('groupname'=>'Empty','id'=>'system','name'=>'Wrong page or empty set.','skin'=>'Not found',
				'master'=>'','make_time'=>time());
		}
		return $result;
	}

	public function getTotalBoardCount() {
		$queCount = $this->db->query($this->queArr['get_board_total_count']);
		$fetCount = $this->db->fetch($queCount);
		$this->db->free($queCount);
		return $fetCount['cnt'];		
	}
	
	public function getBoardCountGroup($gid) {
		$queCountStr = str_replace('{0}', (int)$gid, $this->queArr['get_board_count_group']);
		$queCount = $this->db->query($queCountStr);
		$fetCount = $this->db->fetch($queCount);
		$this->db->free($queCount);
		return $fetCount['cnt'];
	}
	
	public function deleteFile($dir) {
		if(!is_dir($dir)) return;
		$dirs = @dir($dir);
		while(false !== ($entry = @$dirs->read())) {
			if($entry == '.' || $entry == '..') continue;
			$path = $dir . '/' . $entry;
			if(is_dir($path)) $this->deleteFile($path);
			else @unlink($path);
		}
		$dirs->close();
		@rmdir($dir);
	}
	
	public function deleteBoard($uid, $id) {
		$queListStr = str_replace('{0}', $uid, $this->queArr['delete_board_list']);
		$queTableStr = str_replace('{0}', $uid, $this->queArr['delete_board_table']);
		$queCommentStr = str_replace('{0}', $uid, $this->queArr['delete_board_comment']);
		$queFileStr = str_replace('{0}', $uid, $this->queArr['delete_board_file']);
		$this->db->query($queListStr);
		$this->db->query($queTableStr);
		$this->db->query($queCommentStr);
		$this->db->query($queFileStr);
		$this->deleteFile('data/board/' . $id);
	}
	
	public function saveGroupConfig($post) {
		$gid = (int)$post['groupId'];
		$post['name'] = addslashes(trim($post['name']));
		$post['master'] = strtolower(trim($post['master']));
		$queStr = '';
		if($gid > 0) {
			$updateQue = 'name = \''.$post['name'].'\', master = \''.$post['master'].'\'';
			$queStr = str_replace(array('{0}', '{1}'), array($updateQue, $gid), $this->queArr['save_group_modify']);
		} else {
			$insertQue = 'NULL,\''.$post['name'].'\',\''.$post['master'].'\',\''.time().'\'';
			$queStr = str_replace('{0}', $insertQue, $this->queArr['save_group_add']);
		}
		$this->db->query($queStr);
	}

	public function deleteGroup($gid) {
		$gid = (int)$gid;
		$queStr = str_replace('{0}', $gid, $this->queArr['delete_group']);
		$queUpdateStr = str_replace('{0}', $gid, $this->queArr['set_default_group']);
		$this->db->query($queStr);
		$this->db->query($queUpdateStr);
	}
}

?>