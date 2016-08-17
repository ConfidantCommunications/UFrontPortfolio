<?php

class api_TestApi extends ufront_api_UFApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function getJson($path) {
		$theJson = "nothing";
		if(file_exists($path)) {
			$theJson = sys_io_File::getContent($path);
		}
		return ufront_core_SurpriseTools::asGoodSurprise($theJson);
	}
	public function getItem($slug) {
		$path = "portfolioStuff/" . _hx_string_or_null($slug) . ".html";
		$jsonPath = "portfolio.json";
		$portfolioItemHtml = "nothing";
		$portfolioJson = "";
		if(file_exists($path)) {
			$portfolioItemHtml = sys_io_File::getContent($path);
		}
		if(file_exists($path)) {
			$portfolioJson = sys_io_File::getContent($jsonPath);
		}
		$pj = haxe_Json::phpJsonDecode($portfolioJson);
		{
			$_g1 = 0;
			$_g = $pj->items->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				haxe_Log::trace(_hx_string_rec($i, "") . ":" . _hx_string_or_null(_hx_array_get($pj->items, $i)->slug) . ":" . _hx_string_or_null($slug), _hx_anonymous(array("fileName" => "TestApi.hx", "lineNumber" => 52, "className" => "api.TestApi", "methodName" => "getItem")));
				if(_hx_array_get($pj->items, $i)->slug === $slug) {
					$prevLink = null;
					$nextLink = null;
					$pll = null;
					$nll = null;
					if($i === 0) {
						$prevLink = "#";
						$pll = "You are at the first item in the portfolio.";
					} else {
						$prevLink = "/portfolio/" . _hx_string_or_null(_hx_array_get($pj->items, $i - 1)->slug) . "/";
						$pll = _hx_array_get($pj->items, $i - 1)->title;
					}
					if($i >= $pj->items->length - 1) {
						$nextLink = "#";
						$nll = "You are at the last item in the portfolio.";
					} else {
						$nextLink = "/portfolio/" . _hx_string_or_null(_hx_array_get($pj->items, $i + 1)->slug) . "/";
						$nll = _hx_array_get($pj->items, $i + 1)->title;
					}
					$portfolioItem = new api_PortfolioItem($portfolioItemHtml, _hx_array_get($pj->items, $i)->title, $prevLink, $nextLink, $pll, $nll);
					return ufront_core_SurpriseTools::asGoodSurprise($portfolioItem);
					unset($prevLink,$portfolioItem,$pll,$nll,$nextLink);
				}
				unset($i);
			}
		}
		return ufront_core_SurpriseTools::asGoodSurprise(new api_PortfolioItem($portfolioItemHtml, "error", "error", "error", "error", "error"));
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'api.TestApi'; }
}
api_TestApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("asyncApi" => (new _hx_array(array("api.AsyncTestApi"))))), "fields" => _hx_anonymous(array("getJson" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getItem" => _hx_anonymous(array("returnType" => (new _hx_array(array(3)))))))));
