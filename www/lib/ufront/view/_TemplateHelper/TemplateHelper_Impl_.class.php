<?php

class ufront_view__TemplateHelper_TemplateHelper_Impl_ {
	public function __construct(){}
	static function _new($numArgs, $fn) {
		$this1 = null;
		if($numArgs > 7) {
			throw new HException("TemplateHelpers can have a maximum of 7 arguments");
		}
		$this1 = _hx_anonymous(array("numArgs" => $numArgs, "fn" => $fn));
		return $this1;
	}
	static function from0($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(0, $fn);
	}
	static function from1($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(1, $fn);
	}
	static function from2($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(2, $fn);
	}
	static function from3($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(3, $fn);
	}
	static function from4($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(4, $fn);
	}
	static function from5($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(5, $fn);
	}
	static function from6($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(6, $fn);
	}
	static function from7($fn) {
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::_new(7, $fn);
	}
	static function getFn($this1) {
		$_g = $this1->numArgs;
		switch($_g) {
		case 0:{
			$_e = $this1;
			return array(new _hx_lambda(array(&$_e, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__0"), 'execute');
		}break;
		case 1:{
			$_e1 = $this1;
			return array(new _hx_lambda(array(&$_e1, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__1"), 'execute');
		}break;
		case 2:{
			$_e2 = $this1;
			return array(new _hx_lambda(array(&$_e2, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__2"), 'execute');
		}break;
		case 3:{
			$_e3 = $this1;
			return array(new _hx_lambda(array(&$_e3, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__3"), 'execute');
		}break;
		case 4:{
			$_e4 = $this1;
			return array(new _hx_lambda(array(&$_e4, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__4"), 'execute');
		}break;
		case 5:{
			$_e5 = $this1;
			return array(new _hx_lambda(array(&$_e5, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__5"), 'execute');
		}break;
		case 6:{
			$_e6 = $this1;
			return array(new _hx_lambda(array(&$_e6, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__6"), 'execute');
		}break;
		case 7:{
			$_e7 = $this1;
			return array(new _hx_lambda(array(&$_e7, &$_g, &$this1), "ufront_view__TemplateHelper_TemplateHelper_Impl__7"), 'execute');
		}break;
		default:{
			throw new HException("TemplateHelpers can have a maximum of 7 arguments");
		}break;
		}
	}
	static function call0($this1) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array())));
	}
	static function call1($this1, $arg1) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1))));
	}
	static function call2($this1, $arg1, $arg2) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2))));
	}
	static function call3($this1, $arg1, $arg2, $arg3) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2, $arg3))));
	}
	static function call4($this1, $arg1, $arg2, $arg3, $arg4) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2, $arg3, $arg4))));
	}
	static function call5($this1, $arg1, $arg2, $arg3, $arg4, $arg5) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2, $arg3, $arg4, $arg5))));
	}
	static function call6($this1, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2, $arg3, $arg4, $arg5, $arg6))));
	}
	static function call7($this1, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7) {
		return Reflect::callMethod(_hx_anonymous(array()), $this1->fn, (new _hx_array(array($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7))));
	}
	function __toString() { return 'ufront.view._TemplateHelper.TemplateHelper_Impl_'; }
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__0(&$_e, &$_g, &$this1) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call0($_e);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__1(&$_e1, &$_g, &$this1, $arg1) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call1($_e1, $arg1);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__2(&$_e2, &$_g, &$this1, $arg11, $arg2) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call2($_e2, $arg11, $arg2);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__3(&$_e3, &$_g, &$this1, $arg12, $arg21, $arg3) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call3($_e3, $arg12, $arg21, $arg3);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__4(&$_e4, &$_g, &$this1, $arg13, $arg22, $arg31, $arg4) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call4($_e4, $arg13, $arg22, $arg31, $arg4);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__5(&$_e5, &$_g, &$this1, $arg14, $arg23, $arg32, $arg41, $arg5) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call5($_e5, $arg14, $arg23, $arg32, $arg41, $arg5);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__6(&$_e6, &$_g, &$this1, $arg15, $arg24, $arg33, $arg42, $arg51, $arg6) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call6($_e6, $arg15, $arg24, $arg33, $arg42, $arg51, $arg6);
	}
}
function ufront_view__TemplateHelper_TemplateHelper_Impl__7(&$_e7, &$_g, &$this1, $arg16, $arg25, $arg34, $arg43, $arg52, $arg61, $arg7) {
	{
		return ufront_view__TemplateHelper_TemplateHelper_Impl_::call7($_e7, $arg16, $arg25, $arg34, $arg43, $arg52, $arg61, $arg7);
	}
}
