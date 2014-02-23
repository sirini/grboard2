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
	
	public function writeComment($id, $reply, $target, $familyID, $isSecret=0) {
		$sessionKey = $this->common->getSessionKey();
		if ($sessionKey > 0) {
			$queWriterStr = str_replace(array('{0}', '{1}'), array('nickname, email, homepage, password', $sessionKey), 
				$this->queArr['get_writer_info']);
			$queWriter = $this->db->query($queWriterStr);
			$writer = $this->db->fetch($queWriter);
			$this->db->free($queWriter);
			$reply['name'] = $writer['nickname'];
			$reply['email'] = $writer['email'];
			$reply['homepage'] = $writer['homepage'];
			$reply['password'] = $writer['password'];
		} else {
			$reply['password'] = md5($reply['password']);
		}
		$thread = 0;
		if($familyID > 0) {
			$queStr = str_replace(array('{0}', '{1}'), array($id, $familyID), $this->queArr['get_parent_thread']);
			$que = $this->db->query($queStr);
			$result = $this->db->fetch($que);
			$this->db->free($que);
			$thread = $result['thread'] + 1;
			$familyID = $result['family_no'];
		}
		
		$reply['content'] = $this->escape($reply['content']);
		if($sessionKey != 1) {
			$reply['content'] = htmlspecialchars($reply['content']);
		}
		$reply['content'] = str_replace(array("\r\n", "\r", "\n"), '<br />', $reply['content']);
		$valueStr = '\'\',' . ((int)$target) . ',' . ((int)$familyID) . ',' . $thread . ',' . $sessionKey . ',0,';
		$valueStr .= '\'' . htmlspecialchars($this->escape($reply['name'])) . '\',';
		$valueStr .= '\'' . $reply['password'] . '\',';
		$valueStr .= '\'' . htmlspecialchars($this->escape($reply['email'])) . '\',';
		$valueStr .= '\'' . htmlspecialchars($this->escape($reply['homepage'])) . '\',';
		$valueStr .= '\'' . $_SERVER['REMOTE_ADDR'] . '\',';
		$valueStr .= '\'' . time() . '\',0,0,\'\',';
		$valueStr .= '\'' . $reply['content'] . '\',';
		$valueStr .= '\'' . ((int)$isSecret) . '\',';
		$valueStr .= '\'A\'';
		$queStr = str_replace(array('{0}', '{1}'), array($id, $valueStr), $this->queArr['write_comment']);
		$result = $this->db->query($queStr);
		if( $result === true && !$familyID ) {
			$insertID = $this->db->getInsertID();
			$queUpStr = str_replace(array('{0}', '{1}'), array($id, $insertID), $this->queArr['update_family_id']);	
			$this->db->query($queUpStr);
		}
		$queIncStr = str_replace(array('{0}', '{1}'), array($id, $target), $this->queArr['update_comment_count']);
		$this->db->query($queIncStr);
		return $result;
	}
}
?>