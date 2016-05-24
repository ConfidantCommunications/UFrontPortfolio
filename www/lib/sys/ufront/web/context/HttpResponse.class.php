<?php

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
				if(null == $this->_cookies) throw new HException('null iterable');
				$__hx__it = $this->_cookies->iterator();
				while($__hx__it->hasNext()) {
					unset($cookie);
					$cookie = $__hx__it->next();
					php_Web::setCookie($cookie->name, $cookie->value, $cookie->expires, $cookie->domain, $cookie->path, $cookie->secure, $cookie->httpOnly);
				}
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					throw new HException(ufront_web_HttpError::internalServerError("Failed to set cookie on response", $e, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 34, "className" => "sys.ufront.web.context.HttpResponse", "methodName" => "flush"))));
				}
			}
		}
		if(!$this->_flushedHeaders) {
			$this->_flushedHeaders = true;
			if(null == $this->_headers) throw new HException('null iterable');
			$__hx__it = $this->_headers->keys();
			while($__hx__it->hasNext()) {
				unset($key);
				$key = $__hx__it->next();
				$val = $this->_headers->get($key);
				if($key === "Content-type" && null !== $this->charset && ($val === "application/json" || StringTools::startsWith($val, "text/"))) {
					$val .= "; charset=" . _hx_string_or_null($this->charset);
				}
				try {
					header(_hx_string_or_null($key) . ": " . _hx_string_or_null($val));
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e1 = $_ex_;
					{
						throw new HException(ufront_web_HttpError::internalServerError("Invalid header: \"" . _hx_string_or_null($key) . ": " . _hx_string_or_null($val) . "\", or output already sent", $e1, _hx_anonymous(array("fileName" => "HttpResponse.hx", "lineNumber" => 50, "className" => "sys.ufront.web.context.HttpResponse", "methodName" => "flush"))));
					}
				}
				unset($val,$e1);
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
