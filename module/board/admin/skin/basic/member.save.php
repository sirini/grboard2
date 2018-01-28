<?php if(!defined('GR_BOARD_2')) exit(); ?>

<h4 class="card-header">Saved</h4>

<div class="card-body">
    <table role="table" id="memberAdd" class="table table-striped">
    	<thead>
    		<tr>
    			<th scope="col" class="text-center">Item</th>
    			<th scope="col" class="text-center">Information</th>
    		</tr>
    	</thead>
    	<tbody>
    		<tr>
    			<td class="text-center">Status</td>
    			<td class="text-center"><?php echo $lang['member_save_status']; ?></td>
    		</tr>
    		<?php if($memberUid > 0): ?>
    		<tr>
    			<td class="text-center">Modify</td>
    			<td class="text-center"><a href="/<?php echo $grboard; ?>/board/admin/modify2member/<?php echo $memberUid; ?>">
    				<?php echo $lang['member_save_modify']; ?></a></td>
    		</tr>
    		<?php endif; ?>
    	</tbody>
    </table>
</div>