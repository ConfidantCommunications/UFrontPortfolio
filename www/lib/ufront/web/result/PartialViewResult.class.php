<?php

class ufront_web_result_PartialViewResult extends ufront_web_result_ViewResult {
	public function __construct($data = null, $viewPath = null, $templatingEngine = null) { if(!php_Boot::$skip_constructor) {
		parent::__construct($data,$viewPath,$templatingEngine);
	}}
	static $transitionTimeout = 0;
	static function create($data) {
		return new ufront_web_result_PartialViewResult(ufront_view__TemplateData_TemplateData_Impl_::setObject(ufront_web_result_PartialViewResult_0($data), $data), null, null);
	}
	static function startLoadingAnimations() {}
	function __toString() { return 'ufront.web.result.PartialViewResult'; }
}
function ufront_web_result_PartialViewResult_0(&$data) {
	{
		$obj = _hx_anonymous(array());
		return (($obj !== null) ? $obj : _hx_anonymous(array()));
	}
}
