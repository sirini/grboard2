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

	public function writeComment($reply, $target, $familyID, $isReply) {
		if ($this->common->getSessionKey() > 0) {
			$queWriterStr = str_replace(array('{0}', '{1}'), array('nickname, email, homepage, password', $this->common->getSessionKey()), $this->queArr['get_writer_info']);
			$queWriter = $this->db->query($queWriterStr);
			$writer = $this->db->fetch($queWriter);
			$this->db->free($queWriter);
			$reply['name'] = $writer['nickname'];
			$reply['email'] = $writer['email'];
			$reply['homepage'] = $writer['homepage'];
			$reply['password'] = $writer['password'];
			$reply['secret'] = 0;
		} else {			
			$reply['password'] = md5($reply['password']);
			if(isset($reply['secret'])) $reply['secret'] = (int)$reply['secret'];
			else $reply['secret'] = 0;
			if(!isset($reply['email'])) $reply['email'] = '';
			if(!isset($reply['homepage'])) $reply['homepage'] = '';	
			$reply['name'] = $this->escape(htmlspecialchars($reply['name']));
			$reply['email'] = $this->escape(htmlspecialchars($reply['email']));
			$reply['homepage'] = $this->escape(htmlspecialchars($reply['homepage']));
		}
		$valueStr = '\'\',' . ((int)$familyID) . ',' . ((int)$target) . ','.($reply['secret']).',' . ((int)$isReply) . ',';
		$valueStr .= '\'' . $reply['name'] . '\',';
		$valueStr .= '\'' . $reply['email'] . '\',';
		$valueStr .= '\'' . $reply['homepage'] . '\',';
		$valueStr .= '\'' . $_SERVER['REMOTE_ADDR'] . '\',';
		$valueStr .= '\'' . time() . '\',';
		$valueStr .= '\'' . $this->escape(htmlspecialchars($reply['content'])) . '\',';
		$valueStr .= '\'' . $reply['password'] . '\',';
		$valueStr .= '\'\'';
		$queStr = str_replace('{0}', $valueStr, $this->queArr['write_comment']);
		$result = $this->db->query($queStr);
		if( $result === true && !$isReply ) {
			$insertID = $this->db->getInsertID();
			$queUpStr = str_replace('{0}', $insertID, $this->queArr['update_family_id']);	
			$this->db->query($queUpStr);
		}
		$queIncStr = str_replace('{0}', $target, $this->queArr['update_comment_count']);
		$this->db->query($queIncStr);

		return $result;
	}

	public function writePost($post, $target=0) {
		if( !strlen($post['gr2subject']) || !strlen($post['gr2content']) ) {
			return false;
		}
		
		if(isset($post['isNotice'])) $isNotice = 1; else $isNotice = 0;
		if(isset($post['isVisible'])) $isVisible = 1; else $isVisible = 0;
		if(isset($post['isReplyable'])) $isReplyable = 1; else $isReplyable = 0;
		if(isset($post['isRSS'])) $isRSS = 1; else $isRSS = 0;
		if(isset($post['hashfiles'])) $isDndUploaded = 1; else $isDndUploaded = 0;
		if(isset($post['category'])) $cat = (int)$post['category']; else $cat = 0;
		
		$tempDir = '__gr2_dnd_temp__/';
		$originalDir = date('Y/m/d/');
		$oldDir = '/' . $post['grboard'] . '/data/blog/' . $tempDir;
		$moveDir = '/' . $post['grboard'] . '/data/blog/' . $originalDir;
		$renameDir = 'data/blog/' . $originalDir;

		$post['gr2subject'] = $this->escape($post['gr2subject']);
		$post['gr2content'] = $this->escape($post['gr2content']);
		$post['gr2content'] = str_replace(array($oldDir, '[bigquote]', $tempDir), 
			array($moveDir, '"', $originalDir), $post['gr2content']);
		$post['gr2content'] = str_replace(array('src="../data/blog/', 'src="../lib/tinymce/'), 
			array('src="../../data/blog/', 'src="../../lib/tinymce/'), $post['gr2content']);
		$post['gr2tag'] = $this->escape(strip_tags($post['gr2tag']));
		$postCond = 1;
		if($isNotice) $postCond = 2;
		if(!$isVisible) $postCond = 0;
	
		$queWriterStr = str_replace(array('{0}', '{1}'), array('id', $this->common->getSessionKey()), $this->queArr['get_writer_info']);
		$queWriter = $this->db->query($queWriterStr);
		$writer = $this->db->fetch($queWriter);
		$this->db->free($queWriter);

		if($target > 0) {
			$valueStr = 'category = '.$cat.', subject = \'' . $post['gr2subject'] . '\', content = \'' . $post['gr2content'] . '\', post_condition = ' . 
				$postCond . ', comment_condition = ' . $isReplyable . ', open_rss = ' . $isRSS . ', tag = \'' . $post['gr2tag'] . '\', make_html = 1';
			$quePostStr = str_replace(array('{0}', '{1}'), array($valueStr, $target), $this->queArr['modify_post']);
			$result = $this->db->query($quePostStr);
			$insertID = $target;	
		} else {
			$valueStr = '\'\','.$cat.',\'' . time() . '\',\'' . $post['gr2subject'] . '\',\'' . $post['gr2content'] . 
				'\',' . $postCond . ',' . $isReplyable . ',\'\',' . $isRSS . ',0,0,\'' . $post['gr2tag'] . '\',\'' . $writer['id'] . '\',1';
			$quePostStr = str_replace('{0}', $valueStr, $this->queArr['write_post']);
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
				$fileValueStr = '\'\',\'__gr2_dnd_blog__\',' . $insertID . ',' . $sessionKey . ',\'' . $real . '\',\'' . $hash . '\',' . time() . ',0';
				$queFileStr = str_replace('{0}', $fileValueStr, $this->queArr['file_update']);
				$this->db->query($queFileStr);
			}
		}

		return $insertID;
	}

	public function getBlogPost($target, $columns='*') {
		$queStr = str_replace(array('{0}', '{1}'), array($columns, (int)$target), $this->queArr['get_blog_post']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);	
		$result['subject'] = stripslashes($result['subject']);
		$result['content'] = stripslashes($result['content']);
		if ($result['post_condition'] == 2) $result['isNotice'] = 1; else $result['isNotice'] = 0;
		if ($result['make_html'] == 1) $result['isHTML'] = 1; else $result['isHTML'] = 0;
		if ($result['post_condition'] == 1) $result['isVisible'] = 1; else $result['isVisible'] = 0;
		if ($result['comment_condition'] == 1) $result['isReplyable'] = 1; else $result['isReplyable'] = 0;
		if ($result['open_rss'] == 1) $result['isRSS'] = 1; else $result['isRSS'] = 0;
		$this->db->free($que);
		return $result;
	}
	
	public function writeGuestbook($guestbook, $isReply, $isSecret) {
		if ($this->common->getSessionKey() == 1) {
			$queWriterStr = str_replace(array('{0}', '{1}'), array('nickname, email, homepage, password', $this->common->getSessionKey()), $this->queArr['get_writer_info']);
			$queWriter = $this->db->query($queWriterStr);
			$writer = $this->db->fetch($queWriter);
			$this->db->free($queWriter);
			$guestbook['name'] = $writer['nickname'];
			$guestbook['email'] = $writer['email'];
			$guestbook['homepage'] = $writer['homepage'];
			$guestbook['password'] = $writer['password'];
		} else {
			$guestbook['password'] = md5($guestbook['password']);
			if(!isset($guestbook['email'])) $guestbook['email'] = '';
			if(!isset($guestbook['homepage'])) $guestbook['homepage'] = '';
		}
		$valueStr = '\'\',';
		$valueStr .= '\'' . $this->escape(strip_tags($guestbook['name'])) . '\',';
		$valueStr .= '\'' . $guestbook['password'] . '\',';
		$valueStr .= '\'' . $this->escape(strip_tags($guestbook['homepage'])) . '\',';
		$valueStr .= '\'' . $this->escape(strip_tags($guestbook['content'])) . '\',';
		$valueStr .= '\'' . ((int)$isSecret) . '\',';
		$valueStr .= '\'' . ((int)$isReply) . '\',';
		$valueStr .= '\'' . time() . '\',';
		$valueStr .= '\'' . $this->escape(strip_tags($guestbook['email'])) . '\'';
		$queStr = str_replace('{0}', $valueStr, $this->queArr['write_guestbook']);
		$result = $this->db->query($queStr);
		return $result;
	}

	public function getBlogInfo($columns='*') {
		$queStr = str_replace('{0}', $columns, $this->queArr['get_blog_info']);
		$que = $this->db->query($queStr);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		$result['blog_title'] = stripslashes($result['blog_title']);
		$result['blog_info'] = stripslashes($result['blog_info']);
		return $result;
	}
	
	public function deletePost($target) {
		$queStr = str_replace('{0}', (int)$target, $this->queArr['delete_post']);
		$this->db->query($queStr);
	}
	
	public function getBlogCategory() {
		$que = $this->db->query($this->queArr['get_blog_category']);
		$result = array();
		while($f = $this->db->fetch($que)) {
			$result[] = $f;
		}
		$this->db->free($que);
		return $result;
	}
	
	public function getBlogNotice($count=5) {
	    $queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_notice']);
	    $que = $this->db->query($queStr);
	    $result = array();
	    while($notice = $this->db->fetch($que)) {
	        $result[$notice['uid']] = stripslashes($notice['subject']);
	    }
	    $this->db->free($que);
	    return $result;
	}
	
	public function getBlogGuestbook($count=5) {
	    $queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_guestbook']);
	    $que = $this->db->query($queStr);
	    $result = array();
	    while($notice = $this->db->fetch($que)) {
	        $result[$notice['uid']] = stripslashes($notice['content']);
	    }
	    $this->db->free($que);
	    return $result;
	}
	
	public function getBlogRecentReply($count=5) {
	    $queStr = str_replace('{0}', (int)$count, $this->queArr['get_blog_recent_reply']);
	    $que = $this->db->query($queStr);
	    $result = array();
	    while($re = $this->db->fetch($que)) {
	        $result[$re['uid']] = $re;
	    }
	    $this->db->free($que);
	    return $result;
	}
}
?>