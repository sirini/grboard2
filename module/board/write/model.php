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
		$result = addslashes($str);
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
		
		if($this->common->getSessionKey() != 1) {
			require 'lib/htmlpurifier/HTMLPurifier.auto.php';
			$puri = new HTMLPurifier();
			$result['subject'] = $puri->purify($result['subject']);
			$result['content'] = $puri->purify($result['content']);	
		} else {
			$result['subject'] = stripslashes($result['subject']);
			$result['content'] = stripslashes($result['content']);
		}
			
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
	
	private function makeDirectoryByYmd($id) {
		if(!is_dir('data/board/'.$id)) mkdir('data/board/'.$id, 0707);
		if(!is_dir('data/board/'.$id.date('/Y'))) mkdir('data/board/'.$id.date('/Y'), 0707);
		if(!is_dir('data/board/'.$id.date('/Y/m'))) mkdir('data/board/'.$id.date('/Y/m'), 0707);
		if(!is_dir('data/board/'.$id.date('/Y/m/d'))) mkdir('data/board/'.$id.date('/Y/m/d'), 0707);
	}
	
	private function prepareModifyPost($id, $target, &$post, &$oldData, $sessionKey) {
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
		return $oldData;
	}

	private function getWriterInfo($sessionKey) {
		if($sessionKey < 1) return array();
		$queWriterStr = str_replace(array('{0}', '{1}'), array('nickname, email, homepage, password', $sessionKey), 
		$this->queArr['get_writer_info']);
		$writer = $this->db->getData($queWriterStr);
		return $writer;
	}

	private function prepareNewPost($id, $target, $sessionKey, &$post, &$writer) {
		if ($sessionKey > 0) {
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
	
	private function isCorrectPassword($target, $sessionKey, &$post, &$oldData) {
		if($target > 0 && $sessionKey != 1) {		
			if(strlen(trim($post['gr2password'])) > 0 && ($post['gr2password'] != $oldData['password'])) {
				return false;
			}
		}
		return true;
	}
	
	private function makeValidParameters(&$post, $sessionKey, $oldDir, $tempDir, $moveDir, $originalDir) {
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
			$post['gr2subject'] = $puri->purify($post['gr2subject']);
			$post['gr2content'] = $puri->purify($post['gr2content']);			
		} else {
			$post['gr2subject'] = $this->escape($post['gr2subject']);
			$post['gr2content'] = $this->escape($post['gr2content']);	
		}
		if(isset($post['gr2category'])) $post['gr2category'] = $this->escape($post['gr2category']);
		$post['gr2tag'] = $this->escape(strip_tags($post['gr2tag']));
	}

	private function writingModifiedPost($id, &$post, $isNotice, $isSecret, $target) {
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
			'\', is_notice = \'' . $isNotice . '\', is_secret = \'' . $isSecret . '\', category = \'' . $post['gr2category'] . 
			'\', subject = \'' . $post['gr2subject'] . '\', content = \'' . $post['gr2content'] . '\', tag = \'' . $post['gr2tag'] . '\'';
		$quePostStr = str_replace(array('{0}', '{1}', '{2}'), array($id, $valueStr, $target), $this->queArr['modify_post']);
		$result = $this->db->query($quePostStr);		
		return $target;
	}

	private function writingNewPost($id, &$post, $isNotice, $isSecret, $sessionKey) {
		$valueStr = '\'\',' . $sessionKey . ',\'' . $post['gr2name'] . '\',\'' . $post['gr2password'] . '\',\'' . 
		$post['gr2email'] . '\',\'' . $post['gr2homepage'] . '\',\'' . $_SERVER['REMOTE_ADDR'] . '\',' . time() . 
			',0,0,0,' . $isNotice . ',' . $isSecret . ', \'' . $post['gr2category'] . '\',\''  . $post['gr2subject'] . 
			'\',\'' . $post['gr2content'] . '\',\'' . $post['gr2tag'] . '\'';
		$quePostStr = str_replace(array('{0}', '{1}'), array($id, $valueStr), $this->queArr['write_post']);
		$result = $this->db->query($quePostStr);
		return $this->db->getInsertID();		
	}
	
	private function uploadDroppedFiles($id, $insertID, $sessionKey, &$post, $oldDir, $renameDir, $moveDir) {
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
	
	private function uploadFiles($id, $insertID, $sessionKey, &$post, &$files, $moveDir) {
		foreach($files['gr2files']['error'] as $key => $error) {
			if($files['gr2files']['size'][$key] > $this->getMaxUploadSize()) {
				return -1;
			}
			if($error == UPLOAD_ERR_OK) {
				$tmpName = $files['gr2files']['tmp_name'][$key];
				$name = str_replace(' ', '_', $files['gr2files']['name'][$key]);
				$real = $moveDir . $name;
				$hash = md5($name . time());
				if(move_uploaded_file($tmpName, 'data/board/' . $id . date('/Y/m/d/') . $hash)) {
					$hash = $moveDir . $hash;
					$fileValueStr = '\'\',\'' . $id . '\',' . $insertID . ',' . $sessionKey . ',\'' . $real . '\',\'' . $hash . '\',' . time() . ',0';
					$queFileStr = str_replace('{0}', $fileValueStr, $this->queArr['file_update']);
					$this->db->query($queFileStr);	
				}
			}
		}		
	}
	
	public function writePost($id, $post, $files, $target) {
		if( !strlen(trim($post['gr2subject'])) || !strlen(trim($post['gr2content']))) return false;
		if($post['writingInMobile'] == 'yes') $post['gr2content'] = nl2br($post['gr2content']);

		$this->makeDirectoryByYmd($id);
		$sessionKey = $this->common->getSessionKey();
		$oldData = $this->getOldData($id, $target);
		$writer = $this->getWriterInfo($sessionKey);

		if($target > 0) $this->prepareModifyPost($id, $target, $post, $oldData, $sessionKey);
		else $this->prepareNewPost($id, $target, $sessionKey, $post, $writer);

		if(!$this->isCorrectPassword($target, $sessionKey, $post, $oldData)) return false;	
		if( $sessionKey == 1 && isset($post['isNotice']) ) $isNotice = 1; else $isNotice = 0;
		if( isset($post['isSecret']) ) $isSecret = 1; else $isSecret = 0;
		if( isset($post['isReplyable']) ) $isReplyable = 1; else $isReplyable = 0;
		if( isset($post['hashfiles']) ) $isDndUploaded = 1; else $isDndUploaded = 0;
		if(strlen($files['gr2files']['name'][0]) > 0) $isAttachedFiles = 1; else $isAttachedFiles = 0;

		$tempDir = '__gr2_dnd_temp__/';
		$originalDir = $id . date('/Y/m/d/');
		$oldDir = '/' . $post['grboard'] . '/data/board/' . $tempDir;
		$moveDir = '/' . $post['grboard'] . '/data/board/' . $originalDir;
		$renameDir = 'data/board/' . $originalDir;

		$this->makeValidParameters($post, $sessionKey, $oldDir, $tempDir, $moveDir, $originalDir);

		if($target > 0) $insertID = $this->writingModifiedPost($id, $post, $isNotice, $isSecret, $target);
		else $insertID = $this->writingNewPost($id, $post, $isNotice, $isSecret, $sessionKey);

		if($isDndUploaded) $this->uploadDroppedFiles($id, $insertID, $sessionKey, $post, $oldDir, $renameDir, $moveDir);				
		if($isAttachedFiles) $this->uploadFiles($id, $insertID, $sessionKey, $post, $files, $moveDir);

		return $insertID;
	}

	public function getCategoryList($id) {
		$queStr = str_replace('{0}', $id, $this->queArr['get_category_list']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$categoryStr = trim($result['category']);
		if(strlen($categoryStr) > 0) {
			$catArr = explode('|', $categoryStr);
			return $catArr;	
		} else {
			return false;			
		}
	}
	
	public function getBytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		$num = (int)substr($val, 0, -1);
		
		switch($last) {
			case 'g': $num *= 1024;
			case 'm': $num *= 1024;
			case 'k': $num *= 1024;
		}
		return $num;
	}
	
	public function getMaxUploadSize() {
		$maxUpload = $this->getBytes(ini_get('upload_max_filesize'));
		$maxPost = $this->getBytes(ini_get('post_max_size'));
		$memoryLimit = $this->getBytes(ini_get('memory_limit'));
		return min($maxUpload, $maxPost, $memoryLimit);
	}
}
?>