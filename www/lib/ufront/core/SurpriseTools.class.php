<?php

class ufront_core_SurpriseTools {
	public function __construct(){}
	static function success() {
		if(ufront_core_SurpriseTools::$s === null) {
			ufront_core_SurpriseTools::$s = tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
		}
		return ufront_core_SurpriseTools::$s;
	}
	static $s;
	static function asSurprise($outcome) {
		return tink_core__Future_Future_Impl_::sync($outcome);
	}
	static function asGoodSurprise($data) {
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($data));
	}
	static function asBadSurprise($err) {
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure($err));
	}
	static function asSurpriseError($err, $msg = null, $p = null) {
		if($msg === null) {
			$msg = "Failure: " . Std::string($err);
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(ufront_web_HttpError::wrap($err, $msg, $p)));
	}
	static function asSurpriseTypedError($err, $msg = null, $p = null) {
		if($msg === null) {
			$msg = "Failure: " . Std::string($err);
		}
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(ufront_web_HttpError::wrap($err, $msg, $p)));
	}
	static function tryCatchSurprise($fn, $msg = null, $p = null) {
		try {
			return ufront_core_SurpriseTools::asGoodSurprise(call_user_func($fn));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return ufront_core_SurpriseTools::asSurpriseError($e, $msg, $p);
			}
		}
	}
	static function changeSuccessTo($s, $newSuccessData) {
		return tink_core__Future_Future_Impl_::map($s, array(new _hx_lambda(array(&$newSuccessData, &$s), "ufront_core_SurpriseTools_0"), 'execute'), null);
	}
	static function changeSuccessToNoise($s) {
		return ufront_core_SurpriseTools::changeSuccessTo($s, tink_core_Noise::$Noise);
	}
	static function changeFailureTo($s, $newFailureData) {
		return tink_core__Future_Future_Impl_::map($s, array(new _hx_lambda(array(&$newFailureData, &$s), "ufront_core_SurpriseTools_1"), 'execute'), null);
	}
	static function changeFailureToError($s, $msg = null, $p = null) {
		return tink_core__Future_Future_Impl_::map($s, array(new _hx_lambda(array(&$msg, &$p, &$s), "ufront_core_SurpriseTools_2"), 'execute'), null);
	}
	static function useFallback($s, $fallback) {
		return tink_core__Future_Future_Impl_::map($s, array(new _hx_lambda(array(&$fallback, &$s), "ufront_core_SurpriseTools_3"), 'execute'), null);
	}
	function __toString() { return 'ufront.core.SurpriseTools'; }
}
function ufront_core_SurpriseTools_0(&$newSuccessData, &$s, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			return tink_core_Outcome::Success($newSuccessData);
		}break;
		case 1:{
			$e = _hx_deref($outcome)->params[0];
			return tink_core_Outcome::Failure($e);
		}break;
		}
	}
}
function ufront_core_SurpriseTools_1(&$newFailureData, &$s, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$d = _hx_deref($outcome)->params[0];
			return tink_core_Outcome::Success($d);
		}break;
		case 1:{
			return tink_core_Outcome::Failure($newFailureData);
		}break;
		}
	}
}
function ufront_core_SurpriseTools_2(&$msg, &$p, &$s, $outcome) {
	{
		switch($outcome->index) {
		case 0:{
			$d = _hx_deref($outcome)->params[0];
			return tink_core_Outcome::Success($d);
		}break;
		case 1:{
			$inner = _hx_deref($outcome)->params[0];
			{
				if($msg === null) {
					$msg = "Failure: " . Std::string($inner);
				}
				return tink_core_Outcome::Failure(ufront_web_HttpError::wrap($inner, $msg, $p));
			}
		}break;
		}
	}
}
function ufront_core_SurpriseTools_3(&$fallback, &$s, $outcome) {
	{
		switch($outcome->index) {
		case 1:{
			return $fallback;
		}break;
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return $data;
		}break;
		}
	}
}
