<?php

class minject_provider_ValueProvider implements minject_provider_DependencyProvider{
	public function __construct($value) {
		if(!php_Boot::$skip_constructor) {
		$this->value = $value;
	}}
	public $value;
	public function getValue($injector) {
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
	function __toString() { return 'minject.provider.ValueProvider'; }
}
