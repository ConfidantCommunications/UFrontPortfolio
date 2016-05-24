<?php

class ufront_app_DefaultUfrontClientConfiguration {
	public function __construct(){}
	static function get() {
		return _hx_anonymous(array("indexController" => _hx_qtype("ufront.app.DefaultUfrontController"), "urlRewrite" => true, "basePath" => "/", "remotingPath" => "/", "disableBrowserTrace" => false, "controllers" => CompileTimeClassList::get("null,true,ufront.web.Controller"), "apis" => CompileTimeClassList::get("null,true,ufront.api.UFApi"), "clientActions" => CompileTimeClassList::get("null,true,ufront.web.client.UFClientAction"), "viewEngine" => _hx_qtype("ufront.view.HttpViewEngine"), "templatingEngines" => ufront_view_TemplatingEngines::$all, "viewPath" => "/view/", "defaultLayout" => null, "sessionImplementation" => _hx_qtype("ufront.web.session.VoidSession"), "requestMiddleware" => (new _hx_array(array())), "responseMiddleware" => (new _hx_array(array())), "errorHandlers" => (new _hx_array(array(new ufront_web_ErrorPageHandler()))), "authImplementation" => _hx_qtype("ufront.auth.NobodyAuthHandler")));
	}
	function __toString() { return 'ufront.app.DefaultUfrontClientConfiguration'; }
}
