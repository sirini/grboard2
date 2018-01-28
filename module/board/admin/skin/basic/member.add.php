<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header"><?php echo $title; ?></h4>

<div class="card-body">
	<form id="memberAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/member/save">
	<div class="hiddenInputs">
		<input type="hidden" name="memberFormSubmitType" value="<?php echo $mode; ?>" />
		<input type="hidden" name="memberUid" value="<?php echo $oldData['no']; ?>" />
		<input type="hidden" name="photo" value="" />
		<input type="hidden" name="nametag" value="" />
		<input type="hidden" name="icon" value="" />
		<input type="hidden" name="lastlogin" value="0" />
	</div>
	
	<div class="row">
		<div class="col">
        	<div class="form-group">
        		<label for="group_no" class="control-label">Group</label>
        		<select name="group_no" id="group_no" class="custom-select">
        		<?php 
        		$group = $Model->getMemberGroupList();
        		foreach($group as &$g) {
        			echo '<option value="' . $g['no'] . '" '.(($g['no'] == $oldData['group_no'])?'selected="true"':'').'>'.
        				stripslashes($g['name']).'</option>';
        		}
        		?>
        		</select>
        		<small class="form-text text-muted"><?php echo $lang['member_group']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="password" class="control-label">Password</label>
        		<input type="password" name="password" id="password" class="form-control" maxlength="50" value="" /> 
        		<small class="form-text text-muted"><?php echo $lang['member_add_password']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="realname" class="control-label">Real name</label>
        		<input type="text" name="realname" id="realname" class="form-control" maxlength="15" value="<?php echo $oldData['realname']; ?>" /> 
        		<small class="form-text text-muted"><?php echo $lang['member_add_realname']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="homepage" class="control-label">Homepage</label>
        		<input type="url" name="homepage" id="homepage" class="form-control" maxlength="250" value="<?php echo $oldData['homepage']; ?>" />
        		<small class="form-text text-muted"><?php echo $lang['member_add_homepage']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="point" class="control-label">Point</label>
        		<input type="text" name="point" id="point" class="form-control" maxlength="10" value="<?php echo $oldData['point']; ?>" /> 
        		<small class="form-text text-muted"><?php echo $lang['member_add_point']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="blocks" class="control-label">Retry count</label>
        		<input type="text" name="blocks" id="blocks" class="form-control" maxlength="10" value="<?php echo $oldData['blocks']; ?>" />  
        		<small class="form-text text-muted"><?php echo $lang['member_add_blocks']; ?></small>
        	</div>	
		</div>
		<div class="col">
        	<div class="form-group">
        		<label for="id" class="control-label">ID</label>
        		<input type="text" name="id" id="id" class="form-control" maxlength="50" value="<?php echo $oldData['id']; ?>" 
        			<?php echo ($mode=='modify')?'readonly="true"':''; ?> />
        		<small class="form-text text-muted"><?php echo $lang['member_add_id']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="nickname" class="control-label">Nick name</label>
        		<input type="text" name="nickname" id="nickname" class="form-control" maxlength="20" value="<?php echo $oldData['nickname']; ?>" /> 
        		<small class="form-text text-muted"><?php echo $lang['member_add_nickname']; ?></small>
        	</div>
        	<div class="form-group">
        		<label for="email" class="control-label">E-mail</label>
        		<input type="email" name="email" id="email" class="form-control" maxlength="250" value="<?php echo $oldData['email']; ?>" />
        		<small class="form-text text-muted"><?php echo $lang['member_add_email']; ?></small>
        	</div>		
        	<div class="form-group">
        		<label for="level" class="control-label">Level</label>
        		<select name="level" id="level" class="custom-select">
        			<?php for($i=1; $i<100; $i++) { ?>
        			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
        			<?php } ?>
        		</select> 
        		<small class="form-text text-muted"><?php echo $lang['member_add_level']; ?></small>
        	</div>	
        	<div class="form-group">
        		<label for="self_info" class="control-label">Introduce</label>
        		<textarea name="self_info" id="self_info" maxlength="255" class="form-control" rows="5"><?php echo $oldData['self_info']; ?></textarea>
        		<small class="form-text text-muted"><?php echo $lang['member_add_self_info']; ?></small> 
        	</div>
		</div>
	</div>
		
	<div class="form-group">
		<input type="submit" value="Submit" class="btn btn-lg btn-primary btn-block" />
	</div>
	
	</form>
</div>