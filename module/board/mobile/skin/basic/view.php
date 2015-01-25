<?php 
if(!defined('GR_BOARD_2')) exit(); 
include 'util/common/image.resize.php';
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">
	
	<div class="panel panel-default gr-overflow-hidden">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php if(strlen($boardPost['category']) > 0): ?>
				<span class="text-primary">[<?php echo $boardPost['category']; ?>]</span>
				<?php endif; echo $boardPost['subject']; ?>
			</h3>
		</div>
		
		<ul class="list-group">
				
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
			?>	
				
			<li class="list-group-item"><?php echo $boardPost['content']; ?></li>
		</ul>	
		
		<?php if($fileList != false): ?>
		<ul class="list-group">
			<?php foreach($fileList as &$file): ?>
				<li class="list-group-item">
					<a href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/download/<?php echo $file['uid']; ?>" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-download-alt"></span>
					</a> <?php echo $file['file_name']; ?></li>
			<?php endforeach; unset($file); ?>
		</ul>
		<?php endif; ?>
		
		<div class="panel-footer">
			<?php if($boardPost['homepage']): ?>
				<a href="<?php echo $boardPost['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">
					<span class="glyphicon glyphicon-home"></span>
				</a></li>
			<?php endif;
			echo $boardPost['name']; ?> (<span id="gr2userId"><?php echo $boardPost['writer_id']; ?></span>), 
			<?php echo date('m.d H:i', $boardPost['signdate']); ?>, 
			hit (<?php echo $boardPost['hit']; ?>),
			good (<?php echo $boardPost['good']; ?>),
			<span class="glyphicon glyphicon-tag"></span> <?php echo $boardPost['tag']; ?>
		</div>
	</div>
	
	<?php 
	if(isset($replyList[0]['no'])): 
		include 'view.comment.list.php'; 
	endif; 
	
	if($userInfo['level'] >= $boardInfo['comment_write_level']): 
		include 'view.comment.write.php'; 
	endif; 
	?>

</div>