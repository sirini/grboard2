<?php 
if(!defined('GR_BOARD_2')) exit(); 
$isAdmin = (($Common->getSessionKey() == 1) ? true : false);
$isMember = (($Common->getSessionKey() > 0) ? true : false);
?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">

<?php if(isset($boardCategory[0])): ?>
<header>
	<div class="category">

	<?php foreach($boardCategory as &$category): ?>
		<a href="<?php echo $boardLink; ?>/search/category/:<?php echo $category; ?>/1">
		<?php echo $category; ?></a> <span>|</span>
	<?php endforeach; unset($category); ?>
	
	</div>
</header>
<?php endif; ?>

<div class="table-responsive">
<form id="managePostForm" method="post" action="<?php echo $boardLink; ?>/managepost">
<div class="hiddenInputs">
	<input type="hidden" name="boardLink" value="<?php echo $boardLink; ?>" />
</div>
<table rules="none" class="table">
<colgroup>
	<?php if($isAdmin): ?><col class="check" /><?php endif; ?>
	<col class="no" />
	<col class="subject" />
	<col class="name" />
	<col class="date" />
	<col class="hit" />
</colgroup>
<thead>
<tr>
	<?php if($isAdmin): ?><th scope="col" class="check bg-pattern"><input type="checkbox" id="checkAllPost" /></th><?php endif; ?>
	<th scope="col" class="no bg-pattern">no</th>
	<th scope="col" class="subject bg-pattern">subject</th>
	<th scope="col" class="name bg-pattern">name</th>
	<th scope="col" class="date bg-pattern">date</th>
	<th scope="col" class="hit bg-pattern">hit</th>
</tr>
</thead>
<tbody>

<?php 
if(isset($boardNotice[0]['no'])): 
	foreach($boardNotice as &$notice): 
		$link = $boardLink . '/view/' . $notice['no'];
?>
<tr class="notice">
	<td scope="row" class="no"><?php echo $notice['no']; ?></td>
	<td class="subject" <?php if($isAdmin): echo 'colspan="2"'; endif; ?>><a href="<?php echo $link; ?>"><?php echo $notice['subject']; ?></a> 
		<?php if($notice['comment_count'] > 0): ?>
			<span class="badge"><?php echo $notice['comment_count']; ?></span>
		<?php endif; ?>
	</td>
	<td class="name"><?php echo $notice['name']; ?></td>
	<td class="date"><?php echo date('Y.m.d', $notice['signdate']); ?></td>
	<td class="hit"><?php echo $notice['hit']; ?></td>
</tr>
<?php 
	endforeach; 
	unset($notice); 
endif; 
?>

<?php 
if(isset($boardPost[0]['no'])): 
	foreach($boardPost as &$post): 
		$link = $boardLink . '/view/' . $post['no'];
		if($boardInfo['cut_subject'] > 0):
			$post['subject'] = mb_strcut($post['subject'], 0, $boardInfo['cut_subject'], 'UTF-8');
		endif;
?>
<tr class="list">
	<?php if($isAdmin): ?>
	<td class="check">
		<input type="checkbox" name="checkedArticle[]" value="<?php echo $post['no']; ?>" />
	</td>
	<?php endif; ?>
	<td scope="row" class="no"><?php echo $post['no']; ?></td>
	<td class="subject">
		<?php if(strlen($post['category']) > 0): ?>
			<span class="category">[<?php echo $post['category']; ?>]</span>
		<?php endif; ?>
		<a href="<?php echo $link; ?>"><?php echo $post['subject']; ?></a>
		<?php if($post['comment_count'] > 0): ?>
			<span class="badge badge-secondary"><?php echo $post['comment_count']; ?></span>
		<?php endif; ?>	
	</td>
	<td class="name"><?php echo $post['name']; ?></td>
	<td class="date"><?php echo date('Y.m.d', $post['signdate']); ?></td>
	<td class="hit"><?php echo $post['hit']; ?></td>
</tr>
<?php 
	endforeach; 
	unset($post); 
endif; 
?>
</tbody>
</table>
</form>
</div>

<?php
$prevLink = $boardLink . '/list/' . ($ext_page - $boardInfo['page_per_list']);
$nextLink = $boardLink . '/list/' . ($ext_page + $boardInfo['page_per_list']);
$pageLink = $boardLink . '/list/';
if(isset($option)) {
	$prevLink = $boardLink . '/search/' . $option . '/' . $value . '/' . ($ext_page - $boardInfo['page_per_list']);
	$nextLink = $boardLink . '/search/' . $option . '/' . $value . '/' . ($ext_page + $boardInfo['page_per_list']);
	$pageLink = $boardLink . '/search/' . $option . '/' . $value . '/';
}
?>

<footer>
	<ul class="pagination">
		<?php if($boardNowBlock > 1): ?>
			<li class="page-item"><a class="page-link" href="<?php echo $prevLink; ?>" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
				<span class="sr-only">Prev</span></a></li>
		<?php endif; ?>

		<?php foreach($boardPaging as &$pageNo): ?>
			<li class="page-item"><a class="page-link" href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></li>
		<?php endforeach; unset($pageNo); ?>

		<?php if($boardNowBlock < $boardTotalBlock): ?>
			<li class="page-item"><a class="page-link" href="<?php echo $nextLink; ?>" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
				<span class="sr-only">Next</span></a></li>
		<?php endif; ?>
	</ul>

	<ul class="buttons">
		<li><a href="<?php echo $boardLink; ?>/write" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="새로운 글을 작성 합니다">Write</a></li>
		<?php if(!$isMember): ?>
			<li><a href="<?php echo $boardLink; ?>/login" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="로그인을 합니다">Login</a></li>
			<li><a href="<?php echo $boardLink; ?>/join" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="신규 회원으로 가입 합니다">Join</a></li>
		<?php else: ?>
			<li><a href="<?php echo $boardLink; ?>/memo" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="쪽지함으로 갑니다">Memo</a></li>
			<li><a href="<?php echo $boardLink; ?>/logout" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="로그 아웃 합니다">LogOut</a></li>
			<li><a href="<?php echo $boardLink; ?>/myinfo" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="내 정보를 수정 합니다">MyInfo</a></li>
		<?php endif; ?>
		<li><a href="<?php echo $boardLink; ?>/list/1" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="목록을 봅니다">List</a></li>
		<li><a href="<?php echo $boardLink; ?>/mobile/list/<?php echo $ext_page; ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm" title="모바일 폰에서 봅니다">Mobile</a></li>
		<?php if($isAdmin): ?>
			<li><a href="#managePostForm" id="managePosts" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm btn-danger" title="선택한 게시글들을 관리 합니다">Posts</a></li>
			<li><a href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $boardInfo['no']; ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-sm btn-danger" title="게시판 설정을 관리 합니다">Board</a></li>
		<?php endif; ?>
	</ul>
					
	<div class="searchBox">
		<form id="gr2searchForm" method="get" action="./" class="form-inline">
			<div class="hiddenInputs">
				<input type="hidden" name="boardId" value="<?php echo $ext_id; ?>" />
				<input type="hidden" name="page" value="<?php echo $ext_page; ?>" />
			</div>
			<div class="form-group">	
				<select name="option" class="form-control" data-toggle="tooltip" data-placement="bottom" title="검색하고자 하는 대상을 선택 합니다">
					<option value="subject" <?php echo (isset($option) && $option == 'subject') ? 'selected="true"':''; ?>>Subject</option>
					<option value="content" <?php echo (isset($option) && $option == 'content') ? 'selected="true"':''; ?>>Content</option>
					<option value="tag" <?php echo (isset($option) && $option == 'tag') ? 'selected="true"':''; ?>>Tag</option>
					<option value="name" <?php echo (isset($option) && $option == 'name') ? 'selected="true"':''; ?>>Name</option>
				</select>
				<input type="search" name="value" data-toggle="tooltip" data-placement="bottom" title="이 곳에 검색어를 입력 합니다" class="form-control mr-sm-2" value="<?php echo (isset($value)) ? $value:''; ?>" />
				<input type="submit" value="Search" class="btn btn-primary btn-outline-primary my-2 my-sm-0" data-toggle="tooltip" data-placement="bottom" title="검색어를 입력 하신 후 클릭 하세요!" />
			</div>
		</form>
	</div>
		
	<!-- Modal dialog -->
	<div class="modal fade" id="modalDlg" tabindex="-1" role="dialog" aria-labelledby="modalDlgLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalDlgLabel">Title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalDlgContent">Content</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
</footer>

</div>

<?php unset($prevLink, $nextLink, $pageLink); ?>
