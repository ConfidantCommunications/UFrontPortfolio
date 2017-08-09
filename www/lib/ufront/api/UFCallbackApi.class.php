<?php

// Generated by Haxe 3.4.2
class ufront_api_UFCallbackApi {
	public function __construct() {
		;
	}
	public $className;
	public $api;
	public function _makeApiCall($method, $args, $flags, $onResult, $onError = null) {
		$_gthis = $this;
		if($this->className === null) {
			$this->className = Type::getClassName(Type::getClass($this));
		}
		$remotingCallString = "" . _hx_string_or_null($this->className) . "." . _hx_string_or_null($method) . "(";
		$remotingCallString1 = _hx_string_or_null($remotingCallString) . _hx_string_or_null($args->join(",")) . ")";
		$callApi = array(new _hx_lambda(array(&$_gthis, &$args, &$method), "ufront_api_UFCallbackApi_0"), 'execute');
		$processError = array(new _hx_lambda(array(&$onError, &$remotingCallString1), "ufront_api_UFCallbackApi_1"), 'execute');
		if($onError === null) {
			$onError = array(new _hx_lambda(array(), "ufront_api_UFCallbackApi_2"), 'execute');
		}
		if(($flags & 1 << ufront_api_ApiReturnType::$ARTVoid->index) !== 0) {
			try {
				call_user_func($callApi);
				call_user_func_array($onResult, array(null));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
				$e1 = $_ex_;
				{
					call_user_func_array($processError, array($e1));
				}
			}
		} else {
			$tmp = null;
			if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0) {
				$tmp = ($flags & 1 << ufront_api_ApiReturnType::$ARTOutcome->index) !== 0;
			} else {
				$tmp = false;
			}
			if($tmp) {
				try {
					$surprise = call_user_func($callApi);
					call_user_func_array($surprise, array(array(new _hx_lambda(array(&$onError, &$onResult, &$remotingCallString1), "ufront_api_UFCallbackApi_3"), 'execute')));
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
					$e2 = $_ex_;
					{
						call_user_func_array($processError, array($e2));
					}
				}
			} else {
				if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0) {
					try {
						$future = call_user_func($callApi);
						call_user_func_array($future, array(array(new _hx_lambda(array(&$onResult), "ufront_api_UFCallbackApi_4"), 'execute')));
					}catch(Exception $__hx__e) {
						$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
						$e3 = $_ex_;
						{
							call_user_func_array($processError, array($e3));
						}
					}
				} else {
					if(($flags & 1 << ufront_api_ApiReturnType::$ARTOutcome->index) !== 0) {
						try {
							$outcome = call_user_func($callApi);
							switch($outcome->index) {
							case 0:{
								$data2 = _hx_deref($outcome)->params[0];
								call_user_func_array($onResult, array($data2));
							}break;
							case 1:{
								$err2 = _hx_deref($outcome)->params[0];
								call_user_func_array($onError, array(ufront_remoting_RemotingError::RApiFailure($remotingCallString1, $err2)));
							}break;
							}
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
							$e4 = $_ex_;
							{
								call_user_func_array($processError, array($e4));
							}
						}
					} else {
						try {
							$result1 = call_user_func($callApi);
							call_user_func_array($onResult, array($result1));
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
							$e5 = $_ex_;
							{
								call_user_func_array($processError, array($e5));
							}
						}
					}
				}
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
	static function getCallbackApi($syncApi) {
		$meta = haxe_rtti_Meta::getType($syncApi);
		if($meta->callbackApi !== null) {
			$asyncCallbackApiName = $meta->callbackApi[0];
			if($asyncCallbackApiName !== null) {
				return Type::resolveClass($asyncCallbackApiName);
			}
		}
		return null;
	}
	function __toString() { return 'ufront.api.UFCallbackApi'; }
}
function ufront_api_UFCallbackApi_0(&$_gthis, &$args, &$method) {
	{
		$_gthis1 = $_gthis->api;
		$callApi1 = Reflect::field($_gthis->api, $method);
		return Reflect::callMethod($_gthis1, $callApi1, $args);
	}
}
function ufront_api_UFCallbackApi_1(&$onError, &$remotingCallString1, $e) {
	{
		$stack = haxe_CallStack::toString(haxe_CallStack::exceptionStack());
		call_user_func_array($onError, array(ufront_remoting_RemotingError::RServerSideException($remotingCallString1, $e, $stack)));
	}
}
function ufront_api_UFCallbackApi_2($err) {
	{
	}
}
function ufront_api_UFCallbackApi_3(&$onError, &$onResult, &$remotingCallString1, $result) {
	{
		switch($result->index) {
		case 0:{
			$data = _hx_deref($result)->params[0];
			call_user_func_array($onResult, array($data));
		}break;
		case 1:{
			$err1 = _hx_deref($result)->params[0];
			call_user_func_array($onError, array(ufront_remoting_RemotingError::RApiFailure($remotingCallString1, $err1)));
		}break;
		}
	}
}
function ufront_api_UFCallbackApi_4(&$onResult, $data1) {
	{
		call_user_func_array($onResult, array($data1));
	}
}
