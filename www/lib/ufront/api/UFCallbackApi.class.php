<?php

class ufront_api_UFCallbackApi {
	public function __construct() {}
	public $className;
	public $api;
	public function _makeApiCall($method, $args, $flags, $onResult, $onError = null) {
		if(!php_Boot::$skip_constructor) {
		$_g = $this;
		if($this->className === null) {
			$this->className = Type::getClassName(Type::getClass($this));
		}
		$remotingCallString = "" . _hx_string_or_null($this->className) . "." . _hx_string_or_null($method) . "(" . _hx_string_or_null($args->join(",")) . ")";
		$callApi = array(new _hx_lambda(array(&$_g, &$args, &$flags, &$method, &$onError, &$onResult, &$remotingCallString), "ufront_api_UFCallbackApi_0"), 'execute');
		$processError = array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$remotingCallString), "ufront_api_UFCallbackApi_1"), 'execute');
		if($onError === null) {
			$onError = array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$processError, &$remotingCallString), "ufront_api_UFCallbackApi_2"), 'execute');
		}
		if(($flags & 1 << ufront_api_ApiReturnType::$ARTVoid->index) !== 0) {
			try {
				call_user_func($callApi);
				$onResult(null);
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e1 = $_ex_;
				{
					call_user_func_array($processError, array($e1));
				}
			}
		} else {
			if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0 && ($flags & 1 << ufront_api_ApiReturnType::$ARTOutcome->index) !== 0) {
				try {
					$surprise = call_user_func($callApi);
					$surprise(array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$processError, &$remotingCallString, &$surprise), "ufront_api_UFCallbackApi_3"), 'execute'));
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e2 = $_ex_;
					{
						call_user_func_array($processError, array($e2));
					}
				}
			} else {
				if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0) {
					try {
						$future = call_user_func($callApi);
						$future(array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$future, &$method, &$onError, &$onResult, &$processError, &$remotingCallString), "ufront_api_UFCallbackApi_4"), 'execute'));
					}catch(Exception $__hx__e) {
						$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
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
								$data4 = _hx_deref($outcome)->params[0];
								$onResult($data4);
							}break;
							case 1:{
								$err2 = _hx_deref($outcome)->params[0];
								{
									$data5 = ufront_remoting_RemotingError::RApiFailure($remotingCallString, $err2);
									$onError($data5);
								}
							}break;
							}
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e4 = $_ex_;
							{
								call_user_func_array($processError, array($e4));
							}
						}
					} else {
						try {
							$result1 = call_user_func($callApi);
							$onResult($result1);
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e5 = $_ex_;
							{
								call_user_func_array($processError, array($e5));
							}
						}
					}
				}
			}
		}
	}}
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
function ufront_api_UFCallbackApi_0(&$_g, &$args, &$flags, &$method, &$onError, &$onResult, &$remotingCallString) {
	{
		return Reflect::callMethod($_g->api, Reflect::field($_g->api, $method), $args);
	}
}
function ufront_api_UFCallbackApi_1(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$remotingCallString, $e) {
	{
		$stack = haxe_CallStack::toString(haxe_CallStack::exceptionStack());
		{
			$data = ufront_remoting_RemotingError::RServerSideException($remotingCallString, $e, $stack);
			$onError($data);
		}
	}
}
function ufront_api_UFCallbackApi_2(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$processError, &$remotingCallString, $err) {
	{}
}
function ufront_api_UFCallbackApi_3(&$_g, &$args, &$callApi, &$flags, &$method, &$onError, &$onResult, &$processError, &$remotingCallString, &$surprise, $result) {
	{
		switch($result->index) {
		case 0:{
			$data1 = _hx_deref($result)->params[0];
			$onResult($data1);
		}break;
		case 1:{
			$err1 = _hx_deref($result)->params[0];
			{
				$data2 = ufront_remoting_RemotingError::RApiFailure($remotingCallString, $err1);
				$onError($data2);
			}
		}break;
		}
	}
}
function ufront_api_UFCallbackApi_4(&$_g, &$args, &$callApi, &$flags, &$future, &$method, &$onError, &$onResult, &$processError, &$remotingCallString, $data3) {
	{
		$onResult($data3);
	}
}
