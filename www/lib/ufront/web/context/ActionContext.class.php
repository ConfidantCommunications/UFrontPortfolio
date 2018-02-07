<?php

// Generated by Haxe 3.4.4
class ufront_web_context_ActionContext {
	public function __construct($httpContext) {
		if(!php_Boot::$skip_constructor) {
		ufront_web_HttpError::throwIfNull($httpContext, "httpContext", _hx_anonymous(array("fileName" => "ActionContext.hx", "lineNumber" => 80, "className" => "ufront.web.context.ActionContext", "methodName" => "new")));
		$this->httpContext = $httpContext;
	}}
	public $httpContext;
	public $handler;
	public $controller;
	public $action;
	public $args;
	public $actionResult;
	public $uriParts;
	public function get_uriParts() {
		if($this->uriParts === null) {
			$this->uriParts = _hx_explode("/", $this->httpContext->getRequestUri());
			$tmp = null;
			if($this->uriParts->length > 0) {
				$tmp = $this->uriParts[0] === "";
			} else {
				$tmp = false;
			}
			if($tmp) {
				$this->uriParts->shift();
			}
			$tmp1 = null;
			if($this->uriParts->length > 0) {
				$tmp1 = $this->uriParts[$this->uriParts->length - 1] === "";
			} else {
				$tmp1 = false;
			}
			if($tmp1) {
				$this->uriParts->pop();
			}
		}
		return $this->uriParts;
	}
	public function toString() {
		$tmp = "ActionContext(" . Std::string($this->controller) . ", ";
		$tmp1 = _hx_string_or_null($tmp) . _hx_string_or_null($this->action) . ", ";
		return _hx_string_or_null($tmp1) . Std::string($this->args) . ")";
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
	static $__properties__ = array("get_uriParts" => "get_uriParts");
	function __toString() { return $this->toString(); }
}
