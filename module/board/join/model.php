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
	
	public function joinUs($post) {
		$id = htmlspecialchars($this->escape($post['userId']));
		$pw = md5($post['userPw']);
		$nick = htmlspecialchars($this->escape($post['userNick']));
		$real = htmlspecialchars($this->escape($post['userReal']));
		if(strlen($id) < 1 || strlen($post['userPw']) < 1 || strlen($nick) < 1 || strlen($real) < 1) {
			return -1;
		}

		$queIdCheckStr = str_replace('{0}', $id, $this->queArr['get_exist_id']);
		$queIdCheck = $this->db->query($queIdCheckStr);
		$idCheck = $this->db->fetch($queIdCheck);
		$this->db->free($queIdCheck);
		if($idCheck['no']) return false;

		$email = htmlspecialchars($this->escape($post['userEmail']));
		$home = htmlspecialchars($this->escape($post['userHome']));
		$intro = htmlspecialchars($this->escape($post['userIntro']));
		
		$post['photo'] = '';
		$post['nametag'] = '';
		$post['icon'] = '';
		
		$queFirstGroup = $this->db->query($this->queArr['get_first_group']);
		$firstGroup = $this->db->fetch($queFirstGroup);
		$this->db->free($queFirstGroup);
		
		$strInsert = 'NULL,\''.$id.'\',\''.$pw.'\',\''.$nick.'\',\''.$real.'\',\''.$email.'\','.
			'\''.$home.'\',\''.time().'\',\'2\',\'0\',\''.$intro.'\',\''.$post['photo'].'\',\''.$post['nametag'].
			'\',\''.$firstGroup['no'].'\',\''.$post['icon'].'\',\''.time().'\',\'0\'';   
		$queInsert = str_replace('{0}', $strInsert, $this->queArr['add_new_member']);
		$this->db->query($queInsert);
		
		return true;
	}
}
?>