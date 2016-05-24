<?php

class ufront_core__CaseInsensitiveMultiValueMap_CaseInsensitiveMultiValueMap_Impl_ {
	public function __construct(){}
	static function _new() {
		return new haxe_ds_StringMap();
	}
	static function exists($this1, $name) {
		$name1 = strtolower($name);
		return $this1->exists($name1);
	}
	static function getAll($this1, $name) {
		return ufront_core__MultiValueMap_MultiValueMap_Impl_::getAll($this1, strtolower($name));
	}
	static function get($this1, $name) {
		return ufront_core__MultiValueMap_MultiValueMap_Impl_::get($this1, strtolower($name));
	}
	static function set($this1, $name, $value) {
		ufront_core__MultiValueMap_MultiValueMap_Impl_::set($this1, strtolower($name), $value);
	}
	static function add($this1, $name, $value) {
		ufront_core__MultiValueMap_MultiValueMap_Impl_::add($this1, strtolower($name), $value);
	}
	static function remove($this1, $key) {
		$key1 = strtolower($key);
		return $this1->remove($key1);
	}
	static function hclone($this1) {
		return ufront_core__MultiValueMap_MultiValueMap_Impl_::hclone($this1);
	}
	function __toString() { return 'ufront.core._CaseInsensitiveMultiValueMap.CaseInsensitiveMultiValueMap_Impl_'; }
}
