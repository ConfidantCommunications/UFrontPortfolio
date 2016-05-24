<?php

class ufront_web_url_filter_DirectoryUrlFilter implements ufront_web_url_filter_UFUrlFilter{
	public function __construct($directory) {
		if(!php_Boot::$skip_constructor) {
		if(StringTools::startsWith($directory, "/")) {
			$directory = _hx_substr($directory, 1, strlen($directory));
		}
		if(StringTools::endsWith($directory, "/")) {
			$directory = _hx_substr($directory, 0, strlen($directory) - 1);
		}
		$this->directory = $directory;
		if($directory !== "") {
			$this->segments = _hx_explode("/", $directory);
		} else {
			$this->segments = (new _hx_array(array()));
		}
	}}
	public $directory;
	public $segments;
	public function filterIn($url) {
		$pos = 0;
		while($url->segments->length > 0 && $url->segments[0] === $this->segments[$pos++]) {
			$url->segments->shift();
		}
	}
	public function filterOut($url) {
		$url->segments = $this->segments->concat($url->segments);
	}
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
	function __toString() { return 'ufront.web.url.filter.DirectoryUrlFilter'; }
}
