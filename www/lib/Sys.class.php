<?php

// Generated by Haxe 3.4.4
class Sys {
	public function __construct(){}
	static function hprint($v) {
		echo(Std::string($v));
	}
	static function println($v) {
		Sys::hprint($v);
		Sys::hprint("\x0A");
	}
	static function time() {
		return microtime(true);
	}
	function __toString() { return 'Sys'; }
}
