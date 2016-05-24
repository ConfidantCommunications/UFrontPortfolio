<?php

class ufront_core__ClassRef_ClassRef_Impl_ {
	public function __construct(){}
	static function _new($className) {
		return $className;
	}
	static function toString($this1) {
		return $this1;
	}
	static function toClass($this1) {
		return Type::resolveClass($this1);
	}
	static function fromClass($v) {
		$className = Type::getClassName($v);
		return $className;
	}
	static function fromClassName($className) {
		return $className;
	}
	function __toString() { return 'ufront.core._ClassRef.ClassRef_Impl_'; }
}
