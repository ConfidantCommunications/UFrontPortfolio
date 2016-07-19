<?php

class minject_Injector {
	public function __construct($parent = null) {
		if(!php_Boot::$skip_constructor) {
		$this->infos = new haxe_ds_StringMap();
		$this->mappings = new haxe_ds_StringMap();
		$this->parent = $parent;
	}}
	public $parent;
	public $mappings;
	public $infos;
	public function mapRuntimeTypeOf($value, $name = null) {
		return $this->mapType(minject_Injector::getValueType($value), $name, null);
	}
	public function mapType($type, $name = null, $value = null) {
		$key = $this->getMappingKey($type, $name);
		if($this->mappings->exists($key)) {
			return $this->mappings->get($key);
		}
		$mapping = new minject_InjectorMapping($type, $name);
		$this->mappings->set($key, $mapping);
		return $mapping;
	}
	public function unmapType($type, $name = null) {
		$key = $this->getMappingKey($type, $name);
		$this->mappings->remove($key);
	}
	public function hasMappingForType($type, $name = null) {
		return $this->findMappingForType($type, $name) !== null;
	}
	public function findMappingForType($type, $name) {
		$mapping = null;
		{
			$key = $this->getMappingKey($type, $name);
			$mapping = $this->mappings->get($key);
		}
		if($mapping !== null && $mapping->provider !== null) {
			return $mapping;
		}
		if($this->parent !== null) {
			return $this->parent->findMappingForType($type, $name);
		}
		return null;
	}
	public function getValueForType($type, $name = null) {
		$mapping = $this->findMappingForType($type, $name);
		if($mapping !== null) {
			return $mapping->getValue($this);
		}
		$index = _hx_index_of($type, "<", null);
		if($index > -1) {
			$mapping = $this->findMappingForType(_hx_substr($type, 0, $index), $name);
		}
		if($mapping !== null) {
			return $mapping->getValue($this);
		}
		return null;
	}
	public function injectInto($target) {
		$info = $this->getInfo(Type::getClass($target));
		if($info === null) {
			return;
		}
		{
			$_g = 0;
			$_g1 = $info->fields;
			while($_g < $_g1->length) {
				$field = $_g1[$_g];
				++$_g;
				$field->applyInjection($target, $this);
				unset($field);
			}
		}
	}
	public function _construct($type) {
		$info = $this->getInfo($type);
		return $info->ctor->createInstance($type, $this);
	}
	public function _instantiate($type) {
		$instance = $this->_construct($type);
		$this->injectInto($instance);
		return $instance;
	}
	public function getInstance($type, $name = null) {
		$type1 = Type::getClassName($type);
		$mapping = $this->findMappingForType($type1, $name);
		if($mapping === null) {
			throw new HException("Error while getting mapping response: No mapping defined for class \"" . _hx_string_or_null($type1) . "\" " . _hx_string_or_null(("name \"" . _hx_string_or_null($name) . "\"")));
		}
		return $mapping->getValue($this);
	}
	public function createChildInjector() {
		return new minject_Injector($this);
	}
	public function getInfo($forClass) {
		$type = Type::getClassName($forClass);
		if($this->infos->exists($type)) {
			return $this->infos->get($type);
		}
		$info = $this->createInfo($forClass);
		$this->infos->set($type, $info);
		return $info;
	}
	public function createInfo($forClass) {
		$info = new minject_InjectorInfo(null, (new _hx_array(array())));
		$this->addClassToInfo($forClass, $info, (new _hx_array(array())));
		if($info->ctor === null) {
			$info->ctor = new minject_point_ConstructorInjectionPoint((new _hx_array(array())));
		}
		return $info;
	}
	public function addClassToInfo($forClass, $info, $injected) {
		$meta = haxe_rtti_Meta::getType($forClass);
		$fields = $meta->rtti;
		if($fields !== null) {
			$_g = 0;
			while($_g < $fields->length) {
				$field = $fields[$_g];
				++$_g;
				$name = $field[0];
				if($injected->indexOf($name, null) > -1) {
					continue;
				}
				$injected->push($name);
				if($name === "new") {
					$info->ctor = new minject_point_ConstructorInjectionPoint($field->slice(1, null));
				} else {
					if($field->length === 3) {
						$info->fields->push(new minject_point_PropertyInjectionPoint($name, $field[1], $field[2]));
					} else {
						$info->fields->push(new minject_point_MethodInjectionPoint($name, $field->slice(1, null)));
					}
				}
				unset($name,$field);
			}
		}
		$superClass = Type::getSuperClass($forClass);
		if($superClass !== null) {
			$this->addClassToInfo($superClass, $info, $injected);
		}
	}
	public function getMappingKey($type, $name) {
		if($name === null) {
			$name = "";
		}
		return "" . _hx_string_or_null($type) . "#" . _hx_string_or_null($name);
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
	static function getValueType($value) {
		if(Std::is($value, _hx_qtype("String"))) {
			return "String";
		}
		if(Std::is($value, _hx_qtype("Class"))) {
			return Type::getClassName($value);
		}
		if(Std::is($value, _hx_qtype("Enum"))) {
			return Type::getEnumName($value);
		}
		$name = null;
		{
			$_g = Type::typeof($value);
			switch($_g->index) {
			case 1:{
				$name = "Int";
			}break;
			case 3:{
				$name = "Bool";
			}break;
			case 6:{
				$c = _hx_deref($_g)->params[0];
				$name = Type::getClassName($c);
			}break;
			case 7:{
				$e = _hx_deref($_g)->params[0];
				$name = Type::getEnumName($e);
			}break;
			default:{
				$name = null;
			}break;
			}
		}
		if($name !== null) {
			return $name;
		}
		throw new HException("Could not determine type name of " . Std::string($value));
	}
	function __toString() { return 'minject.Injector'; }
}