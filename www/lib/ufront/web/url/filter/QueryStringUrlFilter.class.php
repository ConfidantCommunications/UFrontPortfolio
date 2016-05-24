<?php

class ufront_web_url_filter_QueryStringUrlFilter implements ufront_web_url_filter_UFUrlFilter{
	public function __construct($paramName = null, $frontScript = null, $useCleanRoot = null) {
		if(!php_Boot::$skip_constructor) {
		if($useCleanRoot === null) {
			$useCleanRoot = true;
		}
		if($paramName === null) {
			$paramName = "q";
		}
		if($frontScript === null) {
			$frontScript = "index.php";
		}
		$this->frontScript = $frontScript;
		$this->paramName = $paramName;
		$this->useCleanRoot = $useCleanRoot;
	}}
	public $frontScript;
	public $paramName;
	public $useCleanRoot;
	public function filterIn($url) {
		$_g = $this;
		if($url->segments[0] === $this->frontScript) {
			$param = Lambda::find($url->query, array(new _hx_lambda(array(&$_g, &$url), "ufront_web_url_filter_QueryStringUrlFilter_0"), 'execute'));
			if($param !== null) {
				$value = null;
				if($param->encoded) {
					$value = urldecode($param->value);
				} else {
					$value = $param->value;
				}
				$url->segments = ufront_web_url_PartialUrl::parse($param->value)->segments;
				$url->query->remove($param);
			}
		}
	}
	public function filterOut($url) {
		if($url->isPhysical || $url->segments->length === 0 && $this->useCleanRoot) {} else {
			$path = "/" . _hx_string_or_null($url->segments->join("/"));
			$url->segments = (new _hx_array(array($this->frontScript)));
			$url->query->push(_hx_anonymous(array("name" => $this->paramName, "value" => $path, "encoded" => true)));
		}
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
	function __toString() { return 'ufront.web.url.filter.QueryStringUrlFilter'; }
}
function ufront_web_url_filter_QueryStringUrlFilter_0(&$_g, &$url, $p) {
	{
		return $p->name === $_g->paramName;
	}
}
