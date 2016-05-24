<?php

class tink_core_OutcomeTools {
	public function __construct(){}
	static function sure($outcome) {
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return $data;
		}break;
		case 1:{
			$failure = _hx_deref($outcome)->params[0];
			if(Std::is($failure, _hx_qtype("tink.core.TypedError"))) {
				return $failure->throwSelf();
			} else {
				throw new HException($failure);
			}
		}break;
		}
	}
	static function toOption($outcome) {
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return haxe_ds_Option::Some($data);
		}break;
		case 1:{
			return haxe_ds_Option::$None;
		}break;
		}
	}
	static function toOutcome($option, $pos = null) {
		switch($option->index) {
		case 0:{
			$value = _hx_deref($option)->params[0];
			return tink_core_Outcome::Success($value);
		}break;
		case 1:{
			return tink_core_Outcome::Failure(new tink_core_TypedError(404, "Some value expected but none found in " . _hx_string_or_null($pos->fileName) . "@line " . _hx_string_rec($pos->lineNumber, ""), _hx_anonymous(array("fileName" => "Outcome.hx", "lineNumber" => 37, "className" => "tink.core.OutcomeTools", "methodName" => "toOutcome"))));
		}break;
		}
	}
	static function orNull($outcome) {
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return $data;
		}break;
		case 1:{
			return null;
		}break;
		}
	}
	static function orUse($outcome, $fallback) {
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return $data;
		}break;
		case 1:{
			return $fallback();
		}break;
		}
	}
	static function orTry($outcome, $fallback) {
		switch($outcome->index) {
		case 0:{
			return $outcome;
		}break;
		case 1:{
			return $fallback();
		}break;
		}
	}
	static function equals($outcome, $to) {
		switch($outcome->index) {
		case 0:{
			$data = _hx_deref($outcome)->params[0];
			return (is_object($_t = $data) && !($_t instanceof Enum) ? $_t === $to : $_t == $to);
		}break;
		case 1:{
			return false;
		}break;
		}
	}
	static function map($outcome, $transform) {
		switch($outcome->index) {
		case 0:{
			$a = _hx_deref($outcome)->params[0];
			return tink_core_Outcome::Success(call_user_func_array($transform, array($a)));
		}break;
		case 1:{
			$f = _hx_deref($outcome)->params[0];
			return tink_core_Outcome::Failure($f);
		}break;
		}
	}
	static function isSuccess($outcome) {
		switch($outcome->index) {
		case 0:{
			return true;
		}break;
		default:{
			return false;
		}break;
		}
	}
	static function flatMap($o, $mapper) {
		return tink_core__Outcome_OutcomeMapper_Impl_::apply($mapper, $o);
	}
	static function attempt($f, $report) {
		try {
			return tink_core_Outcome::Success(call_user_func($f));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return tink_core_Outcome::Failure(call_user_func_array($report, array($e)));
			}
		}
	}
	function __toString() { return 'tink.core.OutcomeTools'; }
}
