<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2" class="card bg-light">
	
	<form id="boardDeleteForm" method="post" action="<?php echo $boardLink; ?>/deletecomment/<?php echo $comment; ?>">
		<div>
			<input type="hidden" name="deleteProceed" value="yes" />
			<input type="hidden" name="postUID" value="<?php echo $postUID; ?>" />
		</div>
		<h4 class="card-header">Delete a comment</h4>
			
		<div class="card-body">				
			<div class="row">
				<div class="col"><?php echo $content; ?></div>
			</div>
			<div style="height: 1.0rem"></div>
			<div class="row">
				<div class="col"><input type="submit" value="Delete" class="btn btn-outline-danger btn-block" /></div>
				<div class="col"><a href="<?php echo $boardLink; ?>/list/1" class="btn btn-outline-secondary btn-block">Cancel</a></div>
			</div>	
			
		</div>
					
	</form>
	
</div>