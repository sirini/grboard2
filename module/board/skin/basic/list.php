<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2" rel="<?php echo $grboard; ?>">

<?php if(isset($boardCategory[0])): ?>
<header>
	<div class="category">

	<?php foreach($boardCategory as &$category): ?>
		<a href="<?php echo $boardLink; ?>/category/<?php echo $category; ?>/1">
		<?php echo $category; ?></a> <span>|</span>
	<?php endforeach; unset($category); ?>
	
	</div>
</header>
<?php endif; ?>

<table rules="none">
<colgroup>
	<col class="no" />
	<col class="subject" />
	<col class="name" />
	<col class="date" />
	<col class="hit" />
</colgroup>
<thead>
<tr>
	<th class="no">no</th>
	<th class="subject">subject</th>
	<th class="name">name</th>
	<th class="date">date</th>
	<th class="hit">hit</th>
</tr>
</thead>
<tbody>

<?php 
if(isset($boardNotice[0]['no'])): 
	foreach($boardNotice as &$notice): 
		$link = $boardLink . '/view/' . $notice['no'];
?>
<tr class="notice">
	<td class="no"><?php echo $notice['no']; ?></td>
	<td class="subject"><a href="<?php echo $link; ?>"><?php echo $notice['subject']; ?></a> 
		<?php if($notice['comment_count'] > 0): ?>
			<span>[<?php echo $notice['comment_count']; ?>]</span>
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
?>
<tr class="list">
	<td class="no"><?php echo $post['no']; ?></td>
	<td class="subject"><a href="<?php echo $link; ?>"><?php echo $post['subject']; ?></a>
		<?php if($post['comment_count'] > 0): ?>
			<span>[<?php echo $post['comment_count']; ?>]</span>
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

<?php
$prevLink = $boardLink . '/list/' . ($ext_page - $boardInfo['page_per_list']);
$nextLink = $boardLink . '/list/' . ($ext_page + $boardInfo['page_per_list']);
$pageLink = $boardLink . '/list/';
if(isset($option)) {
	$prevLink = $boardLink . '/' . $option . '/' . $value . '/' . ($ext_page - $boardInfo['page_per_list']);
	$nextLink = $boardLink . '/' . $option . '/' . $value . '/' . ($ext_page + $boardInfo['page_per_list']);
	$pageLink = $boardLink . '/' . $option . '/' . $value . '/';
}
?>

<footer>
	<ul class="pages">
		<?php if($boardNowBlock > 1): ?>
			<li><a href="<?php echo $prevLink; ?>" class="prevPage">Prev</a></li>
		<?php endif; ?>

		<?php foreach($boardPaging as &$pageNo): ?>
			<li><span class="pageNo"><a href="<?php echo $pageLink . $pageNo; ?>"><?php echo $pageNo; ?></a></span></li>
		<?php endforeach; unset($pageNo); ?>

		<?php if($boardNowBlock < $boardTotalBlock): ?>
			<li><a href="<?php echo $nextLink; ?>" class="prevPage">Next</a></li>
		<?php endif; ?>
	</ul>

	<ul class="buttons">
		
		<?php if($Common->getSessionKey() == 0): ?>
			<li><a href="<?php echo $boardLink; ?>/login">Login</a></li>
			<li><a href="<?php echo $boardLink; ?>/join">Join</a></li>
		<?php elseif($Common->getSessionKey() == 1): ?>
			<li><a href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $boardInfo['no']; ?>">Admin</a></li>
		<?php endif; if($Common->getSessionKey() > 0): ?>
			<li><a href="<?php echo $boardLink; ?>/logout">Logout</a></li>
		<?php endif; ?>

		<li><a href="<?php echo $boardLink; ?>/list/1">List</a></li>
		<li><a href="<?php echo $boardLink; ?>/write">Write</a></li>

	</ul>
	
	<div class="searchBox">
		<div class="searchInput">
			<form id="gr2searchForm" method="get" action="./">
				<div class="hiddenInputs">
					<input type="hidden" name="boardId" value="<?php echo $ext_id; ?>" />
					<input type="hidden" name="page" value="<?php echo $ext_page; ?>" />
				</div>
				<select name="option">
					<option value="subject" <?php echo (isset($option) && $option == 'subject') ? 'selected="true"':''; ?>>Subject</option>
					<option value="content" <?php echo (isset($option) && $option == 'content') ? 'selected="true"':''; ?>>Content</option>
					<option value="tag" <?php echo (isset($option) && $option == 'tag') ? 'selected="true"':''; ?>>Tag</option>
					<option value="name" <?php echo (isset($option) && $option == 'name') ? 'selected="true"':''; ?>>Name</option>
				</select>
				<input type="search" name="value" value="<?php echo (isset($value)) ? $value:''; ?>" />
				<input type="submit" value="Submit" />
			</form>
		</div>
	</div>
</footer>

</div>

<?php unset($prevLink, $nextLink, $pageLink); ?>
