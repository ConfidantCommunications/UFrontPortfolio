<?php

class ufront_core_CallbackTools {
	public function __construct(){}
	static function asVoidSurprise($cb, $pos = null) {
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$cb, &$pos, &$t), "ufront_core_CallbackTools_0"), 'execute')));
		return $t->future;
	}
	static function asSurprise($cb, $pos = null) {
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$cb, &$pos, &$t), "ufront_core_CallbackTools_1"), 'execute')));
		return $t->future;
	}
	static function asSurprisePair($cb, $pos = null) {
		$t = new tink_core_FutureTrigger();
		call_user_func_array($cb, array(array(new _hx_lambda(array(&$cb, &$pos, &$t), "ufront_core_CallbackTools_2"), 'execute')));
		return $t->future;
	}
	function __toString() { return 'ufront.core.CallbackTools'; }
}
function ufront_core_CallbackTools_0(&$cb, &$pos, &$t, $error) {
	{
		if($error !== null) {
			$e = tink_core_TypedError::withData(500, "" . Std::string($error), $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 216, "className" => "ufront.core.CallbackTools", "methodName" => "asVoidSurprise")));
			{
				$result = tink_core_Outcome::Failure($e);
				if($t->{"list"} === null) {
					false;
				} else {
					$list = $t->{"list"};
					$t->{"list"} = null;
					$t->result = $result;
					tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
					tink_core__Callback_CallbackList_Impl_::clear($list);
					true;
				}
			}
		} else {
			$result1 = tink_core_Outcome::Success(tink_core_Noise::$Noise);
			if($t->{"list"} === null) {
				false;
			} else {
				$list1 = $t->{"list"};
				$t->{"list"} = null;
				$t->result = $result1;
				tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
				tink_core__Callback_CallbackList_Impl_::clear($list1);
				true;
			}
		}
	}
}
function ufront_core_CallbackTools_1(&$cb, &$pos, &$t, $error, $val) {
	{
		if($error !== null) {
			$e = tink_core_TypedError::withData(500, "" . Std::string($error), $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 241, "className" => "ufront.core.CallbackTools", "methodName" => "asSurprise")));
			{
				$result = tink_core_Outcome::Failure($e);
				if($t->{"list"} === null) {
					false;
				} else {
					$list = $t->{"list"};
					$t->{"list"} = null;
					$t->result = $result;
					tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
					tink_core__Callback_CallbackList_Impl_::clear($list);
					true;
				}
			}
		} else {
			$result1 = tink_core_Outcome::Success($val);
			if($t->{"list"} === null) {
				false;
			} else {
				$list1 = $t->{"list"};
				$t->{"list"} = null;
				$t->result = $result1;
				tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
				tink_core__Callback_CallbackList_Impl_::clear($list1);
				true;
			}
		}
	}
}
function ufront_core_CallbackTools_2(&$cb, &$pos, &$t, $error, $val1, $val2) {
	{
		if($error !== null) {
			$e = tink_core_TypedError::withData(500, "" . Std::string($error), $pos, _hx_anonymous(array("fileName" => "AsyncTools.hx", "lineNumber" => 266, "className" => "ufront.core.CallbackTools", "methodName" => "asSurprisePair")));
			{
				$result = tink_core_Outcome::Failure($e);
				if($t->{"list"} === null) {
					false;
				} else {
					$list = $t->{"list"};
					$t->{"list"} = null;
					$t->result = $result;
					tink_core__Callback_CallbackList_Impl_::invoke($list, $result);
					tink_core__Callback_CallbackList_Impl_::clear($list);
					true;
				}
			}
		} else {
			$result1 = tink_core_Outcome::Success(new tink_core_MPair($val1, $val2));
			if($t->{"list"} === null) {
				false;
			} else {
				$list1 = $t->{"list"};
				$t->{"list"} = null;
				$t->result = $result1;
				tink_core__Callback_CallbackList_Impl_::invoke($list1, $result1);
				tink_core__Callback_CallbackList_Impl_::clear($list1);
				true;
			}
		}
	}
}
