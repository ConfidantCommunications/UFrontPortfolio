<?php

class minject_provider_OtherMappingProvider implements minject_provider_DependencyProvider{
	public function __construct($mapping) {
		if(!php_Boot::$skip_constructor) {
		$this->mapping = $mapping;
	}}
	public $mapping;
	public function getValue($injector) {
		return $this->mapping->getValue($injector);
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
	function __toString() { return 'minject.provider.OtherMappingProvider'; }
}
