<?php

class tink_core_TypedError {
	public function __construct($code = null, $message, $pos = null) {
		if(!php_Boot::$skip_constructor) {
		if($code === null) {
			$code = 500;
		}
		$this->code = $code;
		$this->message = $message;
		$this->pos = $pos;
	}}
	public $message;
	public $code;
	public $data;
	public $pos;
	public function printPos() {
		return _hx_string_or_null($this->pos->className) . "." . _hx_string_or_null($this->pos->methodName) . ":" . _hx_string_rec($this->pos->lineNumber, "");
	}
	public function toString() {
		$ret = "Error: " . _hx_string_or_null($this->message);
		if(_hx_field($this, "pos") !== null) {
			$ret .= " " . _hx_string_or_null($this->printPos());
		}
		return $ret;
	}
	public function throwSelf() {
		php_Lib::rethrow($this);
		return $this;
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
	static function withData($code = null, $message, $data, $pos = null) {
		return tink_core_TypedError::typed($code, $message, $data, $pos);
	}
	static function typed($code = null, $message, $data, $pos = null) {
		$ret = new tink_core_TypedError($code, $message, $pos);
		$ret->data = $data;
		return $ret;
	}
	static function catchExceptions($f, $report = null) {
		try {
			return tink_core_Outcome::Success(call_user_func($f));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof tink_core_TypedError){
				return tink_core_Outcome::Failure($e);
			}
			else { $e1 = $_ex_;
			{
				return tink_core_Outcome::Failure((($report === null) ? tink_core_TypedError::withData(null, "Unexpected Error", $e1, _hx_anonymous(array("fileName" => "Error.hx", "lineNumber" => 97, "className" => "tink.core.TypedError", "methodName" => "catchExceptions"))) : call_user_func_array($report, array($e1))));
			}}
		}
	}
	static function reporter($code = null, $message, $pos = null) {
		return array(new _hx_lambda(array(&$code, &$message, &$pos), "tink_core_TypedError_0"), 'execute');
	}
	static function rethrow($any) {
		php_Lib::rethrow($any);
		return $any;
	}
	function __toString() { return $this->toString(); }
}
function tink_core_TypedError_0(&$code, &$message, &$pos, $e) {
	{
		return tink_core_TypedError::withData($code, $message, $e, $pos);
	}
}
