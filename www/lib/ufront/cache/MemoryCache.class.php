<?php

class ufront_cache_MemoryCache implements ufront_cache_UFCacheSync, ufront_cache_UFCache{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->map = new haxe_ds_StringMap();
	}}
	public $map;
	public function getSync($id) {
		if($this->map->exists($id)) {
			return tink_core_Outcome::Success($this->map->get($id));
		} else {
			return tink_core_Outcome::Failure(ufront_cache_CacheError::$ENotInCache);
		}
	}
	public function setSync($id, $value) {
		return tink_core_Outcome::Success(ufront_cache_MemoryCache_0($this, $id, $value));
	}
	public function getOrSetSync($id, $fn = null) {
		if($this->map->exists($id)) {
			return tink_core_Outcome::Success($this->map->get($id));
		} else {
			return tink_core_Outcome::Success(ufront_cache_MemoryCache_1($this, $fn, $id));
		}
	}
	public function removeSync($id) {
		$this->map->remove($id);
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
	public function clearSync() {
		$this->map = new haxe_ds_StringMap();
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
	public function get($id) {
		return tink_core__Future_Future_Impl_::sync($this->getSync($id));
	}
	public function set($id, $value) {
		$_g = $this;
		return tink_core__Future_Future_Impl_::map($value, array(new _hx_lambda(array(&$_g, &$id, &$value), "ufront_cache_MemoryCache_2"), 'execute'), null);
	}
	public function getOrSet($id, $fn = null) {
		$_g = $this;
		if($this->map->exists($id)) {
			return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success($this->map->get($id)));
		} else {
			return tink_core__Future_Future_Impl_::map(call_user_func($fn), array(new _hx_lambda(array(&$_g, &$fn, &$id), "ufront_cache_MemoryCache_3"), 'execute'), null);
		}
	}
	public function clear() {
		return tink_core__Future_Future_Impl_::sync($this->clearSync());
	}
	public function remove($id) {
		return tink_core__Future_Future_Impl_::sync($this->removeSync($id));
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
	function __toString() { return 'ufront.cache.MemoryCache'; }
}
function ufront_cache_MemoryCache_0(&$__hx__this, &$id, &$value) {
	{
		$__hx__this->map->set($id, $value);
		return $value;
	}
}
function ufront_cache_MemoryCache_1(&$__hx__this, &$fn, &$id) {
	{
		$v = call_user_func($fn);
		$__hx__this->map->set($id, $v);
		return $v;
	}
}
function ufront_cache_MemoryCache_2(&$_g, &$id, &$value, $v) {
	{
		return tink_core_Outcome::Success(ufront_cache_MemoryCache_4($__hx__this, $_g, $id, $v, $value));
	}
}
function ufront_cache_MemoryCache_3(&$_g, &$fn, &$id, $v) {
	{
		return tink_core_Outcome::Success(ufront_cache_MemoryCache_5($__hx__this, $_g, $fn, $id, $v));
	}
}
function ufront_cache_MemoryCache_4(&$__hx__this, &$_g, &$id, &$v, &$value) {
	{
		$_g->map->set($id, $v);
		return $v;
	}
}
function ufront_cache_MemoryCache_5(&$__hx__this, &$_g, &$fn, &$id, &$v) {
	{
		$_g->map->set($id, $v);
		return $v;
	}
}
