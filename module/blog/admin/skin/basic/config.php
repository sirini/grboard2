<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="card panel-default">

    <h4 class="card-header">Blog configuration</h4>
    
    <div class="card-body">

		<form id="blogConfigForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/blog/admin">
		<div class="hiddenInputs">
			<input type="hidden" name="blogConfigSave" value="true" />
		</div>
		
		<div class="row">
    		<div class="col">
                <div class="form-group">
                	<label for="name" class="control-label">Name</label>
                	<input type="text" class="form-control" name="name" id="name" maxlength="50" value="<?php echo $oldData['name']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_name']; ?></small>
                </div>		
                <div class="form-group">
                	<label for="blog_title" class="control-label">Title</label>
                	<input type="text" class="form-control" name="blog_title" id="blog_title" maxlength="250" value="<?php echo $oldData['blog_title']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_title']; ?></small>
                </div>	
                <div class="form-group">
                	<label for="blog_info" class="control-label">Information</label>
                	<input type="text" class="form-control" name="blog_info" id="blog_info" maxlength="250" value="<?php echo $oldData['blog_info']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_info']; ?></small>
                </div>	
                <div class="form-group">
                	<label for="num_view_post" class="control-label">A number of post</label>
                	<input type="text" class="form-control" name="num_view_post" id="num_view_post" maxlength="10" value="<?php echo $oldData['num_view_post']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_num_view_post']; ?></small>
                </div>	
                <div class="form-group">
                	<label for="num_rss_post" class="control-label">A number of rss</label>
                	<input type="text" class="form-control" name="num_rss_post" id="num_rss_post" maxlength="10" value="<?php echo $oldData['num_rss_post']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_num_rss_post']; ?></small>
                </div>
                <div class="form-group">
                	<label for="num_rss_content" class="control-label">RSS Content length</label>
                	<input type="text" class="form-control" name="num_rss_content" id="num_rss_content" maxlength="10" value="<?php echo $oldData['num_rss_content']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_num_rss_content']; ?></small>
                </div>
			</div>
			<div class="col">
                <div class="form-group">
                	<label for="email" class="control-label">E-mail</label>
                	<input type="email" class="form-control" name="email" id="email" maxlength="250" value="<?php echo $oldData['email']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_email']; ?></small>
                </div>			
                <div class="form-group">
                	<label for="homepage" class="control-label">Homepage</label>
                	<input type="url" class="form-control" name="homepage" id="homepage" maxlength="250" value="<?php echo $oldData['homepage']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_homepage']; ?></small>
                </div>	
				<div class="form-group">
                	<label for="theme" class="control-label">Skin</label>
					<select name="theme" class="custom-select">
    				<?php
    				$skinpath = 'module/blog/skin/'; 
    				$od = opendir($skinpath);
    				while($rd = readdir($od)) {
    					if($rd == '.' || $rd == '..') continue;
    					if(is_dir($skinpath . $rd)) {
    						echo '<option value="'.$rd.'" '.(($rd == $oldData['theme'])?'selected="true"':'').'>'.$rd.'</option>';
    					}
    				}
    				?>
    				</select>
                	<small class="form-text text-muted"><?php echo $lang['config_blog_skin']; ?></small>
                </div>
                <div class="form-group">
                	<label for="num_per_page" class="control-label">A number of page</label>
                	<input type="text" class="form-control" name="num_per_page" id="num_per_page" maxlength="10" value="<?php echo $oldData['num_per_page']; ?>" />
                	<small class="form-text text-muted"><?php echo $lang['config_blog_num_per_page']; ?></small>
                </div>
                <div class="form-group">
                    <div class="form-check">
                    	<label class="form-check-label" for="use_comment">
                    		<input type="checkbox" class="form-check-input" id="use_comment" name="use_comment" value="1" <?php echo ($oldData['use_comment'])?'checked="true"':''; ?> />
                    			<?php echo $lang['config_blog_use_comment']; ?></label>
                	</div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                    	<label class="form-check-label" for="use_rss">
                    		<input type="checkbox" class="form-check-input" id="use_rss" name="use_rss" value="1" <?php echo ($oldData['use_rss'])?'checked="true"':''; ?> />
                    			<?php echo $lang['config_blog_use_rss']; ?></label>
                    </div>
                </div>
			</div>
		</div>
		
        <div class="form-group">
        	<input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block" />
        </div>
		
		</form>		
	</div>
