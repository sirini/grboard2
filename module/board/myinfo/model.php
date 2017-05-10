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
	
	public function updateMyInfo($post) {
		$passwd = '';
		if(strlen(trim($post['userPw'])) > 0) $passwd = 'password = \''.md5(trim($post['userPw'])).'\', ';
		$pw = md5($post['userPw']);
		$nick = htmlspecialchars($this->escape($post['userNick']));
		$real = htmlspecialchars($this->escape($post['userReal']));
		if(strlen($nick) < 1 || strlen($real) < 1) {
			return -1;
		}

		$email = htmlspecialchars($this->escape($post['userEmail']));
		$home = htmlspecialchars($this->escape($post['userHome']));
		$intro = htmlspecialchars($this->escape($post['userIntro']));
		
		$strUpdate = $passwd . 'nickname = \''.$nick.'\', realname = \''.$real.'\', email = \''.$email.
					'\', homepage = \''.$home.'\', self_info = \''.$intro.'\'';
		$que = str_replace(array('{0}', '{1}'), array($strUpdate, $this->common->getSessionKey()), $this->queArr['update_myinfo']);
		$this->db->query($que);		
		return true;
	}
	
	public function getMyInfo() {
		$sessionKey = $this->common->getSessionKey(); 
		if($sessionKey < 1) {
			return false;
		}
		$queStr = str_replace('{0}', $sessionKey, $this->queArr['get_myinfo']);
		$que = $this->db->query($queStr);
		$myinfo = $this->db->fetch($que);
		$this->db->free($que);
		
		$myinfo['nickname'] = stripslashes($myinfo['nickname']);
		$myinfo['realname'] = stripslashes($myinfo['realname']);
		$myinfo['self_info'] = str_replace('<br />', "\n", stripslashes($myinfo['self_info']));
		return $myinfo;
	}
}
?>