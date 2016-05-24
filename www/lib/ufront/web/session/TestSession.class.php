<?php

class ufront_web_session_TestSession implements ufront_web_session_UFHttpSession{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->map = new haxe_ds_StringMap();
		$this->id = ufront_core_Uuid::create();
	}}
	public $id;
	public $map;
	public function setExpiry($e) {}
	public function init() {
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
	public function commit() {
		return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Success(tink_core_Noise::$Noise));
	}
	public function triggerCommit() {}
	public function isActive() {
		return true;
	}
	public function isReady() {
		return true;
	}
	public function get($name) {
		return $this->map->get($name);
	}
	public function set($name, $value) {
		$v = $value;
		$this->map->set($name, $v);
		$v;
	}
	public function exists($name) {
		return $this->map->exists($name);
	}
	public function remove($name) {
		$this->map->remove($name);
	}
	public function clear() {
		if(null == $this->map) throw new HException('null iterable');
		$__hx__it = $this->map->keys();
		while($__hx__it->hasNext()) {
			unset($key);
			$key = $__hx__it->next();
			$this->map->remove($key);
		}
	}
	public function regenerateID() {}
	public function close() {}
	public function get_id() {
		return $this->id;
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
	static $__properties__ = array("get_id" => "get_id");
	function __toString() { return 'ufront.web.session.TestSession'; }
}
