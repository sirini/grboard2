<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2">
	
	<form id="boardDeleteForm" method="post" action="<?php echo $boardLink; ?>/deletecomment/<?php echo $comment; ?>">
		<div>
			<input type="hidden" name="deleteProceed" value="yes" />
			<input type="hidden" name="postUID" value="<?php echo $postUID; ?>" />
		</div>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Delete a comment</h3>
			</div>
			
			<div class="panel-body">				
				<?php echo $content; ?>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item"><input type="submit" value="Delete" class="btn btn-danger gr-width-full" /></li>
				<li class="list-group-item"><a href="<?php echo $boardLink; ?>/list/1" class="btn btn-default gr-width-full">Cancel</a></li>
			</ul>
			
		</div>
	</form>
	
</div>