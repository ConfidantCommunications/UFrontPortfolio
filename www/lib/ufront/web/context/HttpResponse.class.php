<?php

// Generated by Haxe 3.4.4
class ufront_web_context_HttpResponse {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->clear();
		$this->_flushedStatus = false;
		$this->_flushedCookies = false;
		$this->_flushedHeaders = false;
		$this->_flushedContent = false;
	}}
	public $charset;
	public $status;
	public $_buff;
	public $_headers;
	public $_cookies;
	public $_flushedStatus;
	public $_flushedCookies;
	public $_flushedHeaders;
	public $_flushedContent;
	public function preventFlush() {
		$this->_flushedStatus = true;
		$this->_flushedCookies = true;
		$this->_flushedHeaders = true;
		$this->_flushedContent = true;
	}
	public function preventFlushContent() {
		$this->_flushedContent = true;
	}
	public function flush() {
		throw new HException(ufront_web_HttpError::notImplemented(_hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 141, "className" => "ufront.web.context.HttpResponse", "methodName" => "flush"))));
	}
	public function clear() {
		$this->clearCookies();
		$this->clearHeaders();
		$this->clearContent();
		$this->set_contentType(null);
		$this->charset = "utf-8";
		$this->status = 200;
	}
	public function clearCookies() {
		$this->_cookies = new haxe_ds_StringMap();
	}
	public function clearContent() {
		$this->_buff = new StringBuf();
	}
	public function clearHeaders() {
		$this->_headers = new ufront_core_OrderedStringMap();
	}
	public function write($s) {
		if(null !== $s) {
			$this->_buff->add($s);
		}
	}
	public function writeChar($c) {
		$_this = $this->_buff;
		$_this->b = _hx_string_or_null($_this->b) . _hx_string_or_null(chr($c));
	}
	public function writeBytes($b, $pos, $len) {
		$tmp = $this->_buff;
		$tmp->add($b->getString($pos, $len));
	}
	public function setHeader($name, $value) {
		ufront_web_HttpError::throwIfNull($name, null, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 219, "className" => "ufront.web.context.HttpResponse", "methodName" => "setHeader")));
		ufront_web_HttpError::throwIfNull($value, null, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 220, "className" => "ufront.web.context.HttpResponse", "methodName" => "setHeader")));
		$this->_headers->set($name, $value);
	}
	public function setCookie($cookie) {
		$this->_cookies->set($cookie->name, $cookie);
	}
	public function getBuffer() {
		return $this->_buff->b;
	}
	public function getCookies() {
		return $this->_cookies;
	}
	public function getHeaders() {
		return $this->_headers;
	}
	public function redirect($url) {
		$this->status = 302;
		$this->set_redirectLocation($url);
	}
	public function setOk() {
		$this->status = 200;
	}
	public function setUnauthorized() {
		$this->status = 401;
	}
	public function requireAuthentication($message) {
		$this->setUnauthorized();
		$this->setHeader("WWW-Authenticate", "Basic realm=\"" . _hx_string_or_null($message) . "\"");
	}
	public function setNotFound() {
		$this->status = 404;
	}
	public function setInternalError() {
		$this->status = 500;
	}
	public function permanentRedirect($url) {
		$this->status = 301;
		$this->set_redirectLocation($url);
	}
	public function isRedirect() {
		return Math::floor($this->status / 100) === 3;
	}
	public function isPermanentRedirect() {
		return $this->status === 301;
	}
	public function hxSerialize($s) {
		$s->serialize($this->_buff->b);
		$s->serialize($this->_headers);
		$s->serialize($this->_cookies);
		$s->serialize($this->_flushedStatus);
		$s->serialize($this->_flushedCookies);
		$s->serialize($this->_flushedHeaders);
		$s->serialize($this->_flushedContent);
	}
	public function hxUnserialize($u) {
		$this->_buff = new StringBuf();
		$tmp = $this->_buff;
		$tmp->add($u->unserialize());
		$this->_headers = $u->unserialize();
		$this->_cookies = $u->unserialize();
		$this->_flushedStatus = $u->unserialize();
		$this->_flushedCookies = $u->unserialize();
		$this->_flushedHeaders = $u->unserialize();
		$this->_flushedContent = $u->unserialize();
	}
	public function get_contentType() {
		return $this->_headers->get("Content-type");
	}
	public function set_contentType($v) {
		if(null === $v) {
			$this->_headers->set("Content-type", "text/html");
		} else {
			$this->_headers->set("Content-type", $v);
		}
		return $v;
	}
	public function get_redirectLocation() {
		return $this->_headers->get("Location");
	}
	public function set_redirectLocation($v) {
		if(null === $v) {
			$this->_headers->remove("Location");
		} else {
			$this->_headers->set("Location", $v);
		}
		return $v;
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
	static function create() {
		return new sys_ufront_web_context_HttpResponse();
	}
	static $CONTENT_TYPE = "Content-type";
	static $LOCATION = "Location";
	static $DEFAULT_CONTENT_TYPE = "text/html";
	static $DEFAULT_CHARSET = "utf-8";
	static $DEFAULT_STATUS = 200;
	static $MOVED_PERMANENTLY = 301;
	static $FOUND = 302;
	static $UNAUTHORIZED = 401;
	static $NOT_FOUND = 404;
	static $INTERNAL_SERVER_ERROR = 500;
	static $__properties__ = array("set_redirectLocation" => "set_redirectLocation","get_redirectLocation" => "get_redirectLocation","set_contentType" => "set_contentType","get_contentType" => "get_contentType");
	function __toString() { return 'ufront.web.context.HttpResponse'; }
}
