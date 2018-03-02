<?php

// Generated by Haxe 3.4.4
class tink_io__Source_FailedSource extends tink_io_SourceBase {
	public function __construct($error) {
		if(!php_Boot::$skip_constructor) {
		$this->error = $error;
	}}
	public $error;
	public function read($into, $max = null) {
		if($max === null) {
			$max = 1073741824;
		}
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($this->error)));
	}
	public function close() {
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Failure($this->error)));
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
	function __toString() { return 'tink.io._Source.FailedSource'; }
}