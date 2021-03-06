<?php

// Generated by Haxe 3.4.4
class Reflect {
	public function __construct(){}
	static function field($o, $field) {
		return _hx_field($o, $field);
	}
	static function getProperty($o, $field) {
		if(null === $o) {
			return null;
		}
		$cls = null;
		if(Std::is($o, _hx_qtype("Class"))) {
			$cls = $o->__tname__;
		} else {
			$cls = get_class($o);
		}
		$cls_vars = get_class_vars($cls);
		if(isset($cls_vars['__properties__']) && isset($cls_vars['__properties__']['get_'.$field]) && ($field = $cls_vars['__properties__']['get_'.$field])) {
			return $o->$field();
		} else {
			return _hx_field($o, $field);
		}
	}
	static function setProperty($o, $field, $value) {
		if(null === $o) {
			return;
		}
		$cls = null;
		if(Std::is($o, _hx_qtype("Class"))) {
			$cls = $o->__tname__;
		} else {
			$cls = get_class($o);
		}
		$cls_vars = get_class_vars($cls);
		if(isset($cls_vars['__properties__']) && isset($cls_vars['__properties__']['set_'.$field]) && ($field = $cls_vars['__properties__']['set_'.$field])) {
			$o->$field($value);
		} else {
			$o->{$field} = $value;
		}
	}
	static function callMethod($o, $func, $args) {
		return call_user_func_array(((is_callable($func)) ? $func : array($o, $func)), ((null === $args) ? array() : $args->a));
	}
	static function fields($o) {
		if($o === null) {
			return new _hx_array(array());
		}
		if($o instanceof _hx_array) {
			return new _hx_array(array('concat','copy','insert','iterator','length','join','pop','push','remove','reverse','shift','slice','sort','splice','toString','unshift'));
		} else {
			if(is_string($o)) {
				return new _hx_array(array('charAt','charCodeAt','indexOf','lastIndexOf','length','split','substr','toLowerCase','toString','toUpperCase'));
			} else {
				return new _hx_array(_hx_get_object_vars($o));
			}
		}
	}
	static function isFunction($f) {
		if(!(is_array($f) && is_callable($f)) || _hx_is_lambda($f)) {
			$tmp = null;
			if(is_array($f)) {
				$o = $f[0];
				$field = $f[1];
				$tmp = _hx_has_field($o, $field);
			} else {
				$tmp = false;
			}
			if($tmp) {
				return $f[1] !== "length";
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	static function compare($a, $b) {
		if((is_object($_t = $a) && ($_t instanceof Enum) ? $_t == $b : _hx_equal($_t, $b))) {
			return 0;
		} else {
			if(is_string($a)) {
				return strcmp($a, $b);
			} else {
				if($a > $b) {
					return 1;
				} else {
					return -1;
				}
			}
		}
	}
	static function isObject($v) {
		if($v === null) {
			return false;
		}
		if(is_object($v)) {
			$tmp = null;
			if(!$v instanceof _hx_anonymous) {
				$tmp = Type::getClass($v) !== null;
			} else {
				$tmp = true;
			}
			if(!$tmp) {
				if(!$v instanceof _hx_class) {
					return $v instanceof _hx_enum;
				} else {
					return true;
				}
			} else {
				return true;
			}
		}
		return is_string($v) && !_hx_is_lambda($v);
	}
	function __toString() { return 'Reflect'; }
}
