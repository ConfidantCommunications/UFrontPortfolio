<?php

// Generated by Haxe 3.4.4
class tink_streams_StreamMapFilter extends tink_streams_StreamBase {
	public function __construct($data, $transformer) {
		if(!php_Boot::$skip_constructor) {
		$this->data = $data;
		$this->transformer = $transformer;
	}}
	public $transformer;
	public $data;
	public function chain($transformer) {
		$_gthis = $this;
		return new tink_streams_StreamMapFilter($this->data, array(new _hx_lambda(array(&$_gthis, &$transformer), "tink_streams_StreamMapFilter_0"), 'execute'));
	}
	public function hforEach($item) {
		$_gthis = $this;
		return $this->data->hforEach(array(new _hx_lambda(array(&$_gthis, &$item), "tink_streams_StreamMapFilter_1"), 'execute'));
	}
	public function forEachAsync($item) {
		$_gthis = $this;
		return $this->data->forEachAsync(array(new _hx_lambda(array(&$_gthis, &$item), "tink_streams_StreamMapFilter_2"), 'execute'));
	}
	public function chainAsync($transformer) {
		$_gthis = $this;
		return new tink_streams_StreamMapFilterAsync($this->data, array(new _hx_lambda(array(&$_gthis, &$transformer), "tink_streams_StreamMapFilter_3"), 'execute'));
	}
	public function filterAsync($item) {
		return $this->chainAsync(tink_streams__Stream_StreamFilterAsync_Impl_::lift($item));
	}
	public function mapAsync($item) {
		return $this->chainAsync(tink_streams__Stream_StreamMapAsync_Impl_::lift($item));
	}
	public function map($item) {
		return $this->chain(tink_streams__Stream_StreamMap_Impl_::lift($item));
	}
	public function filter($item) {
		return $this->chain(tink_streams__Stream_StreamFilter_Impl_::lift($item));
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
	function __toString() { return 'tink.streams.StreamMapFilter'; }
}
function tink_streams_StreamMapFilter_0(&$_gthis, &$transformer, $i) {
	{
		$this1 = $_gthis->transformer($i);
		if($this1 !== null) {
			return call_user_func_array($transformer, array($this1));
		} else {
			return null;
		}
	}
}
function tink_streams_StreamMapFilter_1(&$_gthis, &$item, $x) {
	{
		$_g = $_gthis->transformer($x);
		$v = $_g;
		if($v !== null) {
			return call_user_func_array($item, array($v));
		} else {
			return true;
		}
	}
}
function tink_streams_StreamMapFilter_2(&$_gthis, &$item, $x) {
	{
		$_g = $_gthis->transformer($x);
		$v = $_g;
		if($v !== null) {
			return call_user_func_array($item, array($v));
		} else {
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(true));
		}
	}
}
function tink_streams_StreamMapFilter_3(&$_gthis, &$transformer, $i) {
	{
		$_g = $_gthis->transformer($i);
		$v = $_g;
		if($v !== null) {
			return call_user_func_array($transformer, array($v));
		} else {
			return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(null));
		}
	}
}