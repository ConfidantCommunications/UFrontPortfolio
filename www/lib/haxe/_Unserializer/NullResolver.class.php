<?php

// Generated by Haxe 3.4.4
class haxe__Unserializer_NullResolver {
	public function __construct() {}
	public function resolveClass($name) {
		return null;
	}
	public function resolveEnum($name) {
		return null;
	}
	static $instance;
	static function get_instance() {
		if(haxe__Unserializer_NullResolver::$instance === null) {
			haxe__Unserializer_NullResolver::$instance = new haxe__Unserializer_NullResolver();
		}
		return haxe__Unserializer_NullResolver::$instance;
	}
	static $__properties__ = array("get_instance" => "get_instance");
	function __toString() { return 'haxe._Unserializer.NullResolver'; }
}
