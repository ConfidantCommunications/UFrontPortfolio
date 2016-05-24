<?php

class Server {
	public function __construct(){}
	static function main() {
		$ufrontApp = new ufront_app_UfrontApplication(_hx_anonymous(array("indexController" => _hx_qtype("controller.HomeController"), "remotingApi" => _hx_qtype("api.ApiContext"), "defaultLayout" => "layout.html")));
		$ufrontApp->executeRequest();
	}
	function __toString() { return 'Server'; }
}
