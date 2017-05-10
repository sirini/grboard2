<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="panel-heading">
	<h3 class="panel-title"><strong>Delete a member account</strong></h3>
</div>

<div class="panel-body">
	<form id="memberDeleteForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/delete2member/<?php echo $memberId; ?>">
	<div class="hiddenInputs">
		<input type="hidden" name="memberDeleteId" value="<?php echo $memberId; ?>" />
	</div>
	
	<table rules="none" id="memberDelete" class="table table-striped">
		<colgroup>
			<col class="col-md-3" />
			<col class="col-md-9" />
		</colgroup>
		<thead>
			<tr>
				<th>Item</th>
				<th>Information</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Delete ID</td>
				<td>				
					<span><?php echo $memberInfo['id']; ?></span></td>
			</tr>
			<tr>
				<td>User Name</td>
				<td>				
					<span><?php echo $memberInfo['nickname']; ?> (<?php echo $memberInfo['realname']; ?>)</span></td>
			</tr>
			<tr>
				<td>Join date</td>
				<td>				
					<span><?php echo date('Y.m.d H:i:s', $memberInfo['make_time']); ?></span></td>
			</tr>
			<tr>
				<td>Last login</td>
				<td>				
					<span><?php echo date('Y.m.d H:i:s', $memberInfo['lastlogin']); ?></span></td>
			</tr>
			<tr>
				<td>Message</td>
				<td>				
					<span><?php echo $lang['member_delete_message']; ?></span></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">
					<a href="/<?php echo $grboard; ?>/board/admin/member/list" class="btn btn-lg btn-default">Cancel</a>
					<input type="submit" value="OK" class="btn btn-lg btn-primary" />					
				</td>
			</tr>
		</tbody>
	</table>
	
	</form>
</div>