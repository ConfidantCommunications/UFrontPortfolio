<?php

class ufront_view_HttpViewEngine extends ufront_view_UFViewEngine {
	public function __construct($cachingEnabled = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($cachingEnabled);
	}}
	public $viewPath;
	public function getTemplateString($relativeViewPath) {
		if(StringTools::startsWith($relativeViewPath, "/")) {
			$relativeViewPath = _hx_substr($relativeViewPath, 1, null);
		}
		$fullPath = _hx_string_or_null(haxe_io_Path::addTrailingSlash($this->viewPath)) . _hx_string_or_null($relativeViewPath);
		try {
			$ft = new tink_core_FutureTrigger();
			$req = new haxe_Http($fullPath);
			$status = -1;
			$req->onStatus = array(new _hx_lambda(array(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status), "ufront_view_HttpViewEngine_0"), 'execute');
			$req->onData = array(new _hx_lambda(array(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status), "ufront_view_HttpViewEngine_1"), 'execute');
			$req->onError = array(new _hx_lambda(array(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status), "ufront_view_HttpViewEngine_2"), 'execute');
			$req->request(null);
			return $ft->future;
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Failed to load template " . _hx_string_or_null($fullPath), $e, _hx_anonymous(array("fileName" => "HttpViewEngine.hx", "lineNumber" => 59, "className" => "ufront.view.HttpViewEngine", "methodName" => "getTemplateString")))));
			}
		}
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
	function __toString() { return 'ufront.view.HttpViewEngine'; }
}
ufront_view_HttpViewEngine::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("viewPath", "String", "viewPath"))))))))));
function ufront_view_HttpViewEngine_0(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status, $st) {
	{
		$status = $st;
	}
}
function ufront_view_HttpViewEngine_1(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status, $data) {
	{
		$result = tink_core_Outcome::Success(haxe_ds_Option::Some($data));
		if($ft->{"list"} === null) {
			false;
		} else {
			$list = $ft->{"list"};
			$ft->{"list"} = null;
			$ft->result = $result;
			tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
			tink_core__Callback_CallbackList_Impl_::clear($list);
			true;
		}
	}
}
function ufront_view_HttpViewEngine_2(&$ft, &$fullPath, &$relativeViewPath, &$req, &$status, $err) {
	{
		if($status === 404) {
			$result1 = tink_core_Outcome::Success(haxe_ds_Option::$None);
			if($ft->{"list"} === null) {
				false;
			} else {
				$list1 = $ft->{"list"};
				$ft->{"list"} = null;
				$ft->result = $result1;
				tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
				tink_core__Callback_CallbackList_Impl_::clear($list1);
				true;
			}
		} else {
			$result2 = tink_core_Outcome::Failure(tink_core_TypedError::withData($status, "Failed to load template " . _hx_string_or_null($fullPath), $err, _hx_anonymous(array("fileName" => "HttpViewEngine.hx", "lineNumber" => 54, "className" => "ufront.view.HttpViewEngine", "methodName" => "getTemplateString"))));
			if($ft->{"list"} === null) {
				false;
			} else {
				$list2 = $ft->{"list"};
				$ft->{"list"} = null;
				$ft->result = $result2;
				tink_core__Callback_CallbackList_Impl_::invoke($list2, $result2);
				tink_core__Callback_CallbackList_Impl_::clear($list2);
				true;
			}
		}
	}
}
