<?php

class minject_InjectorMapping {
	public function __construct($type, $name) {
		if(!php_Boot::$skip_constructor) {
		$this->type = $type;
		$this->name = $name;
	}}
	public $type;
	public $name;
	public $injector;
	public $provider;
	public function getValue($injector) {
		if($this->injector !== null) {
			$injector = $this->injector;
		}
		if($this->provider !== null) {
			return $this->provider->getValue($injector);
		}
		$parent = $injector->findMappingForType($this->type, $this->name);
		if($parent !== null) {
			return $parent->getValue($injector);
		}
		return null;
	}
	public function toValue($value) {
		return $this->toProvider(new minject_provider_ValueProvider($value));
	}
	public function _toClass($type) {
		return $this->toProvider(new minject_provider_ClassProvider($type));
	}
	public function _toSingleton($type) {
		return $this->toProvider(new minject_provider_SingletonProvider($type));
	}
	public function asSingleton() {
		return $this->_toSingleton(Type::resolveClass($this->type));
	}
	public function toMapping($mapping) {
		return $this->toProvider(new minject_provider_OtherMappingProvider($mapping));
	}
	public function toProvider($provider) {
		$this->provider = $provider;
		return $this;
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
	function __toString() { return 'minject.InjectorMapping'; }
}
