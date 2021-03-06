<?php

// Generated by Haxe 3.4.4
class tink_io__Source_CompoundSource extends tink_io_SourceBase {
	public function __construct($parts) {
		if(!php_Boot::$skip_constructor) {
		$this->parts = $parts;
	}}
	public $parts;
	public function pipeTo($dest, $options = null) {
		$_gthis = $this;
		return tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$dest, &$options), "tink_io__Source_CompoundSource_0"), 'execute'), null);
	}
	public function close() {
		if($this->parts->length === 0) {
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
		}
		$_g = (new _hx_array(array()));
		{
			$_g1 = 0;
			$_g2 = $this->parts;
			while($_g1 < $_g2->length) {
				$p = $_g2[$_g1];
				$_g1 = $_g1 + 1;
				$_g->push($p->close());
				unset($p);
			}
		}
		$ret = tink_core__Future_Future_Impl_::ofMany($_g, null);
		$this->parts = (new _hx_array(array()));
		$ret1 = $ret->map(array(new _hx_lambda(array(), "tink_io__Source_CompoundSource_1"), 'execute'));
		return $ret1->gather();
	}
	public function read($into, $max = null) {
		if($max === null) {
			$max = 1073741824;
		}
		$_gthis = $this;
		$_g = $this->parts;
		if($_g->length === 0) {
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(-1)));
		} else {
			$this1 = _hx_array_get($this->parts, 0)->read($into, 1073741824);
			$ret = $this1->flatMap(array(new _hx_lambda(array(&$_gthis, &$into, &$max), "tink_io__Source_CompoundSource_2"), 'execute'));
			return $ret->gather();
		}
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
	static function of($a, $b) {
		$_g = Std::instance($b, _hx_qtype("tink.io._Source.CompoundSource"));
		$_g1 = Std::instance($a, _hx_qtype("tink.io._Source.CompoundSource"));
		$tmp = null;
		if($_g1 === null) {
			if($_g === null) {
				$tmp = (new _hx_array(array($a, $b)));
			} else {
				$p = $_g->parts;
				$tmp = _hx_deref((new _hx_array(array($a))))->concat($p);
			}
		} else {
			if($_g === null) {
				$p1 = $_g1->parts;
				$tmp = $p1->concat((new _hx_array(array($b))));
			} else {
				$p11 = $_g1->parts;
				$p2 = $_g->parts;
				$tmp = $p11->concat($p2);
			}
		}
		return new tink_io__Source_CompoundSource($tmp);
	}
	function __toString() { return 'tink.io._Source.CompoundSource'; }
}
function tink_io__Source_CompoundSource_0(&$_gthis, &$dest, &$options, $cb) {
	{
		$next = null;
		$next = array(new _hx_lambda(array(&$_gthis, &$cb, &$dest, &$next, &$options), "tink_io__Source_CompoundSource_3"), 'execute');
		$next2 = $next;
		call_user_func($next2);
	}
}
function tink_io__Source_CompoundSource_1($outcomes) {
	{
		$failures = (new _hx_array(array()));
		{
			$_g11 = 0;
			while($_g11 < $outcomes->length) {
				$o = $outcomes[$_g11];
				$_g11 = $_g11 + 1;
				if($o->index === 1) {
					$f = _hx_deref($o)->params[0];
					$failures->push($f);
					unset($f);
				}
				unset($o);
			}
		}
		if($failures->length === 0) {
			return tink_core_Outcome::Success(tink_core_Noise::$Noise);
		} else {
			return tink_core_Outcome::Failure(tink_core_TypedError::withData(null, "Error closing sources", $failures, _hx_anonymous(array("fileName" => "Source.hx", "lineNumber" => 439, "className" => "tink.io._Source.CompoundSource", "methodName" => "close"))));
		}
	}
}
function tink_io__Source_CompoundSource_2(&$_gthis, &$into, &$max, $o) {
	{
		if($o->index === 0) {
			$_hx_tmp = _hx_deref($o)->params[0] < 0;
			if($_hx_tmp === true) {
				{
					$this2 = $_gthis->parts->shift();
					$this2->close();
				}
				return $_gthis->read($into, $max);
			} else {
				return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($o));
			}
		} else {
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($o));
		}
	}
}
function tink_io__Source_CompoundSource_3(&$_gthis, &$cb, &$dest, &$next, &$options) {
	{
		$_g = $_gthis->parts;
		if($_g->length === 0) {
			call_user_func_array($cb, array(tink_io_PipeResult::$AllWritten));
		} else {
			$v = $_g;
			$options1 = null;
			if($_gthis->parts->length === 1) {
				$options1 = $options;
			} else {
				$options1 = null;
			}
			$next1 = _hx_array_get($_gthis->parts, 0)->pipeTo($dest, $options1);
			$next1->handle(array(new _hx_lambda(array(&$_gthis, &$cb, &$next), "tink_io__Source_CompoundSource_4"), 'execute'));
		}
	}
}
function tink_io__Source_CompoundSource_4(&$_gthis, &$cb, &$next, $x) {
	{
		if($x->index === 0) {
			{
				$this1 = $_gthis->parts->shift();
				$this1->close();
			}
			call_user_func($next);
		} else {
			call_user_func_array($cb, array($x));
		}
	}
}
