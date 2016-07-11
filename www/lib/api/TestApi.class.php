<?php

class api_TestApi extends ufront_api_UFApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function getJson($path) {
		$pJson = "nothing";
		if(file_exists($path)) {
			$pJson = sys_io_File::getContent($path);
		}
		$parsed = haxe_Json::phpJsonDecode($pJson);
		$navItems = new _hx_array(array());
		$i = 1;
		$arr = $parsed->items;
		{
			$_g = 0;
			while($_g < $arr->length) {
				$thisItem = $arr[$_g];
				++$_g;
				if(_hx_equal($thisItem[0], 0) && $i === 1) {
					$navItems->push("<h2>" . Std::string($thisItem[1]) . "</h2><ul>");
				} else {
					if(_hx_equal($thisItem[0], 0)) {
						$navItems->push("</ul><h2>" . Std::string($thisItem[1]) . "</h2><ul>");
					} else {
						$navItems->push("<li><a href=\"/portfolio/" . Std::string($thisItem[2]) . "/\" rel=\"pushstate\">" . Std::string($thisItem[1]) . "</a></li>");
					}
				}
				$i++;
				unset($thisItem);
			}
		}
		$navItems->push("</ul>");
		$sp = $navItems->join("");
		return ufront_core_SurpriseTools::asGoodSurprise($sp);
	}
	public function getItem($id) {
		$path = "portfolioStuff/" . _hx_string_or_null($id) . ".html";
		$result = "nothing";
		if(file_exists($path)) {
			$result = sys_io_File::getContent($path);
		}
		return ufront_core_SurpriseTools::asGoodSurprise($result);
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'api.TestApi'; }
}
api_TestApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("asyncApi" => (new _hx_array(array("api.AsyncTestApi"))))), "fields" => _hx_anonymous(array("getJson" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getItem" => _hx_anonymous(array("returnType" => (new _hx_array(array(3)))))))));
