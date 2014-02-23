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
	
	public function saveBlogConfig($post) {
		if(!strlen($post['name']) || !strlen($post['blog_title']) || !strlen($post['blog_info']) ||
			$post['num_view_post'] < 1 || $post['num_per_page'] < 1 || $post['num_rss_post'] < 1) {
				return -1;
		}
			
		$name = stripslashes($post['name']);
		$homepage = strip_tags(trim($post['homepage']));
		$email = strip_tags(trim($post['email']));
		$title = stripslashes($post['blog_title']);
		$info = stripslashes($post['blog_info']);
		$numViewPost = (int)$post['num_view_post'];
		$numPerPage = (int)$post['num_per_page'];
		$numRssPost = (int)$post['num_rss_post'];
		$numRssContent = (int)$post['num_rss_content'];
		
		$update = 'name=\''.$name.'\',homepage=\''.$homepage.'\',email=\''.$email.'\',blog_title=\''.$title.'\',blog_info=\''.$info.'\',' .
			'theme=\''.$post['theme'].'\',num_view_post='.$numViewPost.',num_rss_post='.$numRssPost.',use_comment='.$post['use_comment'].',' .
			'use_rss='.$post['use_rss'].',num_rss_content='.$numRssContent.',num_per_page='.$numPerPage;
		
		$queStr = str_replace('{0}', $update, $this->queArr['update_blog_config']);
		$this->db->query($queStr); 
		
		return true;
	}
	
	public function getBlogConfig() {
		$que = $this->db->query($this->queArr['get_blog_info']);
		$result = $this->db->fetch($que);
		$this->db->free($que);
		return $result;
	}
}
?>