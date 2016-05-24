<?php

class ufront_cache_MemoryCacheConnection implements ufront_cache_UFCacheConnectionSync, ufront_cache_UFCacheConnection{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->caches = new haxe_ds_StringMap();
	}}
	public $caches;
	public function getNamespaceSync($namespace) {
		if($this->caches->exists($namespace)) {
			return $this->caches->get($namespace);
		} else {
			$v = new ufront_cache_MemoryCache();
			$this->caches->set($namespace, $v);
			return $v;
		}
	}
	public function getNamespace($namespace) {
		return $this->getNamespaceSync($namespace);
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
	function __toString() { return 'ufront.cache.MemoryCacheConnection'; }
}
