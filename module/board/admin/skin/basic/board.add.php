<?php if(!defined('GR_BOARD_2')) exit(); ?>

<fieldset>
<legend><?php echo $title; ?></legend>

<form id="boardAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/board/save">
<div class="hiddenInputs">
	<input type="hidden" name="boardFormSubmitType" value="<?php echo $mode; ?>" />
	<input type="hidden" name="boardId" value="<?php echo $oldData['id']; ?>" />
	<input type="hidden" name="boardUid" value="<?php echo $oldData['no']; ?>" />
	<input type="hidden" name="comment_sort" value="1" />
	<input type="hidden" name="down_point" value="0" />
</div>

<div class="form-group">
	<label for="group_no" class="col-md-2 control-label">Group</label>
	<div class="col-md-3">
		<select name="group_no" class="form-control">
		<?php 
		$group = $Model->getBoardGroupList();
		foreach($group as &$g) {
			echo '<option value="' . $g['no'] . '" '.(($g['no'] == $oldData['group_no'])?'selected="true"':'').'>'.
				stripslashes($g['name']).'</option>';
		}
		?>
		</select>
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_group']; ?></span>
</div>

<div class="form-group">
	<label for="id" class="col-md-2 control-label">ID</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="id" maxlength="50" value="<?php echo $oldData['id']; ?>" 
				<?php echo ($mode=='modify')?'readonly="true"':''; ?> />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_id']; ?></span>
</div>	
		
<div class="form-group">
	<label for="name" class="col-md-2 control-label">Name</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="name" maxlength="50" value="<?php echo $oldData['name']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_name']; ?></span>
</div>

<div class="form-group">
	<label for="theme" class="col-md-2 control-label">Skin</label>
	<div class="col-md-3">
		<select name="theme" class="form-control">
		<?php
		$skinpath = 'module/board/skin/'; 
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
	<span class="help-block col-md-7"><?php echo $lang['board_add_theme']; ?></span>
</div>

<div class="form-group">
	<label for="page_num" class="col-md-2 control-label">Page count</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="page_num" class="short" value="<?php echo $oldData['page_num']; ?>" />
	</div> 
	<span class="help-block col-md-7"><?php echo $lang['board_add_page_num']; ?></span>
</div>

<div class="form-group">
	<label for="page_per_list" class="col-md-2 control-label">List count</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="page_per_list" class="short" value="<?php echo $oldData['page_per_list']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_page_per_list']; ?></span>
</div>

<div class="form-group">
	<label for="cut_subject" class="col-md-2 control-label">Subject length</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="cut_subject" class="short" value="<?php echo $oldData['cut_subject']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_cut_subject']; ?></span>
</div>

<div class="form-group">
	<label for="comment_page_num" class="col-md-2 control-label">Comment count</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="comment_page_num" class="short" value="<?php echo $oldData['comment_page_num']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_comment_page_num']; ?></span>
</div>

<div class="form-group">
	<label for="comment_page_per_list" class="col-md-2 control-label">Comment list</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="comment_page_per_list" class="short" value="<?php echo $oldData['comment_page_per_list']; ?>" />
	</div> 
	<span class="help-block col-md-7"><?php echo $lang['board_add_comment_page_per_list']; ?></span>
</div>

<div class="form-group">
	<label for="head_file" class="col-md-2 control-label">Head file</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="head_file" value="<?php echo $oldData['head_file']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_head_file']; ?></span>
</div>

<div class="form-group">
	<label for="head_form" class="col-md-2 control-label">Head form</label>
	<div class="col-md-10">
		<textarea name="head_form" class="form-control" rows="10"><?php echo $oldData['head_form']; ?></textarea>
		<span class="help-block"><?php echo $lang['board_add_head_form']; ?></span>
	</div>	
</div>

<div class="form-group">
	<label for="foot_form" class="col-md-2 control-label">Foot form</label>
	<div class="col-md-10">
		<textarea name="foot_form" class="form-control" rows="10"><?php echo $oldData['foot_form']; ?></textarea> 
		<span class="help-block"><?php echo $lang['board_add_foot_form']; ?></span>
	</div>	
</div>

<div class="form-group">
	<label for="foot_file" class="col-md-2 control-label">Foot file</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="foot_file" value="<?php echo $oldData['foot_file']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_foot_file']; ?></span>
</div>

<div class="form-group">
	<label for="category" class="col-md-2 control-label">Category</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="category" value="<?php echo $oldData['category']; ?>" />
	</div> 
	<span class="help-block col-md-7"><?php echo $lang['board_add_category']; ?></span>
</div>

<div class="form-group">
	<label for="master" class="col-md-2 control-label">Masters</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="master" value="<?php echo $oldData['master']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_master']; ?></span>
</div>

<div class="form-group">
	<label for="num_file" class="col-md-2 control-label">Max file count</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="num_file" value="<?php echo $oldData['num_file']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['board_add_num_file']; ?></span>
</div>

<div class="form-group">
	<label for="enter_level" class="col-md-2 control-label">Enter level</label>
	<div class="col-md-2">
		<select name="enter_level" class="form-control">
		<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['enter_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
		<?php } ?>
		</select>
	</div>
	<span class="help-block col-md-8"><?php echo $lang['board_add_enter_level']; ?></span>
</div>

<div class="form-group">
	<label for="view_level" class="col-md-2 control-label">View level</label>
	<div class="col-md-2">
		<select name="view_level" class="form-control">
			<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['view_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</div>
	<span class="help-block col-md-8"><?php echo $lang['board_add_view_level']; ?></span>
</div>

<div class="form-group">
	<label for="write_level" class="col-md-2 control-label">Write level</label>
	<div class="col-md-2">
		<select name="write_level" class="form-control">
			<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['write_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</div>
	<span class="help-block col-md-8"><?php echo $lang['board_add_write_level']; ?></span>
</div>

<div class="form-group">
	<label for="comment_write_level" class="col-md-2 control-label">comment level</label>
	<div class="col-md-2">
		<select name="comment_write_level" class="form-control">
			<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['comment_write_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</div>
	<span class="help-block col-md-8"><?php echo $lang['board_add_write_level']; ?></span>
</div>

<div class="form-group">
	<label for="down_level" class="col-md-2 control-label">down level</label>
	<div class="col-md-2">
		<select name="down_level" class="form-control">
			<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['down_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</div>
	<span class="help-block col-md-8"><?php echo $lang['board_add_down_level']; ?></span>
</div>

<div class="form-group text-right">
	<input type="submit" value="Submit" class="btn btn-primary btn-lg" />
</div>
</fieldset>