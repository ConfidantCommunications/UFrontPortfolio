<?php

class ufront_web_HttpError {
	public function __construct(){}
	static function wrap($e, $msg = null, $pos = null) {
		if($msg === null) {
			$msg = "Internal Server Error";
		}
		if(Std::is($e, _hx_qtype("tink.core.TypedError"))) {
			return $e;
		} else {
			return tink_core_TypedError::withData(500, $msg, $e, $pos);
		}
	}
	static function badRequest($reason = null, $pos = null) {
		$message = "Bad Request";
		if($reason !== null) {
			$message .= ": " . _hx_string_or_null($reason);
		}
		return new tink_core_TypedError(400, $message, $pos);
	}
	static function internalServerError($msg = null, $inner = null, $pos = null) {
		if($msg === null) {
			$msg = "Internal Server Error";
		}
		return tink_core_TypedError::withData(500, $msg, $inner, $pos);
	}
	static function methodNotAllowed($pos = null) {
		return new tink_core_TypedError(405, "Method Not Allowed", $pos);
	}
	static function pageNotFound($pos = null) {
		return new tink_core_TypedError(404, "Page Not Found", $pos);
	}
	static function unauthorized($message = null, $pos = null) {
		if($message === null) {
			$message = "Unauthorized Access";
		}
		return new tink_core_TypedError(401, $message, $pos);
	}
	static function unprocessableEntity($pos = null) {
		return new tink_core_TypedError(422, "Unprocessable Entity", $pos);
	}
	static function authError($error, $pos = null) {
		$msg = null;
		switch($error->index) {
		case 0:{
			$msg = "Not Logged In";
		}break;
		case 1:{
			$msg1 = _hx_deref($error)->params[0];
			$msg = "Login Failed: " . _hx_string_or_null($msg1);
		}break;
		case 2:{
			$u = _hx_deref($error)->params[0];
			$msg = "Not Logged In As " . Std::string($u);
		}break;
		case 3:{
			$p = _hx_deref($error)->params[0];
			$msg = "Permission " . Std::string($p) . " denied";
		}break;
		}
		return tink_core_TypedError::typed(401, $msg, $error, $pos);
	}
	static function remotingError($error, $pos = null) {
		switch($error->index) {
		case 0:{
			$responseData = _hx_deref($error)->params[2];
			$responseCode = _hx_deref($error)->params[1];
			$remotingCallString = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed($responseCode, "HTTP " . _hx_string_rec($responseCode, "") . " Error during " . _hx_string_or_null($remotingCallString), $error, $pos);
		}break;
		case 1:{
			$errorMessage = _hx_deref($error)->params[1];
			$remotingCallString1 = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed(404, "Remoting API " . _hx_string_or_null($remotingCallString1) . " not found: " . _hx_string_or_null($errorMessage), $error, $pos);
		}break;
		case 2:{
			$stack = _hx_deref($error)->params[2];
			$e = _hx_deref($error)->params[1];
			$remotingCallString2 = _hx_deref($error)->params[0];
			{
				$errorObj = Std::instance($e, _hx_qtype("tink.core.TypedError"));
				if($errorObj !== null) {
					return tink_core_TypedError::typed($errorObj->code, $errorObj->message, $error, $pos);
				} else {
					return tink_core_TypedError::typed(500, "Internal Server Error while executing " . _hx_string_or_null($remotingCallString2), $error, $pos);
				}
			}
		}break;
		case 3:{
			$e1 = _hx_deref($error)->params[1];
			$remotingCallString3 = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed(500, "Error during callback after " . _hx_string_or_null($remotingCallString3) . ": " . Std::string($e1), $error, $pos);
		}break;
		case 4:{
			$err = _hx_deref($error)->params[2];
			$troubleLine = _hx_deref($error)->params[1];
			$remotingCallString4 = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed(422, "Remoting serialization failed for call " . _hx_string_or_null($remotingCallString4) . ": could not process " . _hx_string_or_null($troubleLine), $error, $pos);
		}break;
		case 5:{
			$responseData1 = _hx_deref($error)->params[1];
			$remotingCallString5 = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed(500, "Error with response for " . _hx_string_or_null($remotingCallString5) . ": no remoting response found", $error, $pos);
		}break;
		case 6:{
			$data = _hx_deref($error)->params[1];
			$remotingCallString6 = _hx_deref($error)->params[0];
			if(Std::is($data, _hx_qtype("tink.core.TypedError"))) {
				$e2 = $data;
				return tink_core_TypedError::typed($e2->code, $e2->message, $error, $e2->pos);
			} else {
				return tink_core_TypedError::typed(500, "Call to " . _hx_string_or_null($remotingCallString6) . " failed: " . Std::string($data), $error, $pos);
			}
		}break;
		case 7:{
			$e3 = _hx_deref($error)->params[0];
			return tink_core_TypedError::typed(500, "Unknown exception during remoting call", $error, $pos);
		}break;
		}
	}
	static function notImplemented($pos = null) {
		$methodName = _hx_string_or_null($pos->className) . "." . _hx_string_or_null($pos->methodName);
		return new tink_core_TypedError(500, "Internal Server Error: " . _hx_string_or_null($methodName) . " is not implemented on this platform", $pos);
	}
	static function abstractMethod($pos = null) {
		$methodName = _hx_string_or_null($pos->className) . "." . _hx_string_or_null($pos->methodName);
		return new tink_core_TypedError(500, "Internal Server Error: " . _hx_string_or_null($methodName) . " is an abstract method and should be overridden by a subclass", $pos);
	}
	static function throwIfNull($val, $name = null, $pos = null) {
		if($name === null) {
			$name = "argument";
		}
		if($val === null) {
			throw new HException(new tink_core_TypedError(500, "" . _hx_string_or_null($name) . " should not be null", $pos));
		}
	}
	static function fakePosition($obj, $method, $args = null) {
		return _hx_anonymous(array("methodName" => $method, "lineNumber" => -1, "fileName" => "", "customParams" => $args, "className" => Type::getClassName(Type::getClass($obj))));
	}
	function __toString() { return 'ufront.web.HttpError'; }
}
