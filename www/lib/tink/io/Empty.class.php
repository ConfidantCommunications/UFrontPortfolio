<?php

// Generated by Haxe 3.4.4
class tink_io_Empty extends tink_io_IdealSourceBase {
	public function __construct() {}
	public function readSafely($into, $max = null) {
		if($max === null) {
			$max = 268435456;
		}
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(-1));
	}
	public function closeSafely() {
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Noise::$Noise));
	}
	public function toString() {
		return "[Empty source]";
	}
	static $instance;
	function __toString() { return $this->toString(); }
}
tink_io_Empty::$instance = new tink_io_Empty();
