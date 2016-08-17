<?php

class api_PortfolioItem {
	public function __construct($html, $title, $prev, $next, $pll, $nll) {
		if(!php_Boot::$skip_constructor) {
		$this->html = $html;
		$this->title = $title;
		$this->prevLink = $prev;
		$this->nextLink = $next;
		$this->nextLinkLabel = $nll;
		$this->prevLinkLabel = $pll;
	}}
	public $html;
	public $prevLink;
	public $nextLink;
	public $prevLinkLabel;
	public $nextLinkLabel;
	public $title;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'api.PortfolioItem'; }
}
