<?php

class ufront_view__UFTemplate_UFTemplate_Impl_ {
	public function __construct(){}
	static function _new($cb) {
		return $cb;
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
		$combinedData = _hx_anonymous(array());
		if($helpers !== null) {
			if(null == $helpers) throw new HException('null iterable');
			$__hx__it = $helpers->keys();
			while($__hx__it->hasNext()) {
				unset($helperName);
				$helperName = $__hx__it->next();
				ufront_view__TemplateData_TemplateData_Impl_::set($combinedData, $helperName, ufront_view__TemplateHelper_TemplateHelper_Impl_::getFn($helpers->get($helperName)));
			}
		}
		ufront_view__TemplateData_TemplateData_Impl_::setObject($combinedData, $data);
		return call_user_func_array($cb, array($combinedData));
	}
}
