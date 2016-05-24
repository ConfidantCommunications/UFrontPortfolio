<?php

class minject_point_MethodInjectionPoint implements minject_point_InjectionPoint{
	public function __construct($field, $args) {
		if(!php_Boot::$skip_constructor) {
		$this->field = $field;
		$this->args = $args;
	}}
	public $field;
	public $args;
	public function applyInjection($target, $injector) {
		Reflect::callMethod($target, Reflect::field($target, $this->field), $this->gatherArgs($target, $injector));
		return $target;
	}
	public function gatherArgs($target, $injector) {
		$values = (new _hx_array(array()));
		$index = 0;
		while($index < $this->args->length) {
			$type = $this->args[$index++];
			$argName = $this->args[$index++];
			$opt = $this->args[$index++] === "o";
			$response = $injector->getValueForType($type, $argName);
			$values->push($response);
			unset($type,$response,$opt,$argName);
		}
		return $values;
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
	function __toString() { return 'minject.point.MethodInjectionPoint'; }
}
