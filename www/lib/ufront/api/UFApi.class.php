<?php

class ufront_api_UFApi {
	public function __construct() {}
	public $auth;
	public $messages;
	public function ufTrace($msg, $pos = null) {
		if(!php_Boot::$skip_constructor) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MTrace)));
	}}
	public function ufLog($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MLog)));
	}
	public function ufWarn($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MWarning)));
	}
	public function ufError($msg, $pos = null) {
		$this->messages->push(_hx_anonymous(array("msg" => $msg, "pos" => $pos, "type" => ufront_log_MessageType::$MError)));
	}
	public function toString() {
		return Type::getClassName(Type::getClass($this));
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
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return $this->toString(); }
}
ufront_api_UFApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("auth", "ufront.auth.UFAuthHandler", ""))), (new _hx_array(array("messages", "ufront.log.MessageList", ""))))))))));
