<?php

class ufront_view_TemplatingEngines {
	public function __construct(){}
	static $all;
	static $haxe;
	static function get_haxe() {
		return _hx_anonymous(array("factory" => array(new _hx_lambda(array(), "ufront_view_TemplatingEngines_0"), 'execute'), "type" => "haxe.Template", "extensions" => (new _hx_array(array("html", "tpl")))));
	}
	static function padHelperFnForHaxeTplMacro($h) {
		$_g = $h->numArgs;
		switch($_g) {
		case 0:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_1"), 'execute');
		}break;
		case 1:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_2"), 'execute');
		}break;
		case 2:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_3"), 'execute');
		}break;
		case 3:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_4"), 'execute');
		}break;
		case 4:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_5"), 'execute');
		}break;
		case 5:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_6"), 'execute');
		}break;
		case 6:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_7"), 'execute');
		}break;
		case 7:{
			return array(new _hx_lambda(array(&$_g, &$h), "ufront_view_TemplatingEngines_8"), 'execute');
		}break;
		default:{
			throw new HException("TemplateHelper supports a maximum of 7 arguments");
		}break;
		}
	}
	static $__properties__ = array("get_haxe" => "get_haxe");
	function __toString() { return 'ufront.view.TemplatingEngines'; }
}
ufront_view_TemplatingEngines::$all = (new _hx_array(array(ufront_view_TemplatingEngines::get_haxe())));
function ufront_view_TemplatingEngines_0($tplString) {
	{
		$t = new haxe_Template($tplString);
		return array(new _hx_lambda(array(&$t, &$tplString), "ufront_view_TemplatingEngines_9"), 'execute');
	}
}
function ufront_view_TemplatingEngines_1(&$_g, &$h, $_) {
	{
		return call_user_func(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h));
	}
}
function ufront_view_TemplatingEngines_2(&$_g, &$h, $_1, $a) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a));
	}
}
function ufront_view_TemplatingEngines_3(&$_g, &$h, $_2, $a1, $b) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a1, $b));
	}
}
function ufront_view_TemplatingEngines_4(&$_g, &$h, $_3, $a2, $b1, $c) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a2, $b1, $c));
	}
}
function ufront_view_TemplatingEngines_5(&$_g, &$h, $_4, $a3, $b2, $c1, $d) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a3, $b2, $c1, $d));
	}
}
function ufront_view_TemplatingEngines_6(&$_g, &$h, $_5, $a4, $b3, $c2, $d1, $e) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a4, $b3, $c2, $d1, $e));
	}
}
function ufront_view_TemplatingEngines_7(&$_g, &$h, $_6, $a5, $b4, $c3, $d2, $e1, $f) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a5, $b4, $c3, $d2, $e1, $f));
	}
}
function ufront_view_TemplatingEngines_8(&$_g, &$h, $_7, $a6, $b5, $c4, $d3, $e2, $f1, $g) {
	{
		return call_user_func_array(ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($h), array($a6, $b5, $c4, $d3, $e2, $f1, $g));
	}
}
function ufront_view_TemplatingEngines_9(&$t, &$tplString, $data, $helpers) {
	{
		$macrosObject = _hx_anonymous(array());
		if($helpers !== null) {
			if(null == $helpers) throw new HException('null iterable');
			$__hx__it = $helpers->keys();
			while($__hx__it->hasNext()) {
				unset($helperName);
				$helperName = $__hx__it->next();
				$paddedHelper = ufront_view_TemplatingEngines::padHelperFnForHaxeTplMacro($helpers->get($helperName));
				$macrosObject->{$helperName} = $paddedHelper;
				unset($paddedHelper);
			}
		}
		return $t->execute($data, $macrosObject);
	}
}
