<?php

// Generated by Haxe 3.4.4
class ufront_view__UFTemplate_UFTemplate_Impl_ {
	public function __construct(){}
	static function _new($cb) {
		$this1 = $cb;
		return $this1;
	}
	static function fromSimpleCallback($cb) {
		return ufront_view__UFTemplate_UFTemplate_Impl_::_new(array(new _hx_lambda(array(&$cb), "ufront_view__UFTemplate_UFTemplate_Impl__0"), 'execute'));
	}
	static function execute($this1, $data, $helpers = null) {
		return call_user_func_array($this1, array($data, $helpers));
	}
	function __toString() { return 'ufront.view._UFTemplate.UFTemplate_Impl_'; }
}
function ufront_view__UFTemplate_UFTemplate_Impl__0(&$cb, $data, $helpers) {
	{
		$this1 = _hx_anonymous(array());
		$combinedData = $this1;
		if($helpers !== null) {
			$helperName = $helpers->keys();
			while($helperName->hasNext()) {
				$helperName1 = $helperName->next();
				ufront_view__TemplateData_TemplateData_Impl_::set($combinedData, $helperName1, ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($helpers->get($helperName1)));
				unset($helperName1);
			}
		}
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedData, $data);
		return call_user_func_array($cb, array($combinedData));
	}
}
