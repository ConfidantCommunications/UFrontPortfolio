<?php

class Lambda {
	public function __construct(){}
	static function harray($it) {
		$a = new _hx_array(array());
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			unset($i);
			$i = $__hx__it->next();
			$a->push($i);
		}
		return $a;
	}
	static function has($it, $elt) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			unset($x);
			$x = $__hx__it->next();
			if((is_object($_t = $x) && !($_t instanceof Enum) ? $_t === $elt : $_t == $elt)) {
				return true;
			}
			unset($_t);
		}
		return false;
	}
	static function exists($it, $f) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			unset($x);
			$x = $__hx__it->next();
			if(call_user_func_array($f, array($x))) {
				return true;
			}
		}
		return false;
	}
	static function filter($it, $f) {
		$l = new HList();
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			unset($x);
			$x = $__hx__it->next();
			if(call_user_func_array($f, array($x))) {
				$l->add($x);
			}
		}
		return $l;
	}
	static function count($it, $pred = null) {
		$n = 0;
		if($pred === null) {
			if(null == $it) throw new HException('null iterable');
			$__hx__it = $it->iterator();
			while($__hx__it->hasNext()) {
				unset($_);
				$_ = $__hx__it->next();
				$n++;
			}
		} else {
			if(null == $it) throw new HException('null iterable');
			$__hx__it = $it->iterator();
			while($__hx__it->hasNext()) {
				unset($x);
				$x = $__hx__it->next();
				if(call_user_func_array($pred, array($x))) {
					$n++;
				}
			}
		}
		return $n;
	}
	static function find($it, $f) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			unset($v);
			$v = $__hx__it->next();
			if(call_user_func_array($f, array($v))) {
				return $v;
			}
		}
		return null;
	}
	function __toString() { return 'Lambda'; }
}
