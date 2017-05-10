<?php
if(!defined('GR_BOARD_2')) exit();

class Paging {
	
	private $pagePerRecord;
	private $blockPerPage;
	private $nowPage;
	private $totalRecord;
	private $totalPage;
	private $totalBlock;
	private $nowBlock;
	private $startRecord;
	private $startPage;
	private $endPage;

	public function __construct($_pagePerRecord, $_blockPerPage, $_nowPage, $_totalRecord) {
		$this->pagePerRecord = (int)$_pagePerRecord;
		$this->blockPerPage = (int)$_blockPerPage;
		$this->nowPage = (int)$_nowPage;		
		$this->totalRecord = (int)$_totalRecord;

		$this->totalPage = ceil($this->totalRecord / $this->pagePerRecord);
		$this->totalBlock = ceil($this->totalPage / $this->blockPerPage);
		$this->nowBlock = ceil($this->nowPage / $this->blockPerPage);
		$this->startRecord = (($this->nowPage - 1) * $this->pagePerRecord);
		$this->startPage = (($this->nowBlock - 1) * $this->blockPerPage);
		$this->endPage = $this->startPage + $this->blockPerPage;
		if($this->totalPage < $this->endPage) $this->endPage = $this->totalPage;
	}

	public function getStartRecord() { return (int)$this->startRecord; }
	public function getTotalPage() { return (int)$this->totalPage; }
	public function getTotalBlock() { return (int)$this->totalBlock; }
	public function getNowBlock() { return (int)$this->nowBlock; }

	public function getPaging() {
		$result = array();
		for($i=$this->startPage + 1; $i<$this->endPage + 1; $i++) {
			$result[] = $i;
		}
		return $result;
	}	
}
?>