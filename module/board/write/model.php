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
		$result = addcslashes(addslashes($str), '%');
		return $result;
	}

	public function getBoardInfo($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_board_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}

	public function getUserInfo($key=0) {
		$key = (int)$key;
		if($key == 0) {
			return array('level'=>1, 'point'=>0);
		}
		$queStr = str_replace('{0}', $key, $this->queArr['get_user_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getOldData($id, $uid) {
		$uid = (int)$uid;
		if($uid == 0) {
			return array('is_notice'=>0, 'is_secret'=>0, 'subject'=>'', 'content'=>'', 'tag'=>''); 
		}
		$queStr = str_replace(array('{0}', '{1}'), array($id, $uid), $this->queArr['get_old_data']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
	
	public function getOldFileList($id, $uid) {
		$uid = (int)$uid;
		if($uid == 0) {
			return array('fid'=>0, 'real_name'=>'');
		}
		$queStr = str_replace(array('{0}', '{1}'), array($id, $uid), $this->queArr['get_old_file_list']);
		$que = $this->db->query($queStr);
		$result = array(array());
		$loop = 0;
		while($f = $this->db->fetch($que)) {
			$result[$loop]['fid'] = $f['fid'];
			$result[$loop]['real_name'] = $f['real_name'];
			++$loop;
		}
		$this->db->free($que);
		return $result;
	}
	
	public function writePost($id, $post, $target) {
		if( !strlen(trim($post['gr2subject'])) || !strlen(trim($post['gr2content'])) ) {
			return false;
		}
		
		$sessionKey = $this->common->getSessionKey();
		if($target > 0) {
			$oldData = $this->getOldData($id, $target);
			if ($sessionKey > 0) {
				$post['gr2name'] = $oldData['name'];
				$post['gr2email'] = $oldData['email'];
				$post['gr2homepage'] = $oldData['homepage'];
				$post['gr2password'] = $oldData['password'];
			} else {
				if(strlen(trim($post['gr2name'])) == 0) return false;
				if(strlen(trim($post['gr2password'])) == 0) return false;
				$post['gr2password'] = md5($post['gr2password']);
			}
		} else {
			if ($sessionKey > 0) {
				$queWriterStr = str_replace(array('{0}', '{1}'), array('nickname, email, homepage, password', $sessionKey), 
					$this->queArr['get_writer_info']);
				$queWriter = $this->db->query($queWriterStr);
				$writer = $this->db->fetch($queWriter);
				$this->db->free($queWriter);
				$post['gr2name'] = $writer['nickname'];
				$post['gr2email'] = $writer['email'];
				$post['gr2homepage'] = $writer['homepage'];
				$post['gr2password'] = $writer['password'];
			} else {
				if(strlen(trim($post['gr2name'])) == 0) return false;
				if(strlen(trim($post['gr2password'])) == 0) return false;
				$post['gr2password'] = md5($post['gr2password']);
			}
		}
		
		if($target > 0 && $sessionKey != 1) {		
			if(strlen(trim($post['gr2password'])) > 0 && ($post['gr2password'] != $oldData['password'])) {
				return false;
			}
		}
	
		if( $sessionKey == 1 && array_key_exists('isNotice', $post) ) $isNotice = 1; else $isNotice = 0;
		if( array_key_exists('isSecret', $post) ) $isSecret = 1; else $isSecret = 0;
		if( array_key_exists('isReplyable', $post) ) $isReplyable = 1; else $isReplyable = 0;
		if( array_key_exists('hashfiles', $post) ) $isDndUploaded = 1; else $isDndUploaded = 0;

		$tempDir = '__gr2_dnd_temp__/';
		$originalDir = $id . date('/Y/m/d/');
		$oldDir = '/' . $post['grboard'] . '/data/board/' . $tempDir;
		$moveDir = '/' . $post['grboard'] . '/data/board/' . $originalDir;
		$renameDir = 'data/board/' . $originalDir;

		$post['gr2name'] = $this->escape(htmlspecialchars($post['gr2name']));
		$post['gr2email'] = $this->escape(htmlspecialchars($post['gr2email']));
		$post['gr2homepage'] = $this->escape(htmlspecialchars($post['gr2homepage']));
		$post['gr2content'] = str_replace(array($oldDir, '[bigquote]', $tempDir), 
			array($moveDir, '"', $originalDir), $post['gr2content']);
		$post['gr2content'] = str_replace(array('src="../data/board/', 'src="../lib/tinymce/'), 
			array('src="../../data/board/', 'src="../../lib/tinymce/'), $post['gr2content']);
	
		if($sessionKey != 1) {
			require 'lib/htmlpurifier/HTMLPurifier.auto.php';
			$puri = new HTMLPurifier();
			$post['gr2subject'] = htmlspecialchars($post['gr2subject']);
			$post['gr2content'] = $puri->purify($post['gr2content']);
		}
		$post['gr2subject'] = $this->escape($post['gr2subject']);
		$post['gr2content'] = $this->escape($post['gr2content']);
		$post['gr2tag'] = $this->escape(strip_tags($post['gr2tag']));

		$queWriterStr = str_replace(array('{0}', '{1}'), array('id', $sessionKey), $this->queArr['get_writer_info']);
		$queWriter = $this->db->query($queWriterStr);
		$writer = $this->db->fetch($queWriter);
		$this->db->free($queWriter);

		if($target > 0) {
			if(array_key_exists('deleteFileList', $post)) {
				foreach($post['deleteFileList'] as &$fid) {
					$queDelFilePath = str_replace('{0}', $fid, $this->queArr['get_delete_file_path']);
					$queDelFile = $this->db->query($queDelFilePath);
					$fetDelFile = $this->db->fetch($queDelFile);
					$delPath = str_replace('/' . $post['grboard'] . '/', '', $fetDelFile['hash_name']);
					if(file_exists($delPath)) unlink($delPath);
					$queDelFileDB = str_replace('{0}', $fid, $this->queArr['delete_file']);
					$this->db->query($queDelFileDB);
					$this->db->free($queDelFile);
				}
			}				
			$valueStr = 'name = \'' . $post['gr2name'] . '\', email = \''.$post['gr2email'].'\', homepage = \'' . $post['gr2homepage'] . 
				'\', is_notice = \'' . $isNotice . '\', is_secret = \'' . $isSecret . '\', subject = \'' . $post['gr2subject'] . 
				'\', content = \'' . $post['gr2content'] . '\', tag = \'' . $post['gr2tag'] . '\'';
			$quePostStr = str_replace(array('{0}', '{1}', '{2}'), array($id, $valueStr, $target), $this->queArr['modify_post']);
			$result = $this->db->query($quePostStr);
			$insertID = $target;
		} else {
			$valueStr = '\'\',' . $sessionKey . ',\'' . $post['gr2name'] . '\',\'' . $post['gr2password'] . '\',\'' . 
				$post['gr2email'] . '\',\'' . $post['gr2homepage'] . '\',\'' . $_SERVER['REMOTE_ADDR'] . '\',' . time() . 
				',0,0,0,' . $isNotice . ',' . $isSecret . ',\'\',\'' . $post['gr2subject'] . '\',\'' . $post['gr2content'] . 
				'\',\'' . $post['gr2tag'] . '\'';
			$quePostStr = str_replace(array('{0}', '{1}'), array($id, $valueStr), $this->queArr['write_post']);
			$result = $this->db->query($quePostStr);
			$insertID = $this->db->getInsertID();						
		}
		
		if($isDndUploaded) {
			$fileCount = count($post['hashfiles']);						
			for($i=0; $i<$fileCount; $i++) {
				rename(str_replace('/' . $post['grboard'] . '/', '', $post['hashfiles'][$i]), 
					str_replace($oldDir, $renameDir, $post['hashfiles'][$i]));
				$real = str_replace($oldDir, $moveDir, $post['realfiles'][$i]);
				$hash = str_replace($oldDir, $moveDir, $post['hashfiles'][$i]);
				$fileValueStr = '\'\',\'' . $id . '\',' . $insertID . ',' . $sessionKey . ',\'' . $real . '\',\'' . $hash . '\',' . time() . ',0';
				$queFileStr = str_replace('{0}', $fileValueStr, $this->queArr['file_update']);
				$this->db->query($queFileStr);
			}
		}

		return $insertID;
	}
}
?>