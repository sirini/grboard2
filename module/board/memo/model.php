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
		$result = addcslashes(addslashes(trim($str)), '%_');
		return $result;
	}
	
	public function getData($param, $replacer, $queIndex) {
		$queStr = str_replace($param, $replacer, $this->queArr[$queIndex]);
		$que = $this->db->query($queStr);
		$result = false;
		if($que == true) {
			$result = $this->db->fetch($que);
			$this->db->free($que);
		}
		return $result;
	}
	
	public function sendMemo($userKey, $post) {
		$target = $this->getData('{0}', $post['userId'], 'get_target_uid');
		if(!isset($target['no'])) return -1;
		
		$message = $this->escape(strip_tags($post['userMsg']));
		$values = 'NULL,' . $userKey . ',' . $target['no']. ',\'' . $message . '\',' . time() . ',0';
		$queWriteStr = str_replace('{0}', $values, $this->queArr['write_memo']);
		$this->db->query($queWriteStr);
		return true;
	}
	
	public function getMemoList($userKey, $page, $pageNum) {
		$startPage = ($page - 1) * $pageNum;
		$queListStr = str_replace(array('{0}', '{1}', '{2}'), array((int)$userKey, $startPage, (int)$pageNum), $this->queArr['get_memo_list']);
		$queList = $this->db->query($queListStr);
		$result = array(array());
		$index = 0;
		if($queList == true) {
			while($f = $this->db->fetch($queList)) {
				$from = $this->getData('{0}', $f['from_uid'], 'get_from_nick');
				$result[$index]['no'] = $f['no'];
				$result[$index]['from'] = stripslashes($from['nickname']);
				$result[$index]['memo'] = stripslashes($f['memo']);
				$result[$index]['signdate'] = $f['signdate'];
				$result[$index]['status'] = ($f['status'] == 0) ? '-' : 'read';
				$result[$index]['no'] = $f['no'];
				++$index;
			}
			$this->db->free($queList);
		}
		return $result;
	}
	
	public function getTotalMessage($userKey) {
		$result = $this->getData('{0}', (int)$userKey, 'get_total_message');
		return $result['cnt'];
	}
	
	public function getTargetInfo($target) {
		$result = $this->getData('{0}', (int)$target, 'get_target_info');
		$from = $this->getData('{0}', $result['from_uid'], 'get_from_id');
		$result['id'] = $from['id'];
		$result['memo'] = stripslashes($result['memo']);
		return $result;
	}
}
?>