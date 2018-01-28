<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Delete a member account</h4>

<div class="card-body">
	<form id="memberDeleteForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/board/admin/delete2member/<?php echo $memberId; ?>">
	<div class="hiddenInputs">
		<input type="hidden" name="memberDeleteId" value="<?php echo $memberId; ?>" />
	</div>
	
	<table role="table" id="memberDelete" class="table">
		<thead>
			<tr>
				<th scope="col">Item</th>
				<th scope="col">Information</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Delete ID</td>
				<td><?php echo $memberInfo['id']; ?></td>
			</tr>
			<tr>
				<td>User Name</td>
				<td><?php echo $memberInfo['nickname']; ?> (<?php echo $memberInfo['realname']; ?>)</td>
			</tr>
			<tr>
				<td>Join date</td>
				<td><?php echo date('Y.m.d H:i:s', $memberInfo['make_time']); ?></td>
			</tr>
			<tr>
				<td>Last login</td>
				<td><?php echo date('Y.m.d H:i:s', $memberInfo['lastlogin']); ?></td>
			</tr>
			<tr>
				<td>Message</td>
				<td><?php echo $lang['member_delete_message']; ?></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center">
					<a href="/<?php echo $grboard; ?>/board/admin/member/list" class="btn btn-lg btn-default">Cancel</a>
					<input type="submit" value="OK" class="btn btn-lg btn-danger" data-toggle="tooltip" title="이 회원을 정말로 삭제 하시겠습니까? 이 작업은 되돌릴 수 없습니다." />					
				</td>
			</tr>
		</tbody>
	</table>
	
	</form>
</div>