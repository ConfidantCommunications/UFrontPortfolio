<?php

class minject_provider_SingletonProvider implements minject_provider_DependencyProvider{
	public function __construct($type) {
		if(!php_Boot::$skip_constructor) {
		$this->type = $type;
	}}
	public $type;
	public $value;
	public function getValue($injector) {
		if($this->value === null) {
			$this->value = $injector->_construct($this->type);
			$injector->injectInto($this->value);
		}
		return $this->value;
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
	function __toString() { return 'minject.provider.SingletonProvider'; }
}
