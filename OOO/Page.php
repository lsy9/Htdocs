<?php
//自定义分页类

class Page
{
	public $page = 1;	//当前页
	public $pageSize = 10;	//页大小
	public $maxRows = 0;	//总数据条数
	public $maxPage = 0;	//总页数
	
	public function __construct($maxRows,$pageSize)
	{
		$this->maxRows = $maxRows;
		$this->pageSize = $pageSize;
		$this->page = isset($_GET['p'])?$_GET['p']:1;
		$this->loadMaxPage();
		$this->checkPage();
	}
	
	//计算最大页数
	protected function loadMaxPage()
	{
		$this->maxPage = ceil($this->maxRows/$this->pageSize);
	}
	
	//验证当前的有效性
	protected function checkPage()
	{
		if($this->page > $this->maxPage){
			$this->page = $this->maxPage;
		}
		if($this->page<1){
			$this->page = 1;
		}
	}
	
	public function limit()
	{
		return (($this->page-1)*$this->pageSize).",".$this->pageSize;
		
	}
	
	public function show()
	{
		$url = $_SERVER['PHP_SELF'];
		//处理参数，实现状态维持
		//var_dump($_GET);
		$params = "";
		foreach($_GET as $k=>$v){
			if($k!="p" && !empty($v)){
				$params .= "&".$k."=".$v;
			}
			
	
		}
		
		$str = "当前第{$this->page}/{$this->maxPage}页 共计{$this->maxRows}条 ";
		$str .= " <a href='{$url}?p=1{$params}'>首页</a>";
		$str .= " <a href='{$url}?p=".($this->page-1)."{$params}'>上一页</a>";
		$str .= " <a href='{$url}?p=".($this->page+1)."{$params}'>下一页</a>";
		$str .= " <a href='{$url}?p={$this->maxPage}{$params}'>尾页</a>";
		
		        $ps = "<nav>";
        $ps .="<ul class=\"pagination\">";
        $ps .="<li><a href=\"{$url}?p=".($this->page-1)."{$params}\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
        for($i=1;$i<=$this->maxPage;$i++){
            if($i==$this->page){
                $ps .="<li class=\"active\"><a href=\"{$url}?p={$i}{$params}\">{$i}</a></li>";
            }else{
                $ps .="<li><a href=\"{$url}?p={$i}{$params}\">{$i}</a></li>";
            }
        }
        $ps .="<li><a href=\"{$url}?p=".($this->page+1)."{$params}\" aria-label=\"Previous\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
        $ps .="</ul>";
        $ps .="</nav>";
		
		return $str;
	}
}
?>