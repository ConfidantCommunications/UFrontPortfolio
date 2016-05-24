<?php

class ufront_api_UFAsyncApi {
	public function __construct() {}
	public $className;
	public $api;
	public function _makeApiCall($method, $args, $flags, $pos = null) {
		if(!php_Boot::$skip_constructor) {
		$_g = $this;
		$remotingCallString = "" . _hx_string_or_null($this->className) . "." . _hx_string_or_null($method) . "(" . _hx_string_or_null($args->join(",")) . ")";
		$callApi = array(new _hx_lambda(array(&$_g, &$args, &$flags, &$method, &$pos, &$remotingCallString), "ufront_api_UFAsyncApi_0"), 'execute');
		$returnError = array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$method, &$pos, &$remotingCallString), "ufront_api_UFAsyncApi_1"), 'execute');
		if(($flags & 1 << ufront_api_ApiReturnType::$ARTVoid->index) !== 0) {
			try {
				call_user_func($callApi);
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(null));
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e1 = $_ex_;
				{
					return call_user_func_array($returnError, array($e1));
				}
			}
		} else {
			if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0 && ($flags & 1 << ufront_api_ApiReturnType::$ARTOutcome->index) !== 0) {
				try {
					$surprise = call_user_func($callApi);
					return tink_core__Future_Future_Impl_::map($surprise, array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$method, &$pos, &$remotingCallString, &$returnError, &$surprise), "ufront_api_UFAsyncApi_2"), 'execute'), null);
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e2 = $_ex_;
					{
						return call_user_func_array($returnError, array($e2));
					}
				}
			} else {
				if(($flags & 1 << ufront_api_ApiReturnType::$ARTFuture->index) !== 0) {
					try {
						$future = call_user_func($callApi);
						return tink_core__Future_Future_Impl_::map($future, array(new _hx_lambda(array(&$_g, &$args, &$callApi, &$flags, &$future, &$method, &$pos, &$remotingCallString, &$returnError), "ufront_api_UFAsyncApi_3"), 'execute'), null);
					}catch(Exception $__hx__e) {
						$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
						$e3 = $_ex_;
						{
							return call_user_func_array($returnError, array($e3));
						}
					}
				} else {
					if(($flags & 1 << ufront_api_ApiReturnType::$ARTOutcome->index) !== 0) {
						try {
							$outcome = call_user_func($callApi);
							switch($outcome->index) {
							case 0:{
								$data2 = _hx_deref($outcome)->params[0];
								return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($data2));
							}break;
							case 1:{
								$err1 = _hx_deref($outcome)->params[0];
								return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(ufront_web_HttpError::remotingError(ufront_remoting_RemotingError::RApiFailure($remotingCallString, $err1), $pos)));
							}break;
							}
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e4 = $_ex_;
							{
								return call_user_func_array($returnError, array($e4));
							}
						}
					} else {
						try {
							$result1 = call_user_func($callApi);
							return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($result1));
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e5 = $_ex_;
							{
								return call_user_func_array($returnError, array($e5));
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
	static function getAsyncApi($syncApi) {
		$meta = haxe_rtti_Meta::getType($syncApi);
		if($meta->asyncApi !== null) {
			$asyncApiName = $meta->asyncApi[0];
			if($asyncApiName !== null) {
				return Type::resolveClass($asyncApiName);
			}
		}
		return null;
	}
	function __toString() { return 'ufront.api.UFAsyncApi'; }
}
function ufront_api_UFAsyncApi_0(&$_g, &$args, &$flags, &$method, &$pos, &$remotingCallString) {
	{
		return Reflect::callMethod($_g->api, Reflect::field($_g->api, $method), $args);
	}
}
function ufront_api_UFAsyncApi_1(&$_g, &$args, &$callApi, &$flags, &$method, &$pos, &$remotingCallString, $e) {
	{
		$stack = haxe_CallStack::toString(haxe_CallStack::exceptionStack());
		$remotingError = ufront_remoting_RemotingError::RServerSideException($remotingCallString, $e, $stack);
		return ufront_core_SurpriseTools::asBadSurprise(ufront_web_HttpError::remotingError($remotingError, $pos));
	}
}
function ufront_api_UFAsyncApi_2(&$_g, &$args, &$callApi, &$flags, &$method, &$pos, &$remotingCallString, &$returnError, &$surprise, $result) {
	{
		switch($result->index) {
		case 0:{
			$data = _hx_deref($result)->params[0];
			return tink_core_Outcome::Success($data);
		}break;
		case 1:{
			$err = _hx_deref($result)->params[0];
			return tink_core_Outcome::Failure(ufront_web_HttpError::remotingError(ufront_remoting_RemotingError::RApiFailure($remotingCallString, $err), $pos));
		}break;
		}
	}
}
function ufront_api_UFAsyncApi_3(&$_g, &$args, &$callApi, &$flags, &$future, &$method, &$pos, &$remotingCallString, &$returnError, $data1) {
	{
		return tink_core_Outcome::Success($data1);
	}
}
