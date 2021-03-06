<?php

// Generated by Haxe 3.4.4
class sys_ufront_web_context_HttpResponse extends ufront_web_context_HttpResponse {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function flush() {
		if(!$this->_flushedStatus) {
			$this->_flushedStatus = true;
			php_Web::setReturnCode($this->status);
		}
		if(!$this->_flushedCookies) {
			$this->_flushedCookies = true;
			try {
				$cookie = $this->_cookies->iterator();
				while($cookie->hasNext()) {
					$cookie1 = $cookie->next();
					php_Web::setCookie($cookie1->name, $cookie1->value, $cookie1->expires, $cookie1->domain, $cookie1->path, $cookie1->secure, $cookie1->httpOnly);
					unset($cookie1);
				}
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					throw new HException(ufront_web_HttpError::internalServerError("Failed to set cookie on response", $e, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 34, "className" => "sys.ufront.web.context.HttpResponse", "methodName" => "flush"))));
				}
			}
		}
		if(!$this->_flushedHeaders) {
			$this->_flushedHeaders = true;
			{
				$key = $this->_headers->keys();
				while($key->hasNext()) {
					$key1 = $key->next();
					$val = $this->_headers->get($key1);
					$tmp = null;
					$tmp1 = null;
					if($key1 === "Content-type") {
						$tmp1 = null !== $this->charset;
					} else {
						$tmp1 = false;
					}
					if($tmp1) {
						if($val !== "application/json") {
							$tmp = StringTools::startsWith($val, "text/");
						} else {
							$tmp = true;
						}
					} else {
						$tmp = false;
					}
					if($tmp) {
						$val = _hx_string_or_null($val) . _hx_string_or_null(("; charset=" . _hx_string_or_null($this->charset)));
					}
					try {
						header(_hx_string_or_null($key1) . ": " . _hx_string_or_null($val));
					}catch(Exception $__hx__e) {
						$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
						$e1 = $_ex_;
						{
							throw new HException(ufront_web_HttpError::internalServerError("Invalid header: \"" . _hx_string_or_null($key1) . ": " . _hx_string_or_null($val) . "\", or output already sent", $e1, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 50, "className" => "sys.ufront.web.context.HttpResponse", "methodName" => "flush"))));
						}
					}
					unset($val,$tmp1,$tmp,$key1,$e1);
				}
			}
		}
		if(!$this->_flushedContent) {
			$this->_flushedContent = true;
			Sys::hprint($this->_buff->b);
		}
	}
	static $__properties__ = array("set_redirectLocation" => "set_redirectLocation","get_redirectLocation" => "get_redirectLocation","set_contentType" => "set_contentType","get_contentType" => "get_contentType");
	function __toString() { return 'sys.ufront.web.context.HttpResponse'; }
}
