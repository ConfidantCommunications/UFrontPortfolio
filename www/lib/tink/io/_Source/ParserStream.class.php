<?php

// Generated by Haxe 3.4.4
class tink_io__Source_ParserStream extends tink_streams_StreamBase {
	public function __construct($source, $parser, $handleRest = null) {
		if(!php_Boot::$skip_constructor) {
		$this->source = $source;
		$this->parser = $parser;
		$this->handleRest = $handleRest;
	}}
	public $source;
	public $parser;
	public $handleRest;
	public function forEachAsync($item) {
		$_gthis = $this;
		return tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$item), "tink_io__Source_ParserStream_0"), 'execute'), null);
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
	function __toString() { return 'tink.io._Source.ParserStream'; }
}
function tink_io__Source_ParserStream_0(&$_gthis, &$item, $finished) {
	{
		$done = false;
		$tmp = $_gthis->source->parseWhile($_gthis->parser, array(new _hx_lambda(array(&$done, &$item), "tink_io__Source_ParserStream_1"), 'execute'));
		$tmp->handle(array(new _hx_lambda(array(&$_gthis, &$done, &$finished), "tink_io__Source_ParserStream_2"), 'execute'));
	}
}
function tink_io__Source_ParserStream_1(&$done, &$item, $v) {
	{
		if($v === null) {
			$done = true;
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(false));
		} else {
			return call_user_func_array($item, array($v));
		}
	}
}
function tink_io__Source_ParserStream_2(&$_gthis, &$done, &$finished, $o) {
	{
		$tmp1 = null;
		switch($o->index) {
		case 0:{
			$rest = _hx_deref($o)->params[0];
			$tmp2 = null;
			if($done) {
				$tmp2 = $_gthis->handleRest !== null;
			} else {
				$tmp2 = false;
			}
			if($tmp2) {
				tink_core__Callback_Callback_Impl_::invoke((property_exists($_gthis, "handleRest") ? $_gthis->handleRest: array($_gthis, "handleRest")), $rest);
			}
			$tmp1 = tink_core_Outcome::Success($done);
		}break;
		case 1:{
			$e = _hx_deref($o)->params[0];
			$tmp1 = tink_core_Outcome::Failure($e);
		}break;
		}
		call_user_func_array($finished, array($tmp1));
	}
}
