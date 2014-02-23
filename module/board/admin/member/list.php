<?php
if(!defined('GR_BOARD_2')) exit();
if($Common->getSessionKey() != 1) $Common->error($error['msg_no_permission']);
$memberTotalRecord = $Model->getTotalMemberCount();
$pageNum = 10;
$pagePerList = 20;
$memberList = $Model->getMemberList($page, $pageNum, $pagePerList);

include 'util/common/paging.php';
$Paging = new Paging($pagePerList, $pageNum, $page, $memberTotalRecord);
$memberPaging = $Paging->getPaging();
$memberTotalPage = $Paging->getTotalPage();
$memberTotalBlock = $Paging->getTotalBlock();
$memberNowBlock = $Paging->getNowBlock();
$pageLink = '/' . $grboard . '/board/admin/page2member/';
$prevLink = $pageLink . ($page - $pageNum);
$nextLink = $pageLink . ($page + $pageNum);

include $skinResourcePath . '/member.list.php';
?>
