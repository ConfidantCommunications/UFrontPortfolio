<?php

class minject_provider_ClassProvider implements minject_provider_DependencyProvider{
	public function __construct($type) {
		if(!php_Boot::$skip_constructor) {
		$this->type = $type;
	}}
	public $type;
	public function getValue($injector) {
		return $injector->_instantiate($this->type);
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
	function __toString() { return 'minject.provider.ClassProvider'; }
}
