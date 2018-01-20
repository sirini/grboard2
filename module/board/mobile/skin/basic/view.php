<?php 
if(!defined('GR_BOARD_2')) exit(); 
include 'util/common/image.resize.php';
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">
	
	<div class="card">
    	<h4 class="card-header">
			<?php if(strlen($boardPost['category']) > 0): ?>
			<span class="text-primary">[<?php echo $boardPost['category']; ?>]</span>
			<?php endif; echo $boardPost['subject']; ?>
		</h4>	
		<div class="card-body">
    		<ul class="list-group list-group-flush">
    		<?php 
    		if($fileList != false): 
    			foreach($fileList as &$file): 
    				if(isImageFile($file['real_name'])):
    					$resized = gr2ResizeImage('..' . $file['real_name'], '..' . $file['hash_name'], 620, 500);
    					$resized = str_replace('../', '/', $resized); 
    		?>
    			<li class="list-group-item">
    				<img src="<?php echo $resized; ?>" alt="<?php echo $file['file_name']; ?>" class="img-responsive img-rounded center-block" />
    			</li>
    			<?php
    				endif; 
    			endforeach; unset($file);
    		endif; 
    		
    		if($fileList != false): 
    			foreach($fileList as &$file): ?>
    				<li class="list-group-item">
    					<a href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/download/<?php echo $file['uid']; ?>" class="btn btn-info btn-sm">
    					<?php echo $file['file_name']; ?></a></li>
    			<?php endforeach; unset($file); ?>
    		</ul>
    		<?php endif; ?>
    		
    		<div class="card-text"><?php echo $boardPost['content']; ?></div>
    		
    		<blockquote class="blockquote mb-0">
    			<footer class="blockquote-footer">
    			<?php if($boardPost['homepage']): ?>
    				<a class="card-link" href="<?php echo $boardPost['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">
    				site
    				</a>
    			<?php endif; echo $boardPost['name']; ?>, 
    			<?php echo date('m.d H:i', $boardPost['signdate']); ?>, 
    			hit (<?php echo $boardPost['hit']; ?>),
    			good (<?php echo $boardPost['good']; ?>),
    			#<?php echo $boardPost['tag']; ?>
				</footer>
    		</blockquote>
        		
    	</div>
	</div>
	
	<div style="height: 1.0rem"></div>
	
	<?php 
	if(isset($replyList[0]['no'])): 
		include 'view.comment.list.php'; 
	endif; 
	
	if($userInfo['level'] >= $boardInfo['comment_write_level']): 
		include 'view.comment.write.php'; 
	endif; 
	?>

</div>