<?php
class Page
{
  public $pageSize;
  public $page;
  public $rows;
  public $pages;
  public $offset;
  public $nextPage;
  public $previousPage;
  public function __construct($pageSize,$page,$rows)
  {
   $this->pageSize=$pageSize;
   $this->page=$page;
   $this->rows=$rows;
   $this->pages=ceil($this->rows/$this->pageSize);
   $this->offset=($this->page-1)*$this->pageSize; 
   $this->nextPage=$this->page+1;
   $this->previousPage=$this->page-1;
  }   
}
?>