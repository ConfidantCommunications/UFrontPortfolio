<?php

// Generated by Haxe 3.4.4
class tink_core__Future_NeverFuture implements tink_core__Future_FutureObject{
	public function __construct() {}
	public function map($f) {
		return tink_core__Future_NeverFuture::$inst;
	}
	public function flatMap($f) {
		return tink_core__Future_NeverFuture::$inst;
	}
	public function handle($callback) {
		return null;
	}
	public function gather() {
		return tink_core__Future_NeverFuture::$inst;
	}
	public function eager() {
		return tink_core__Future_NeverFuture::$inst;
	}
	static $inst;
	function __toString() { return 'tink.core._Future.NeverFuture'; }
}
tink_core__Future_NeverFuture::$inst = new tink_core__Future_NeverFuture();
