<?php

class api_TestApi extends ufront_api_UFApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function test($param) {
		$param = "" . _hx_string_or_null($param) . " (server)";
		return ufront_core_SurpriseTools::asGoodSurprise($param);
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'api.TestApi'; }
}
api_TestApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("asyncApi" => (new _hx_array(array("api.AsyncTestApi"))))), "fields" => _hx_anonymous(array("test" => _hx_anonymous(array("returnType" => (new _hx_array(array(3)))))))));
