<?php

class ufront_remoting_RemotingUtil {
	public function __construct(){}
	static function processResponse($response, $onResult, $errorHandler, $remotingCallString) {
		$ret = null;
		$stack = null;
		$hxrFound = false;
		$errors = (new _hx_array(array()));
		$onError = ufront_remoting_RemotingUtil::wrapErrorHandler($errorHandler);
		if(_hx_substr($response, 0, 2) !== "hx") {
			call_user_func_array($onError, array(ufront_remoting_RemotingError::RNoRemotingResult($remotingCallString, $response)));
		} else {
			$_g = 0;
			$_g1 = _hx_explode("\x0A", $response);
			while($_g < $_g1->length) {
				$line = $_g1[$_g];
				++$_g;
				if($line === "") {
					continue;
				}
				{
					$_g2 = _hx_substr($line, 0, 3);
					switch($_g2) {
					case "hxr":{
						$s = new ufront_remoting_RemotingUnserializer(_hx_substr($line, 3, null), null);
						try {
							$ret = $s->unserialize();
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e = $_ex_;
							{
								$ret = $errors->push(ufront_remoting_RemotingError::RUnserializeFailed($remotingCallString, _hx_substr($line, 3, null), "" . Std::string($e)));
							}
						}
						$hxrFound = true;
					}break;
					case "hxt":{
						$s1 = new ufront_remoting_RemotingUnserializer(_hx_substr($line, 3, null), null);
						$m = null;
						try {
							$m = $s1->unserialize();
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e1 = $_ex_;
							{
								$m = $errors->push(ufront_remoting_RemotingError::RUnserializeFailed($remotingCallString, _hx_substr($line, 3, null), "" . Std::string($e1)));
							}
						}
						$m->pos->fileName = "[R]" . _hx_string_or_null($m->pos->fileName);
						haxe_Log::trace("[" . Std::string($m->type) . "]" . Std::string($m->msg), $m->pos);
					}break;
					case "hxs":{
						$s2 = new ufront_remoting_RemotingUnserializer(_hx_substr($line, 3, null), null);
						try {
							$stack = $s2->unserialize();
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e2 = $_ex_;
							{
								$stack = $errors->push(ufront_remoting_RemotingError::RUnserializeFailed($remotingCallString, _hx_substr($line, 3, null), "" . Std::string($e2)));
							}
						}
					}break;
					case "hxe":{
						$s3 = new ufront_remoting_RemotingUnserializer(_hx_substr($line, 3, null), null);
						try {
							$ret = $s3->unserialize();
						}catch(Exception $__hx__e) {
							$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
							$e3 = $_ex_;
							{
								$ret = $errors->push(ufront_remoting_RemotingError::RServerSideException($remotingCallString, $e3, $stack));
							}
						}
					}break;
					default:{
						$errors->push(ufront_remoting_RemotingError::RUnserializeFailed($remotingCallString, $line, "Invalid line in response"));
					}break;
					}
					unset($_g2);
				}
				unset($line);
			}
		}
		if($errors->length === 0) {
			if($hxrFound) {
				try {
					call_user_func_array($onResult, array($ret));
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
					$e4 = $_ex_;
					{
						call_user_func_array($onError, array(ufront_remoting_RemotingError::RClientCallbackException($remotingCallString, $e4)));
					}
				}
			} else {
				call_user_func_array($onError, array(ufront_remoting_RemotingError::RNoRemotingResult($remotingCallString, $response)));
			}
		} else {
			$_g3 = 0;
			while($_g3 < $errors->length) {
				$err = $errors[$_g3];
				++$_g3;
				call_user_func_array($onError, array($err));
				unset($err);
			}
		}
	}
	static function wrapErrorHandler($errorHandler) {
		return array(new _hx_lambda(array(&$errorHandler), "ufront_remoting_RemotingUtil_0"), 'execute');
	}
	static function defaultErrorHandler($error) {
		switch($error->index) {
		case 0:{
			$responseData = _hx_deref($error)->params[2];
			$responseCode = _hx_deref($error)->params[1];
			$remotingCallString = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString) . ": The HTTP Request returned status [" . _hx_string_rec($responseCode, "") . "].", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 125, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace("Returned data: " . _hx_string_or_null($responseData), _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 126, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 1:{
			$err = _hx_deref($error)->params[1];
			$remotingCallString1 = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString1) . ": API or Method is not found or not available in the remoting context.", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 128, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace("Error message: " . _hx_string_or_null($err), _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 129, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 2:{
			$stack = _hx_deref($error)->params[2];
			$e = _hx_deref($error)->params[1];
			$remotingCallString2 = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString2) . ": The server threw an error \"" . Std::string($e) . "\".", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 131, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace($stack, _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 132, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 3:{
			$e1 = _hx_deref($error)->params[1];
			$remotingCallString3 = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString3) . ": The client throw an error \"" . Std::string($e1) . "\" during the remoting callback.", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 134, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace("Compiling with \"-debug\" will prevent this error being caught, so you can use your browser's debugger to collect more information.", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 135, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 4:{
			$err1 = _hx_deref($error)->params[2];
			$troubleLine = _hx_deref($error)->params[1];
			$remotingCallString4 = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString4) . ": Failed to unserialize this line in the response: \"" . _hx_string_or_null($err1) . "\"", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 137, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace("The line that failed: \"" . _hx_string_or_null($err1) . "\"", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 138, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 5:{
			$responseData1 = _hx_deref($error)->params[1];
			$remotingCallString5 = _hx_deref($error)->params[0];
			{
				haxe_Log::trace("Error during remoting call " . _hx_string_or_null($remotingCallString5) . ": No remoting result in data.", _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 140, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
				haxe_Log::trace("Returned data: " . _hx_string_or_null($responseData1), _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 141, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
			}
		}break;
		case 6:{
			$data = _hx_deref($error)->params[1];
			$remotingCallString6 = _hx_deref($error)->params[0];
			haxe_Log::trace("The remoting call " . _hx_string_or_null($remotingCallString6) . " functioned correctly, but the API returned a failure: " . Std::string($data), _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 143, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
		}break;
		case 7:{
			$e2 = _hx_deref($error)->params[0];
			haxe_Log::trace("Unknown error encountered during remoting call: " . Std::string($e2), _hx_anonymous(array("fileName" => "RemotingUtil.hx", "lineNumber" => 145, "className" => "ufront.remoting.RemotingUtil", "methodName" => "defaultErrorHandler")));
		}break;
		}
	}
	function __toString() { return 'ufront.remoting.RemotingUtil'; }
}
function ufront_remoting_RemotingUtil_0(&$errorHandler, $e) {
	{
		if(Std::is($e, _hx_qtype("ufront.remoting.RemotingError"))) {
			call_user_func_array($errorHandler, array($e));
		} else {
			call_user_func_array($errorHandler, array(ufront_remoting_RemotingError::RUnknownException($e)));
		}
	}
}
