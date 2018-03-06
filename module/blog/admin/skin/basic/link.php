<?php if(!defined('GR_BOARD_2')) exit(); ?>

<form id="blogConfigForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/blog/admin">
<div class="card">
	<h5 class="card-header">Link management</h5>
	<div class="card-body">
		
		<div class="hiddenInputs">
			<input type="hidden" name="blogLinkSave" value="true" />
			<input type="hidden" name="blogLinkAction" value="add" />
			<input type="hidden" name="linkTarget" value="" />
			<input type="hidden" name="linkName" value="" />
			<input type="hidden" name="linkURL" value="" />
			<input type="hidden" name="linkInfo" value="" />
		</div>

		<div class="row">
			<div class="col">
                <div class="form-group">
                	<label for="addName" class="control-label">Link Name</label>
                	<input type="text" class="form-control" name="addName" id="addName" maxlength="250" value="" />
                	<small class="form-text text-muted"><?php echo $lang['link_add_name']; ?></small>
                </div>
			</div>
			<div class="col">
                <div class="form-group">
                	<label for="addUrl" class="control-label">Link Url</label>
                	<input type="url" class="form-control" name="addUrl" id="addUrl" placeholder="http://URL" maxlength="250" value="" />
                	<small class="form-text text-muted"><?php echo $lang['link_add_url']; ?></small>
                </div>
			</div>
			<div class="col">
                <div class="form-group">
                	<label for="addInfo" class="control-label">Link Description</label>
                	<input type="text" class="form-control" name="addInfo" id="addInfo" maxlength="250" value="" />
                	<small class="form-text text-muted"><?php echo $lang['link_add_description']; ?></small>
                </div>
			</div>
		</div>
		
		<div class="form-group">
        	<input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block" />
        </div>   
		
	</div>
</div>
		

<div id="linkLists">
    <?php if(count($oldLink) > 0): foreach($oldLink as &$link): ?>
    <div class="card bg-light">
    	<div class="card-body">
        	<div class="row">
            	<div class="col-3">
                    <div class="form-group">
                    	<label for="addName" class="control-label">Link Name</label>
                    	<input type="text" class="form-control" name="name_<?php echo $link['uid']; ?>" id="name_<?php echo $link['uid']; ?>" maxlength="250" value="<?php echo $link['name']; ?>" />
                    	<small class="form-text text-muted"><?php echo $lang['link_add_name']; ?></small>
                    </div>
            	</div>
            	<div class="col-3">
                    <div class="form-group">
                    	<label for="addUrl" class="control-label">Link Url</label>
                    	<input type="url" class="form-control" name="url_<?php echo $link['uid']; ?>" id="url_<?php echo $link['uid']; ?>" maxlength="250" value="<?php echo $link['url']; ?>" />
                    	<small class="form-text text-muted"><?php echo $lang['link_add_url']; ?></small>
                    </div>
            	</div>
            	<div class="col-4">
                    <div class="form-group">
                    	<label for="addInfo" class="control-label">Link Description</label>
                    	<input type="text" class="form-control" name="info_<?php echo $link['uid']; ?>" id="info_<?php echo $link['uid']; ?>" maxlength="250" value="<?php echo $link['info']; ?>" />
                    	<small class="form-text text-muted"><?php echo $lang['link_add_description']; ?></small>
                    </div>
            	</div>
            	<div class="col-2">
                    <div class="form-group">
            			<button class="btn btn-md btn-primary btn-block update-link" rel="<?php echo $link['uid']; ?>">Update</button>
            			<button class="btn btn-md btn-danger btn-block delete-link" rel="<?php echo $link['uid']; ?>">Delete</button>
                    </div>  
            	</div>
            </div>
    	</div>
    </div>
    <?php endforeach; endif; ?>
</div>
		
</form>