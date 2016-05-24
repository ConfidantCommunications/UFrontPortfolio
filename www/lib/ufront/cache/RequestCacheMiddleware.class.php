<?php

class ufront_cache_RequestCacheMiddleware implements ufront_app_UFMiddleware{
	public function __construct() {}
	public $cacheConnection;
	public $cache;
	public function requestIn($ctx) {
		if(!php_Boot::$skip_constructor) {
		if($this->cache === null) {
			$this->cache = $this->cacheConnection->getNamespace("ufront.middleware.RequestCache");
		}
		if(strtolower($ctx->request->get_httpMethod()) === "get") {
			$uri = $ctx->request->get_uri();
			return tink_core__Future_Future_Impl_::map($this->cache->get($uri), array(new _hx_lambda(array(&$ctx, &$uri), "ufront_cache_RequestCacheMiddleware_0"), 'execute'), null);
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}}
	public function responseOut($ctx) {
		if($this->cache === null) {
			$this->cache = $this->cacheConnection->getNamespace("ufront.middleware.RequestCache");
		}
		if(strtolower($ctx->request->get_httpMethod()) === "get" && $ctx->actionContext !== null && _hx_field($ctx->actionContext, "controller") !== null && $ctx->actionContext->action !== null) {
			if(ufront_cache_RequestCacheMiddleware::$contentTypesToCache->indexOf($ctx->response->get_contentType(), null) > -1) {
				$controller = $ctx->actionContext->controller;
				$cls = Type::getClass($controller);
				$controllerMeta = haxe_rtti_Meta::getType($cls);
				$fieldMeta = Reflect::field(haxe_rtti_Meta::getFields($cls), $ctx->actionContext->action);
				if(ufront_cache_RequestCacheMiddleware::hasCacheMeta($controllerMeta) || ufront_cache_RequestCacheMiddleware::hasCacheMeta($fieldMeta)) {
					$uri = $ctx->request->get_uri();
					return tink_core__Future_Future_Impl_::_map($this->cache->set($uri, ufront_cache_RequestCacheMiddleware_1($this, $cls, $controller, $controllerMeta, $ctx, $fieldMeta, $uri)), array(new _hx_lambda(array(&$cls, &$controller, &$controllerMeta, &$ctx, &$fieldMeta, &$uri), "ufront_cache_RequestCacheMiddleware_2"), 'execute'));
				}
			}
		}
		return ufront_core_SurpriseTools::success();
	}
	public function invalidate() {
		return $this->cache->clear();
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static $hnamespace = "ufront.middleware.RequestCache";
	static $metaName = "cacheRequest";
	static $contentTypesToCache;
	static function hasCacheMeta($meta) {
		return _hx_has_field($meta, ufront_cache_RequestCacheMiddleware::$metaName);
	}
	function __toString() { return 'ufront.cache.RequestCacheMiddleware'; }
}
ufront_cache_RequestCacheMiddleware::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("cacheConnection", "ufront.cache.UFCacheConnection", ""))))))))));
ufront_cache_RequestCacheMiddleware::$contentTypesToCache = (new _hx_array(array("text/plain", "text/html", "text/xml", "text/css", "text/csv", "application/json", "application/javascript", "application/atom+xml", "application/rdf+xml", "application/rss+xml", "application/soap+xml", "application/xhtml+xml", "application/xml", "application/xml-dtd")));
function ufront_cache_RequestCacheMiddleware_0(&$ctx, &$uri, $result) {
	{
		switch($result->index) {
		case 0:{
			$res = _hx_deref($result)->params[0];
			{
				$cachedResponse = $res;
				$ctx->messages->push(_hx_anonymous(array("msg" => "Loading " . _hx_string_or_null($uri) . " from cache", "pos" => _hx_anonymous(array("fileName" => "RequestCacheMiddleware.hx", "lineNumber" => 74, "className" => "ufront.cache.RequestCacheMiddleware", "methodName" => "requestIn")), "type" => ufront_log_MessageType::$MTrace)));
				$ctx->response->clearContent();
				$ctx->response->set_contentType($cachedResponse->get_contentType());
				$ctx->response->set_redirectLocation($cachedResponse->get_redirectLocation());
				$ctx->response->charset = $cachedResponse->charset;
				if($cachedResponse->status !== null) {
					$ctx->response->status = $cachedResponse->status;
				} else {
					$ctx->response->status = 200;
				}
				if(null == $cachedResponse->getCookies()) throw new HException('null iterable');
				$__hx__it = $cachedResponse->getCookies()->iterator();
				while($__hx__it->hasNext()) {
					unset($c);
					$c = $__hx__it->next();
					$ctx->response->setCookie($c);
				}
				$headers = $cachedResponse->getHeaders();
				if(null == $headers) throw new HException('null iterable');
				$__hx__it = $headers->keys();
				while($__hx__it->hasNext()) {
					unset($key);
					$key = $__hx__it->next();
					$ctx->response->setHeader($key, $headers->get($key));
				}
				$ctx->response->write($cachedResponse->getBuffer());
				$ctx->completion |= 1 << ufront_web_context_RequestCompletion::$CRequestHandlersComplete->index;
			}
		}break;
		default:{}break;
		}
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_cache_RequestCacheMiddleware_1(&$__hx__this, &$cls, &$controller, &$controllerMeta, &$ctx, &$fieldMeta, &$uri) {
	{
		$f = tink_core__Future_Future_Impl_::sync($ctx->response);
		return $f;
	}
}
function ufront_cache_RequestCacheMiddleware_2(&$cls, &$controller, &$controllerMeta, &$ctx, &$fieldMeta, &$uri, $result) {
	{
		switch($result->index) {
		case 1:{
			$e = _hx_deref($result)->params[0];
			$ctx->messages->push(_hx_anonymous(array("msg" => "Failed to save cache for " . _hx_string_or_null($uri) . ": " . Std::string($e), "pos" => _hx_anonymous(array("fileName" => "RequestCacheMiddleware.hx", "lineNumber" => 121, "className" => "ufront.cache.RequestCacheMiddleware", "methodName" => "responseOut")), "type" => ufront_log_MessageType::$MError)));
		}break;
		default:{}break;
		}
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
