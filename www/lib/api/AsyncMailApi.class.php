<?php

// Generated by Haxe 3.4.4
class api_AsyncMailApi extends ufront_api_UFAsyncApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function doMail($recaptchaResult, $address, $name, $message) {
		$this1 = 3;
		return $this->_makeApiCall("doMail", (new _hx_array(array($recaptchaResult, $address, $name, $message))), $this1, _hx_anonymous(array("methodName" => "doMail", "lineNumber" => 0, "customParams" => null, "fileName" => "src/api/MailApi.hx", "className" => "AsyncMailApi")));
	}
	public function injectApi($injector) {
		$tmp = null;
		try {
			$tmp = $injector->getValueForType("api.MailApi", null);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$tmp1 = "Failed to inject " . _hx_string_or_null(Type::getClassName(_hx_qtype("api.MailApi"))) . " into ";
				$tmp2 = _hx_string_or_null($tmp1) . _hx_string_or_null(Type::getClassName(Type::getClass($this)));
				throw new HException(ufront_web_HttpError::internalServerError($tmp2, $e, _hx_anonymous(array("fileName" => "ApiMacros.hx", "lineNumber" => 272, "className" => "api.AsyncMailApi", "methodName" => "injectApi"))));
			}
		}
		$this->api = $tmp;
		$this->className = "api.MailApi";
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static function _getClass() {
		return _hx_qtype("api.MailApi");
	}
	function __toString() { return 'api.AsyncMailApi'; }
}
api_AsyncMailApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("injectApi", "minject.Injector", "", ""))))))))));
