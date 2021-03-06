<?php

// Generated by Haxe 3.4.4
class tink_io__Source_StdSource extends tink_io_SourceBase {
	public function __construct($name, $target, $worker = null) {
		if(!php_Boot::$skip_constructor) {
		$this->name = $name;
		$this->target = $target;
		$this->worker = tink_io__Worker_Worker_Impl_::ensure($worker);
	}}
	public $name;
	public $target;
	public $worker;
	public function read($into, $max = null) {
		if($max === null) {
			$max = 1073741824;
		}
		$_gthis = $this;
		$tmp = $this->worker;
		return tink_io__Worker_Worker_Impl_::work($tmp, new tink_core__Lazy_LazyFunc(array(new _hx_lambda(array(&$_gthis, &$into, &$max), "tink_io__Source_StdSource_0"), 'execute')));
	}
	public function close() {
		$_gthis = $this;
		$tmp = $this->worker;
		return tink_io__Worker_Worker_Impl_::work($tmp, new tink_core__Lazy_LazyFunc(array(new _hx_lambda(array(&$_gthis), "tink_io__Source_StdSource_1"), 'execute')));
	}
	public function parseWhile($parser, $cond) {
		$_gthis = $this;
		$buf = tink_io_Buffer::alloc(tink_io_Buffer::sufficientWidthFor($parser->minSize()));
		$ret = tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$buf, &$cond, &$parser), "tink_io__Source_StdSource_2"), 'execute'), null);
		$ret->handle(tink_core__Callback_Callback_Impl_::fromNiladic((property_exists($buf, "dispose") ? $buf->dispose: array($buf, "dispose"))));
		return $ret;
	}
	public function toString() {
		return $this->name;
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
	function __toString() { return $this->toString(); }
}
function tink_io__Source_StdSource_0(&$_gthis, &$into, &$max) {
	{
		return $into->tryReadingFrom($_gthis->name, $_gthis->target, $max);
	}
}
function tink_io__Source_StdSource_1(&$_gthis) {
	{
		$tmp1 = tink_core_TypedError::reporter(null, "Failed to close " . _hx_string_or_null($_gthis->name), _hx_anonymous(array("fileName" => "Source.hx", "lineNumber" => 347, "className" => "tink.io._Source.StdSource", "methodName" => "close")));
		return tink_core_TypedError::catchExceptions(array(new _hx_lambda(array(&$_gthis), "tink_io__Source_StdSource_3"), 'execute'), $tmp1, _hx_anonymous(array("fileName" => "Source.hx", "lineNumber" => 342, "className" => "tink.io._Source.StdSource", "methodName" => "close")));
	}
}
function tink_io__Source_StdSource_2(&$_gthis, &$buf, &$cond, &$parser, $cb) {
	{
		$step = null;
		$step = array(new _hx_lambda(array(&$_gthis, &$buf, &$cb, &$cond, &$parser, &$step), "tink_io__Source_StdSource_4"), 'execute');
		$step5 = $step;
		call_user_func_array($step5, array(null));
	}
}
function tink_io__Source_StdSource_3(&$_gthis) {
	{
		$_gthis->target->close();
		return tink_core_Noise::$Noise;
	}
}
function tink_io__Source_StdSource_4(&$_gthis, &$buf, &$cb, &$cond, &$parser, &$step, $noread) {
	{
		$_gthis1 = $_gthis->worker;
		tink_io__Worker_Worker_Impl_::work($_gthis1, new tink_core__Lazy_LazyFunc(array(new _hx_lambda(array(&$_gthis, &$buf, &$noread, &$parser), "tink_io__Source_StdSource_5"), 'execute')))->handle(array(new _hx_lambda(array(&$_gthis, &$buf, &$cb, &$cond, &$step), "tink_io__Source_StdSource_6"), 'execute'));
	}
}
function tink_io__Source_StdSource_5(&$_gthis, &$buf, &$noread, &$parser) {
	{
		$_g = null;
		if($noread) {
			$_g = tink_core_Outcome::Success(0);
		} else {
			$_g = $buf->tryReadingFrom($_gthis->name, $_gthis->target, null);
		}
		switch($_g->index) {
		case 0:{
			$v = _hx_deref($_g)->params[0];
			if($v < 0) {
				$buf->seal();
			}
			$available = $buf->available;
			$step1 = null;
			if($v < 0) {
				$step1 = $available === 0;
			} else {
				$step1 = false;
			}
			if($step1) {
				return tink_core_OutcomeTools::map($parser->eof(), (property_exists("haxe_ds_Option", "Some") ? haxe_ds_Option::$Some: array("haxe_ds_Option", "Some")));
			} else {
				$_g1 = $parser->progress($buf);
				if($_g1->index === 0) {
					if(_hx_deref($_g1)->params[0]->index === 1) {
						$step2 = null;
						if($v < 0) {
							$step2 = $available === $buf->available;
						} else {
							$step2 = false;
						}
						if($step2) {
							return tink_core_Outcome::Failure(new tink_core_TypedError(null, "Parser hung on input", _hx_anonymous(array("fileName" => "Source.hx", "lineNumber" => 368, "className" => "tink.io._Source.StdSource", "methodName" => "parseWhile"))));
						} else {
							$v1 = $_g1;
							return $v1;
						}
					} else {
						$v2 = $_g1;
						return $v2;
					}
				} else {
					$v3 = $_g1;
					return $v3;
				}
			}
		}break;
		case 1:{
			$e = _hx_deref($_g)->params[0];
			return tink_core_Outcome::Failure($e);
		}break;
		}
	}
}
function tink_io__Source_StdSource_6(&$_gthis, &$buf, &$cb, &$cond, &$step, $o) {
	{
		switch($o->index) {
		case 0:{
			switch(_hx_deref($o)->params[0]->index) {
			case 0:{
				$v4 = _hx_deref(_hx_deref($o)->params[0])->params[0];
				call_user_func_array($cond, array($v4))->handle(array(new _hx_lambda(array(&$_gthis, &$buf, &$cb, &$step), "tink_io__Source_StdSource_7"), 'execute'));
			}break;
			case 1:{
				call_user_func_array($step, array(null));
			}break;
			}
		}break;
		case 1:{
			$e1 = _hx_deref($o)->params[0];
			call_user_func_array($cb, array(tink_core_Outcome::Failure($e1)));
		}break;
		}
	}
}
function tink_io__Source_StdSource_7(&$_gthis, &$buf, &$cb, &$step, $v5) {
	{
		if($v5) {
			call_user_func_array($step, array(true));
		} else {
			$step3 = $buf->content();
			$step4 = tink_core_Outcome::Success($_gthis->prepend(tink_io__Source_Source_Impl_::fromBytes($step3)));
			call_user_func_array($cb, array($step4));
		}
	}
}
