<?php

// Generated by Haxe 3.4.4
class tink_io_SourceBase implements tink_io_SourceObject{
	public function __construct(){}
	public function idealize($onError) {
		return new tink_io_IdealizedSource($this, $onError);
	}
	public function prepend($other) {
		return tink_io__Source_CompoundSource::of($other, $this);
	}
	public function append($other) {
		return tink_io__Source_CompoundSource::of($this, $other);
	}
	public function read($into, $max = null) {
		if($max === null) {
			$max = 1073741824;
		}
		throw new HException("not implemented");
	}
	public function close() {
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_Outcome::Success(tink_core_Noise::$Noise)));
	}
	public function pipeTo($dest, $options = null) {
		$_gthis = $this;
		return tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$dest, &$options), "tink_io_SourceBase_0"), 'execute'), null);
	}
	public function all() {
		$_gthis = $this;
		$out = new haxe_io_BytesOutput();
		return tink_core__Future_Future_Impl_::async(array(new _hx_lambda(array(&$_gthis, &$out), "tink_io_SourceBase_1"), 'execute'), null);
	}
	public function parse($parser) {
		$ret = null;
		return tink_core__Future_Future_Impl_::_tryMap($this->parseWhile($parser, array(new _hx_lambda(array(&$ret), "tink_io_SourceBase_2"), 'execute')), array(new _hx_lambda(array(&$ret), "tink_io_SourceBase_3"), 'execute'));
	}
	public function parseWhile($parser, $cond) {
		return _hx_deref(new tink_io_ParserSink($parser, $cond, null))->parse($this, null);
	}
	public function parseStream($parser, $rest = null) {
		return new tink_io__Source_ParserStream($this, $parser, $rest);
	}
	public function split($delim) {
		$f = $this->parse(new tink_io_Splitter($delim));
		$a = new tink_io__Source_FutureSource(tink_core__Future_Future_Impl_::_tryMap($f, array(new _hx_lambda(array(), "tink_io_SourceBase_4"), 'execute')));
		$b = new tink_io__Source_FutureSource(tink_core__Future_Future_Impl_::_tryMap($f, array(new _hx_lambda(array(), "tink_io_SourceBase_5"), 'execute')));
		$this1 = new tink_core_MPair($a, $b);
		return $this1;
	}
	function __toString() { return 'tink.io.SourceBase'; }
}
function tink_io_SourceBase_0(&$_gthis, &$dest, &$options, $cb) {
	{
		$this1 = $_gthis;
		tink_io_Pipe::make($this1, $dest, null, $options, array(new _hx_lambda(array(&$cb), "tink_io_SourceBase_6"), 'execute'));
	}
}
function tink_io_SourceBase_1(&$_gthis, &$out, $cb) {
	{
		$this1 = tink_io__Sink_Sink_Impl_::ofOutput("memory buffer", $out, null);
		$_gthis->pipeTo($this1, null)->handle(array(new _hx_lambda(array(&$cb, &$out), "tink_io_SourceBase_7"), 'execute'));
	}
}
function tink_io_SourceBase_2(&$ret, $x) {
	{
		$ret = $x;
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(false));
	}
}
function tink_io_SourceBase_3(&$ret, $s) {
	{
		return _hx_anonymous(array("data" => $ret, "rest" => $s));
	}
}
function tink_io_SourceBase_4($d) {
	{
		return tink_io__Source_Source_Impl_::fromBytes($d->data);
	}
}
function tink_io_SourceBase_5($d1) {
	{
		return $d1->rest;
	}
}
function tink_io_SourceBase_6(&$cb, $_, $res) {
	{
		call_user_func_array($cb, array($res));
	}
}
function tink_io_SourceBase_7(&$cb, &$out, $r) {
	{
		$tmp = null;
		switch($r->index) {
		case 0:{
			$tmp = tink_core_Outcome::Success($out->getBytes());
		}break;
		case 3:{
			$e = _hx_deref($r)->params[0];
			$tmp = tink_core_Outcome::Failure($e);
		}break;
		default:{
			throw new HException("assert");
		}break;
		}
		call_user_func_array($cb, array($tmp));
	}
}
