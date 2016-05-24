<?php

class minject_point_ConstructorInjectionPoint extends minject_point_MethodInjectionPoint {
	public function __construct($args) { if(!php_Boot::$skip_constructor) {
		parent::__construct("new",$args);
	}}
	public function createInstance($type, $injector) {
		return Type::createInstance($type, $this->gatherArgs($type, $injector));
	}
	function __toString() { return 'minject.point.ConstructorInjectionPoint'; }
}
