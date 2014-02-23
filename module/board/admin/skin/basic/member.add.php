<?php if(!defined('GR_BOARD_2')) exit(); ?>

<fieldset>
<legend><?php echo $title; ?></legend>

<form id="memberAddForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/member/save">
<div class="hiddenInputs">
	<input type="hidden" name="memberFormSubmitType" value="<?php echo $mode; ?>" />
	<input type="hidden" name="memberUid" value="<?php echo $oldData['no']; ?>" />
	<input type="hidden" name="photo" value="" />
	<input type="hidden" name="nametag" value="" />
	<input type="hidden" name="icon" value="" />
	<input type="hidden" name="lastlogin" value="0" />
</div>

<div class="form-group">
	<label for="group_no" class="col-md-2 control-label">Group</label>
	<div class="col-md-3">
		<select name="group_no" class="form-control">
		<?php 
		$group = $Model->getMemberGroupList();
		foreach($group as &$g) {
			echo '<option value="' . $g['no'] . '" '.(($g['no'] == $oldData['group_no'])?'selected="true"':'').'>'.
				stripslashes($g['name']).'</option>';
		}
		?>
		</select>
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_group']; ?></span>
</div>	

<div class="form-group">
	<label for="id" class="col-md-2 control-label">ID</label>
	<div class="col-md-3">
		<input type="text" name="id" class="form-control" maxlength="50" value="<?php echo $oldData['id']; ?>" 
				<?php echo ($mode=='modify')?'readonly="true"':''; ?> />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_id']; ?></span>
</div>	

<div class="form-group">
	<label for="password" class="col-md-2 control-label">Password</label>
	<div class="col-md-3">
		<input type="password" name="password" class="form-control" maxlength="50" value="" /> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_password']; ?></span>
</div>	

<div class="form-group">
	<label for="nickname" class="col-md-2 control-label">Nick name</label>
	<div class="col-md-3">
		<input type="text" name="nickname" class="form-control" maxlength="20" value="<?php echo $oldData['nickname']; ?>" /> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_nickname']; ?></span>
</div>	

<div class="form-group">
	<label for="realname" class="col-md-2 control-label">Real name</label>
	<div class="col-md-3">
		<input type="text" name="realname" class="form-control" maxlength="15" value="<?php echo $oldData['realname']; ?>" /> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_realname']; ?></span>
</div>	

<div class="form-group">
	<label for="email" class="col-md-2 control-label">E-mail</label>
	<div class="col-md-3">
		<input type="email" name="email" class="form-control" maxlength="250" value="<?php echo $oldData['email']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_email']; ?></span>
</div>	

<div class="form-group">
	<label for="homepage" class="col-md-2 control-label">Homepage</label>
	<div class="col-md-3">
		<input type="url" name="homepage" class="form-control" maxlength="250" value="<?php echo $oldData['homepage']; ?>" />
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_homepage']; ?></span>
</div>	

<div class="form-group">
	<label for="level" class="col-md-2 control-label">Level</label>
	<div class="col-md-3">
		<select name="level" class="form-control">
			<?php for($i=1; $i<100; $i++) { ?>
			<option value="<?php echo $i; ?>" <?php echo (($i == $oldData['level'])?'selected="true"':''); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_level']; ?></span>
</div>	

<div class="form-group">
	<label for="point" class="col-md-2 control-label">Point</label>
	<div class="col-md-3">
		<input type="text" name="point" class="form-control" maxlength="10" value="<?php echo $oldData['point']; ?>" /> 
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_point']; ?></span>
</div>	

<div class="form-group">
	<label for="self_info" class="col-md-2 control-label">Introduce</label>
	<div class="col-md-10">
		<textarea name="self_info" maxlength="255" class="form-control" rows="5"><?php echo $oldData['self_info']; ?></textarea>
		<span class="help-block"><?php echo $lang['member_add_self_info']; ?></span> 
	</div>	
</div>	

<div class="form-group">
	<label for="blocks" class="col-md-2 control-label">Retry count</label>
	<div class="col-md-3">
		<input type="text" name="blocks" class="form-control" maxlength="10" value="<?php echo $oldData['blocks']; ?>" />  
	</div>
	<span class="help-block col-md-7"><?php echo $lang['member_add_blocks']; ?></span>
</div>	

<div class="form-group text-right">
	<input type="submit" value="Submit" class="btn btn-lg btn-primary" />
</div>

</form>
</fieldset>