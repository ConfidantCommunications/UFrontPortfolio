<?php

class ufront_web_url_PartialUrl {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->segments = (new _hx_array(array()));
		$this->query = (new _hx_array(array()));
		$this->fragment = null;
	}}
	public $segments;
	public $query;
	public $fragment;
	public function queryString() {
		$params = (new _hx_array(array()));
		{
			$_g = 0;
			$_g1 = $this->query;
			while($_g < $_g1->length) {
				$param = $_g1[$_g];
				++$_g;
				$value = null;
				if($param->encoded) {
					$value = $param->value;
				} else {
					$value = rawurlencode($param->value);
				}
				$params->push(_hx_string_or_null($param->name) . "=" . _hx_string_or_null($value));
				unset($value,$param);
			}
		}
		return $params->join("&");
	}
	public function toString() {
		$url = "/" . _hx_string_or_null($this->segments->join("/"));
		$qs = $this->queryString();
		if(strlen($qs) > 0) {
			$url .= "?" . _hx_string_or_null($qs);
		}
		if(null !== $this->fragment) {
			$url .= "#" . _hx_string_or_null($this->fragment);
		}
		return $url;
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
	static function parse($url) {
		$u = new ufront_web_url_PartialUrl();
		ufront_web_url_PartialUrl::feed($u, $url);
		return $u;
	}
	static function feed($u, $url) {
		$parts = _hx_explode("#", $url);
		if($parts->length > 1) {
			$u->fragment = $parts[1];
		}
		$parts = _hx_explode("?", $parts[0]);
		if($parts->length > 1) {
			$pairs = _hx_explode("&", $parts[1]);
			{
				$_g = 0;
				while($_g < $pairs->length) {
					$s = $pairs[$_g];
					++$_g;
					$pair = _hx_explode("=", $s);
					$u->query->push(_hx_anonymous(array("name" => $pair[0], "value" => $pair[1], "encoded" => true)));
					unset($s,$pair);
				}
			}
		}
		$segments = _hx_explode("/", $parts[0]);
		if($segments[0] === "") {
			$segments->shift();
		}
		if($segments->length === 1 && $segments[0] === "") {
			$segments->pop();
		}
		$u->segments = $segments;
	}
	function __toString() { return $this->toString(); }
}
