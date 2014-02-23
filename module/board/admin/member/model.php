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
	
	public function getOldData($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_old_data']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getMemberGroup($uid) {
		$queStr = str_replace('{0}', $uid, $this->queArr['get_member_group']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getMemberGroupList() {
		$que = $this->db->query($this->queArr['get_member_group_list']);
		$result = array(array());
		$colArr = array('no', 'name', 'make_time');
		$index = 0;
		while($f = $this->db->fetch($que)) {
			foreach($colArr as &$col) {
				$result[$index][$col] = stripslashes($f[$col]);
			}
			$result[$index]['members'] = $this->getMemberCountGroup($f['no']);
			++$index;
		}
		$this->db->free($que);
		return $result;
	}
	
	public function saveMemberConfig($post) {
		$mode = $post['memberFormSubmitType'];
		$memberId = str_replace(
			array(' ','`','~','!','@','#','$','%','^','&','*','(',')','-','+','\\','|',',','.','<','>','/','?','\'','"','{','}','[',']'), 
			'', strtolower(trim($post['id'])));
		if(strlen($memberId) < 1 || strlen($post['nickname']) < 1 || strlen($post['realname']) < 1) return -1;
		$memberUid = (int)$post['memberUid'];
		$password = md5($post['password']);
		$post['nickname'] = addslashes(htmlspecialchars($post['nickname']));
		$post['realname'] = addslashes(htmlspecialchars($post['realname']));
		$post['self_info'] = addslashes(htmlspecialchars($post['self_info']));
		$post['level'] = (int)$post['level'];
		$post['point'] = (int)$post['point'];
		$post['group_no'] = (int)$post['group_no'];
		if($mode == 'add') {
			if(strlen($post['password']) < 1) return -1;
			$queIsExistStr = str_replace('{0}', $memberId, $this->queArr['is_member_exist']);
			$queIsExist = $this->db->query($queIsExistStr);
			$fetchIsExist = $this->db->fetch($queIsExist);
			$this->db->free($queIsExist);
			if($fetchIsExist['no'] > 0) {
				return false;
			}
			$strInsert = 'NULL,\''.$memberId.'\',\''.$password.'\',\''.$post['nickname'].'\',\''.$post['realname'].'\',\''.$post['email'].'\','.
				'\''.$post['homepage'].'\',\''.time().'\',\''.$post['level'].'\',\''.$post['point'].'\',\''.$post['self_info'].'\','.
				'\''.$post['photo'].'\',\''.$post['nametag'].'\',\''.$post['group_no'].'\',\''.$post['icon'].'\',\''.time().'\',\''.$post['blocks'].'\'';   
			$queInsert = str_replace('{0}', $strInsert, $this->queArr['add_new_member']);
			$this->db->query($queInsert);
			$memberUid = (int)$this->db->getInsertID();
		} else {
			$memberUid = $post['memberUid'];
			$passStr = '';
			if(strlen($post['password']) > 0) $passStr = 'password=\''.md5($post['password']).'\',';  
			$strModify = $passStr . 'nickname=\''.$post['nickname'].'\',realname=\''.$post['realname'].'\',email=\''.$post['email'].'\','.
				'homepage=\''.$post['homepage'].'\',level=\''.$post['level'].'\',point=\''.$post['point'].'\',self_info=\''.$post['self_info'].'\','.
				'photo=\''.$post['photo'].'\',nametag=\''.$post['nametag'].'\',group_no=\''.$post['group_no'].'\',icon=\''.$post['icon'].'\','.
				'blocks=\''.$post['blocks'].'\'';
			$queModify = str_replace(array('{0}', '{1}'), array($strModify, (int)$post['memberUid']), $this->queArr['update_exist_member']);
			$this->db->query($queModify);	
		}
		return $memberUid;
	}

	public function getMemberList($page, $pageNum=10, $pagePerList=30) {
		$page = (int)$page;
		$pageNum = (int)$pageNum;
		$pagePerList = (int)$pagePerList;
		$startRecord = ($page - 1) * $pagePerList;
		$queListStr = str_replace(array('{0}', '{1}'), array($startRecord, $pagePerList), $this->queArr['get_member_list']);
		$queList = $this->db->query($queListStr);
		$result = array(array());
		$colArr = array('groupname','no','id','nickname','realname','make_time','level','point','lastlogin','blocks');
		if($queList == true) {
			$index = 0;
			while($f = $this->db->fetch($queList)) {
				foreach($colArr as &$col) {
					$result[$index][$col] = $f[$col];
				}
				++$index;
			}
			$this->db->free($queList);			
		}
		if(!isset($result[0]['no'])) {
			$result[0] = array('groupname'=>'Empty','no'=>0,'id'=>'system','nickname'=>'Not found','realname'=>'Wrong page or empty set.',
				'make_time'=>time(), 'level'=>99,'point'=>0,'lastlogin'=>time(),'blocks'=>0);
		}
		return $result;		
	}
	
	public function getTotalMemberCount() {
		$queCount = $this->db->query($this->queArr['get_member_total_count']);
		$fetCount = $this->db->fetch($queCount);
		$this->db->free($queCount);
		return $fetCount['cnt'];
	}

	public function getMemberCountGroup($gid) {
		$queCountStr = str_replace('{0}', (int)$gid, $this->queArr['get_member_count_group']);
		$queCount = $this->db->query($queCountStr);
		$fetCount = $this->db->fetch($queCount);
		$this->db->free($queCount);
		return $fetCount['cnt'];
	}

	public function deleteMember($uid, $id) {
		if($uid == 1) return false;
		$queDelStr = str_replace('{0}', $uid, $this->queArr['delete_member']);
		$this->db->query($queDelStr);
	}

	public function saveGroupConfig($post) {
		$gid = (int)$post['groupId'];
		$post['name'] = addslashes(trim($post['name']));
		$queStr = '';
		if($gid > 0) {
			$updateQue = 'name = \''.$post['name'].'\'';
			$queStr = str_replace(array('{0}', '{1}'), array($updateQue, $gid), $this->queArr['save_group_modify']);
		} else {
			$insertQue = 'NULL,\''.$post['name'].'\',\''.time().'\'';
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