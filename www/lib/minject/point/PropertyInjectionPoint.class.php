<?php

class minject_point_PropertyInjectionPoint implements minject_point_InjectionPoint{
	public function __construct($field, $type, $name = null) {
		if(!php_Boot::$skip_constructor) {
		$this->field = $field;
		$this->type = $type;
		$this->name = $name;
	}}
	public $field;
	public $type;
	public $name;
	public function applyInjection($target, $injector) {
		$response = $injector->getValueForType($this->type, $this->name);
		Reflect::setProperty($target, $this->field, $response);
		return $target;
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
	function __toString() { return 'minject.point.PropertyInjectionPoint'; }
}
