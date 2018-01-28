<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header"><?php echo $title; ?></h4>

<div class="card-body">
    <form id="boardAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/board/save">
    <div class="hiddenInputs">
    	<input type="hidden" name="boardFormSubmitType" value="<?php echo $mode; ?>" />
    	<input type="hidden" name="boardId" value="<?php echo $oldData['id']; ?>" />
    	<input type="hidden" name="boardUid" value="<?php echo $oldData['no']; ?>" />
    	<input type="hidden" name="comment_sort" value="1" />
    	<input type="hidden" name="down_point" value="0" />
    </div>
    
    <div class="row">
    	<div class="col">
    		<div class="form-group">
            	<label for="group_no" class="control-label">Group</label>
        		<select name="group_no" id="group_no" class="custom-select">
        		<?php 
        		$group = $Model->getBoardGroupList();
        		foreach($group as &$g) {
        			echo '<option value="' . $g['no'] . '" '.(($g['no'] == $oldData['group_no'])?'selected="true"':'').'>'.
        				stripslashes($g['name']).'</option>';
        		}
        		?>
        		</select>
            	<small class="form-text text-muted"><?php echo $lang['board_group']; ?></small>
            </div>
            <div class="form-group">
            	<label for="name" class="control-label">Name</label>
            	<input type="text" class="form-control" name="name" id="name" maxlength="50" value="<?php echo $oldData['name']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_name']; ?></small>
            </div>
            <div class="form-group">
            	<label for="theme" class="control-label">Mobile Skin</label>
        		<select name="theme_mobile" id="theme_mobile" class="custom-select">
        		<?php
        		$skinpath = 'module/board/mobile/skin/'; 
        		$od = opendir($skinpath);
        		while($rd = readdir($od)) {
        			if($rd == '.' || $rd == '..') continue;
        			if(is_dir($skinpath . $rd)) {
        				echo '<option value="'.$rd.'" '.(($rd == $oldData['theme_mobile'])?'selected="true"':'').'>'.$rd.'</option>';
        			}
        		}
        		?>
        		</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_theme']; ?></small>
            </div>
            <div class="form-group">
            	<label for="page_per_list" class="control-label">Page count</label>
            	<input type="text" class="form-control" name="page_per_list" id="page_per_list" class="short" value="<?php echo $oldData['page_per_list']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_page_num']; ?></small>
            </div>
            <div class="form-group">
            	<label for="comment_page_num" class="control-label">Comment count</label>
           		<input type="text" class="form-control" name="comment_page_num" id="comment_page_num" class="short" value="<?php echo $oldData['comment_page_num']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_comment_page_num']; ?></small>
            </div>
            <div class="form-group">
            	<label for="head_file" class="control-label">Head file</label>
           		<input type="text" class="form-control" name="head_file" id="head_file" value="<?php echo $oldData['head_file']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_head_file']; ?></small>
            </div>
            <div class="form-group">
            	<label for="head_form" class="control-label">Header html</label>
           		<textarea name="head_form" id="head_form" class="form-control" rows="10"><?php echo $oldData['head_form']; ?></textarea>
           		<small class="form-text text-muted"><?php echo $lang['board_add_head_form']; ?></small>
            </div>
            <div class="form-group">
            	<label for="category" class="control-label">Category</label>
            	<input type="text" class="form-control" name="category" id="category" value="<?php echo $oldData['category']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_category']; ?></small>
            </div>
            <div class="form-group">
            	<label for="num_file" class="control-label">Max file count</label>
           		<input type="text" class="form-control" name="num_file" id="num_file" value="<?php echo $oldData['num_file']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_num_file']; ?></small>
            </div>
            <div class="form-group">
            	<label for="view_level" class="control-label">View level</label>
            	<select name="view_level" id="view_level" class="custom-select">
            		<?php for($i=1; $i<100; $i++) { ?>
            		<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['view_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
            		<?php } ?>
            	</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_view_level']; ?></small>
            </div>
            <div class="form-group">
            	<label for="comment_write_level" class="control-label">comment level</label>
           		<select name="comment_write_level" id="comment_write_level" class="custom-select">
           			<?php for($i=1; $i<100; $i++) { ?>
           			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['comment_write_level'])?'selected="true"':''); ?>>
           				<?php echo $i; ?></option>
           			<?php } ?>
           		</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_write_level']; ?></small>
            </div>
    	</div>
    	<div class="col">
    		<div class="form-group">
            	<label for="id" class="control-label">ID</label>
        		<input type="text" class="form-control" name="id" id="id" maxlength="50" value="<?php echo $oldData['id']; ?>" 
        				<?php echo ($mode=='modify')?'readonly="true"':''; ?> />
            	<small class="form-text text-muted"><?php echo $lang['board_add_id']; ?></small>
        	</div>
            <div class="form-group">
            	<label for="theme" class="control-label">Skin</label>
        		<select name="theme" id="theme" class="custom-select">
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
            	<small class="form-text text-muted"><?php echo $lang['board_add_theme']; ?></small>
            </div>
            <div class="form-group">
            	<label for="page_num" class="control-label">List count</label>
            	<input type="text" class="form-control" name="page_num" id="page_num" class="short" value="<?php echo $oldData['page_num']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_page_per_list']; ?></small>
            </div>
            <div class="form-group">
            	<label for="cut_subject" class="control-label">Subject length</label>
            	<input type="text" class="form-control" name="cut_subject" id="cut_subject" class="short" value="<?php echo $oldData['cut_subject']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_cut_subject']; ?></small>
            </div>
            <div class="form-group">
            	<label for="comment_page_per_list" class="control-label">Comment list</label>
            	<input type="text" class="form-control" name="comment_page_per_list" id="comment_page_per_list" class="short" value="<?php echo $oldData['comment_page_per_list']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_comment_page_per_list']; ?></small>
            </div>
            <div class="form-group">
            	<label for="foot_form" class="control-label">Footer html</label>
           		<textarea name="foot_form" id="foot_form" class="form-control" rows="10"><?php echo $oldData['foot_form']; ?></textarea> 
           		<small class="form-text text-muted"><?php echo $lang['board_add_foot_form']; ?></small>
            </div>
            <div class="form-group">
            	<label for="foot_file" class="control-label">Foot file</label>
           		<input type="text" class="form-control" name="foot_file" id="foot_file" value="<?php echo $oldData['foot_file']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_foot_file']; ?></small>
            </div>
            <div class="form-group">
            	<label for="master" class="control-label">Masters</label>
           		<input type="text" class="form-control" name="master" id="master" value="<?php echo $oldData['master']; ?>" />
            	<small class="form-text text-muted"><?php echo $lang['board_add_master']; ?></small>
            </div>
            <div class="form-group">
            	<label for="enter_level" class="control-label">Enter level</label>
           		<select name="enter_level" id="enter_level" class="custom-select">
           		<?php for($i=1; $i<100; $i++) { ?>
           			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['enter_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
           		<?php } ?>
           		</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_enter_level']; ?></small>
            </div>
            <div class="form-group">
            	<label for="write_level" class="control-label">Write level</label>
            	<select name="write_level" id="write_level" class="custom-select">
            		<?php for($i=1; $i<100; $i++) { ?>
            		<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['write_level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
            		<?php } ?>
            	</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_write_level']; ?></small>
            </div>
            <div class="form-group">
            	<label for="down_level" class="control-label">down level</label>
           		<select name="down_level" id="down_level" class="custom-select">
           			<?php for($i=1; $i<100; $i++) { ?>
           			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['down_level'])?'selected="true"':''); ?>>
           				<?php echo $i; ?></option>
           			<?php } ?>
           		</select>
            	<small class="form-text text-muted"><?php echo $lang['board_add_down_level']; ?></small>
            </div>
    	</div>
    </div>
    
    <div class="form-group">
    	<input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block" />
    </div>
    </form>

</div>