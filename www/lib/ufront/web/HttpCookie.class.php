<?php

class ufront_web_HttpCookie {
	public function __construct($name, $value, $expires = null, $domain = null, $path = null, $secure = null, $httpOnly = null) {
		if(!php_Boot::$skip_constructor) {
		if($httpOnly === null) {
			$httpOnly = false;
		}
		if($secure === null) {
			$secure = false;
		}
		$this->name = $name;
		$this->value = $value;
		$this->expires = $expires;
		$this->domain = $domain;
		$this->path = $path;
		$this->secure = $secure;
		$this->httpOnly = $httpOnly;
	}}
	public $domain;
	public $expires;
	public $name;
	public $path;
	public $secure;
	public $httpOnly;
	public $value;
	public function expireNow() {
		$this->expires = Date::fromTime(0);
	}
	public function toString() {
		return "" . _hx_string_or_null($this->name) . ": " . _hx_string_or_null($this->get_description());
	}
	public function get_description() {
		$buf = new StringBuf();
		$buf->add($this->value);
		if($this->expires !== null) {
			if(ufront_web_HttpCookie::$tzOffset === null) {
				ufront_web_HttpCookie::$tzOffset = intval(date('Z', $this->expires->__t));;
			}
			$gmtExpires = Date::fromTime($this->expires->getTime() + ufront_web_HttpCookie::$tzOffset);
			$zeroPad = array(new _hx_lambda(array(&$buf, &$gmtExpires), "ufront_web_HttpCookie_0"), 'execute');
			$day = ufront_web_HttpCookie::$dayNames[$gmtExpires->getDay()];
			$date = call_user_func_array($zeroPad, array($gmtExpires->getDate()));
			$month = ufront_web_HttpCookie::$monthNames[$gmtExpires->getMonth()];
			$year = $gmtExpires->getFullYear();
			$hour = call_user_func_array($zeroPad, array($gmtExpires->getHours()));
			$minute = call_user_func_array($zeroPad, array($gmtExpires->getMinutes()));
			$second = call_user_func_array($zeroPad, array($gmtExpires->getSeconds()));
			$dateStr = "" . _hx_string_or_null($day) . ", " . _hx_string_or_null($date) . "-" . _hx_string_or_null($month) . "-" . _hx_string_rec($year, "") . " " . _hx_string_or_null($hour) . ":" . _hx_string_or_null($minute) . ":" . _hx_string_or_null($second) . " GMT";
			ufront_web_HttpCookie::addPair($buf, "expires", $dateStr, null);
		}
		ufront_web_HttpCookie::addPair($buf, "domain", $this->domain, null);
		ufront_web_HttpCookie::addPair($buf, "path", $this->path, null);
		if($this->secure) {
			ufront_web_HttpCookie::addPair($buf, "secure", null, true);
		}
		return $buf->b;
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
	static $dayNames;
	static $monthNames;
	static $tzOffset;
	static function addPair($buf, $name, $value = null, $allowNullValue = null) {
		if($allowNullValue === null) {
			$allowNullValue = false;
		}
		if(!$allowNullValue && null === $value) {
			return;
		}
		$buf->add("; ");
		$buf->add($name);
		if(null === $value) {
			return;
		}
		$buf->add("=");
		$buf->add($value);
	}
	static $__properties__ = array("get_description" => "get_description");
	function __toString() { return $this->toString(); }
}
ufront_web_HttpCookie::$dayNames = (new _hx_array(array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat")));
ufront_web_HttpCookie::$monthNames = (new _hx_array(array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")));
function ufront_web_HttpCookie_0(&$buf, &$gmtExpires, $i) {
	{
		$str = "" . _hx_string_rec($i, "");
		while(strlen($str) < 2) {
			$str = "0" . _hx_string_or_null($str);
		}
		return $str;
	}
}
