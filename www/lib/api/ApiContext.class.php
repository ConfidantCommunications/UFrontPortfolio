<?php

// Generated by Haxe 3.4.4
class api_ApiContext extends ufront_api_UFApiContext {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public $testApi;
	public $mailApi;
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
	function __toString() { return 'api.ApiContext'; }
}
api_ApiContext::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("testApi", "api.TestApi", ""))), (new _hx_array(array("mailApi", "api.MailApi", "")))))), "apiList" => (new _hx_array(array("api.TestApi", "api.MailApi")))))));
