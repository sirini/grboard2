<?php if(!defined('GR_BOARD_2')) exit(); ?>

<fieldset>
<legend>Blog configuration</legend>

<form id="blogConfigForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/blog/admin">
<div class="hiddenInputs">
	<input type="hidden" name="blogConfigSave" value="true" />
</div>

<div class="form-group">
	<label for="name" class="col-md-2 control-label">Name</label>
	<div class="col-md-3">
		<input type="text" name="name" required="true" class="form-control" maxlength="20" value="<?php echo $oldData['name']; ?>" /> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['config_blog_name']; ?></span>
</div>	

<div class="form-group">
	<label for="email" class="col-md-2 control-label">E-mail</label>
	<div class="col-md-3">
		<input type="email" name="email" class="form-control" maxlength="250" value="<?php echo $oldData['email']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['config_blog_email']; ?></span>
</div>	

<div class="form-group">
	<label for="homepage" class="col-md-2 control-label">Homepage</label>
	<div class="col-md-3">
		<input type="url" name="homepage" class="form-control" maxlength="250" value="<?php echo $oldData['homepage']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['config_blog_homepage']; ?></span>
</div>	

<div class="form-group">
	<label for="blog_title" class="col-md-2 control-label">Title</label>
	<div class="col-md-5">
		<input type="text" name="blog_title" required="true" class="form-control" maxlength="250" value="<?php echo $oldData['blog_title']; ?>" />
	</div>
	<span class="help-block col-md-5"><?php echo $lang['config_blog_title']; ?></span>
</div>	

<div class="form-group">
	<label for="blog_info" class="col-md-2 control-label">Information</label>
	<div class="col-md-5">
		<input type="text" name="blog_info" required="true" class="form-control" maxlength="250" value="<?php echo $oldData['blog_info']; ?>" />
	</div>
	<span class="help-block col-md-5"><?php echo $lang['config_blog_info']; ?></span>
</div>	

<div class="form-group">
	<label for="theme" class="col-md-2 control-label">Skin</label>
	<div class="col-md-3">
		<select name="theme" class="form-control">
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
	</div>
	<span class="help-block col-md-7"><?php echo $lang['config_blog_skin']; ?></span>
</div>

<div class="form-group">
	<label for="num_view_post" class="col-md-2 control-label">A number of post</label>
	<div class="col-md-2">
		<input type="text" name="num_view_post" required="true" class="form-control" maxlength="10" value="<?php echo $oldData['num_view_post']; ?>" /> 
	</div>
	<span class="help-block col-md-8"><?php echo $lang['config_blog_num_view_post']; ?></span>
</div>	

<div class="form-group">
	<label for="blocks" class="col-md-2 control-label">A number of page</label>
	<div class="col-md-2">
		<input type="text" name="num_per_page" required="true" class="form-control" maxlength="10" value="<?php echo $oldData['num_per_page']; ?>" />  
	</div>
	<span class="help-block col-md-8"><?php echo $lang['config_blog_num_per_page']; ?></span>
</div>	

<div class="form-group">
	<label for="num_rss_post" class="col-md-2 control-label">A number of rss</label>
	<div class="col-md-2">
		<input type="text" name="num_rss_post" required="true" class="form-control" maxlength="10" value="<?php echo $oldData['num_rss_post']; ?>" /> 
	</div>
	<span class="help-block col-md-8"><?php echo $lang['config_blog_num_rss_post']; ?></span>
</div>	

<div class="form-group">
	<label for="use_comment" class="col-md-2 control-label">Accept reply</label>
	<div class="col-md-10">
		<div class="checkbox">
			<input type="checkbox" name="use_comment" value="1" 
				<?php echo ($oldData['use_comment'])?'checked="true"':''; ?>" /> <?php echo $lang['config_blog_use_comment']; ?>
		</div>
	</div>
</div>	

<div class="form-group">
	<label for="use_rss" class="col-md-2 control-label">Share RSS</label>
	<div class="col-md-10">
		<div class="checkbox">
			<input type="checkbox" name="use_rss" value="1" 
				<?php echo ($oldData['use_rss'])?'checked="true"':''; ?>" /> <?php echo $lang['config_blog_use_rss']; ?>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="num_rss_content" class="col-md-2 control-label">RSS Content length</label>
	<div class="col-md-2">
		<input type="text" name="num_rss_content" required="true" class="form-control" maxlength="10" value="<?php echo $oldData['num_rss_content']; ?>" /> 
	</div>
	<span class="help-block col-md-8"><?php echo $lang['config_blog_num_rss_content']; ?></span>
</div>	

<div class="form-group text-right">
	<input type="submit" value="Submit" class="btn btn-lg btn-primary" />
</div>

</form>
</fieldset>