<?php

class api_AsyncTestApi extends ufront_api_UFAsyncApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function getJson($path) {
		return $this->_makeApiCall("getJson", (new _hx_array(array($path))), 3, _hx_anonymous(array("methodName" => "getJson", "lineNumber" => 0, "customParams" => null, "fileName" => "src/api/TestApi.hx", "className" => "AsyncTestApi")));
	}
	public function getItem($id) {
		return $this->_makeApiCall("getItem", (new _hx_array(array($id))), 3, _hx_anonymous(array("methodName" => "getItem", "lineNumber" => 0, "customParams" => null, "fileName" => "src/api/TestApi.hx", "className" => "AsyncTestApi")));
	}
	public function injectApi($injector) {
		try {
			$this->api = $injector->getValueForType("api.TestApi", null);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				throw new HException(ufront_web_HttpError::internalServerError("Failed to inject " . _hx_string_or_null(Type::getClassName(_hx_qtype("api.TestApi"))) . " into " . _hx_string_or_null(Type::getClassName(Type::getClass($this))), $e, _hx_anonymous(array("fileName" => "ApiMacros.hx", "lineNumber" => 269, "className" => "api.AsyncTestApi", "methodName" => "injectApi"))));
			}
		}
		$this->className = "api.TestApi";
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static function _getClass() {
		return _hx_qtype("api.TestApi");
	}
	function __toString() { return 'api.AsyncTestApi'; }
}
api_AsyncTestApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("injectApi", "minject.Injector", "", ""))))))))));
