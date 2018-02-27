<?php

// Generated by Haxe 3.4.4
class ufront_cache_RequestCacheMiddleware implements ufront_app_UFMiddleware{
	public function __construct() {
		;
	}
	public $cacheConnection;
	public $cache;
	public function requestIn($ctx) {
		if($this->cache === null) {
			$this->cache = $this->cacheConnection->getNamespace("ufront.middleware.RequestCache");
		}
		if(strtolower($ctx->request->get_httpMethod()) === "get") {
			$uri = $ctx->request->get_uri();
			$this1 = $this->cache->get($uri);
			$ret = $this1->map(array(new _hx_lambda(array(&$ctx, &$uri), "ufront_cache_RequestCacheMiddleware_0"), 'execute'));
			return $ret->gather();
		} else {
			return ufront_core_SurpriseTools::success();
		}
	}
	public function responseOut($ctx) {
		if($this->cache === null) {
			$this->cache = $this->cacheConnection->getNamespace("ufront.middleware.RequestCache");
		}
		$tmp = null;
		$tmp1 = null;
		$tmp2 = null;
		if(strtolower($ctx->request->get_httpMethod()) === "get") {
			$tmp2 = $ctx->actionContext !== null;
		} else {
			$tmp2 = false;
		}
		if($tmp2) {
			$tmp1 = _hx_field($ctx->actionContext, "controller") !== null;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $ctx->actionContext->action !== null;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$tmp3 = ufront_cache_RequestCacheMiddleware::$contentTypesToCache;
			if($tmp3->indexOf($ctx->response->get_contentType(), null) > -1) {
				$controller = $ctx->actionContext->controller;
				$cls = Type::getClass($controller);
				$controllerMeta = haxe_rtti_Meta::getType($cls);
				$fieldMeta = haxe_rtti_Meta::getFields($cls);
				$fieldMeta1 = Reflect::field($fieldMeta, $ctx->actionContext->action);
				$tmp4 = null;
				if(!ufront_cache_RequestCacheMiddleware::hasCacheMeta($controllerMeta)) {
					$tmp4 = ufront_cache_RequestCacheMiddleware::hasCacheMeta($fieldMeta1);
				} else {
					$tmp4 = true;
				}
				if($tmp4) {
					$uri = $ctx->request->get_uri();
					$tmp5 = $this->cache;
					$f = new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($ctx->response));
					$this1 = $f;
					return tink_core__Future_Future_Impl_::_map($tmp5->set($uri, $this1), array(new _hx_lambda(array(&$ctx, &$uri), "ufront_cache_RequestCacheMiddleware_1"), 'execute'));
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
		$field = ufront_cache_RequestCacheMiddleware::$metaName;
		return _hx_has_field($meta, $field);
	}
	function __toString() { return 'ufront.cache.RequestCacheMiddleware'; }
}
ufront_cache_RequestCacheMiddleware::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => (new _hx_array(array((new _hx_array(array("cacheConnection", "ufront.cache.UFCacheConnection", ""))))))))));
ufront_cache_RequestCacheMiddleware::$contentTypesToCache = (new _hx_array(array("text/plain", "text/html", "text/xml", "text/css", "text/csv", "application/json", "application/javascript", "application/atom+xml", "application/rdf+xml", "application/rss+xml", "application/soap+xml", "application/xhtml+xml", "application/xml", "application/xml-dtd")));
function ufront_cache_RequestCacheMiddleware_0(&$ctx, &$uri, $result) {
	{
		if($result->index === 0) {
			$res = _hx_deref($result)->params[0];
			{
				$cachedResponse = $res;
				$ctx->messages->push(_hx_anonymous(array("msg" => "Loading " . _hx_string_or_null($uri) . " from cache", "pos" => _hx_anonymous(array("fileName" => "RequestCacheMiddleware.hx", "lineNumber" => 74, "className" => "ufront.cache.RequestCacheMiddleware", "methodName" => "requestIn")), "type" => ufront_log_MessageType::$MTrace)));
				$ctx->response->clearContent();
				$ctx1 = $ctx->response;
				$ctx1->set_contentType($cachedResponse->get_contentType());
				$ctx2 = $ctx->response;
				$ctx2->set_redirectLocation($cachedResponse->get_redirectLocation());
				$ctx->response->charset = $cachedResponse->charset;
				$ret1 = null;
				if($cachedResponse->status !== null) {
					$ret1 = $cachedResponse->status;
				} else {
					$ret1 = 200;
				}
				$ctx->response->status = $ret1;
				{
					$c = $cachedResponse->getCookies()->iterator();
					while($c->hasNext()) {
						$c1 = $c->next();
						$ctx->response->setCookie($c1);
						unset($c1);
					}
				}
				$headers = $cachedResponse->getHeaders();
				{
					$key = $headers->keys();
					while($key->hasNext()) {
						$key1 = $key->next();
						$ctx3 = $ctx->response;
						$ctx3->setHeader($key1, $headers->get($key1));
						unset($key1,$ctx3);
					}
				}
				$ctx4 = $ctx->response;
				$ctx4->write($cachedResponse->getBuffer());
				$ctx5 = $ctx;
				$ctx5->completion = $ctx5->completion | 1 << ufront_web_context_RequestCompletion::$CRequestHandlersComplete->index;
			}
		}
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
function ufront_cache_RequestCacheMiddleware_1(&$ctx, &$uri, $result) {
	{
		if($result->index === 1) {
			$e = _hx_deref($result)->params[0];
			{
				$msg = "Failed to save cache for " . _hx_string_or_null($uri) . ": ";
				$msg1 = _hx_string_or_null($msg) . Std::string($e);
				$ctx->messages->push(_hx_anonymous(array("msg" => $msg1, "pos" => _hx_anonymous(array("fileName" => "RequestCacheMiddleware.hx", "lineNumber" => 121, "className" => "ufront.cache.RequestCacheMiddleware", "methodName" => "responseOut")), "type" => ufront_log_MessageType::$MError)));
			}
		}
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
}
