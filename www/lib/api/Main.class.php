<?php

class api_Main {
	public function __construct(){}
	static function main() {
		$s = "{\x0A      \"name\": \"Haxe\",\x0A      \"tags\": [\"awesome\"]\x0A    }";
		$o = haxe_Json::phpJsonDecode($s);
		haxe_Log::trace($o->name, _hx_anonymous(array("fileName" => "TestApi.hx", "lineNumber" => 17, "className" => "api.Main", "methodName" => "main")));
		haxe_Log::trace($o->tags[0], _hx_anonymous(array("fileName" => "TestApi.hx", "lineNumber" => 19, "className" => "api.Main", "methodName" => "main")));
	}
	function __toString() { return 'api.Main'; }
}
