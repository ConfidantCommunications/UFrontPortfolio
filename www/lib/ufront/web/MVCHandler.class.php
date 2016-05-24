<?php

class ufront_web_MVCHandler implements ufront_app_UFRequestHandler{
	public function __construct($indexController) {
		if(!php_Boot::$skip_constructor) {
		$this->indexController = $indexController;
	}}
	public $indexController;
	public function handleRequest($ctx) {
		$_g = $this;
		return tink_core__Future_Future_Impl_::_tryFailingFlatMap($this->processRequest($ctx), array(new _hx_lambda(array(&$_g, &$ctx), "ufront_web_MVCHandler_0"), 'execute'));
	}
	public function processRequest($context) {
		$context->actionContext->handler = $this;
		$controller = $context->injector->_instantiate($this->indexController);
		$resultFuture = tink_core__Future_Future_Impl_::_tryMap($controller->execute(), array(new _hx_lambda(array(&$context, &$controller), "ufront_web_MVCHandler_1"), 'execute'));
		return $resultFuture;
	}
	public function executeResult($context) {
		try {
			return $context->actionContext->actionResult->executeResult($context->actionContext);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$p_methodName = "executeResult";
				$p_lineNumber = -1;
				$p_fileName = "";
				$p_customParams = (new _hx_array(array("actionContext")));
				$p_className = Type::getClassName(Type::getClass($context->actionContext));
				return tink_core__Future_Future_Impl_::sync(tink_core_Outcome::Failure(ufront_web_HttpError::wrap($e, null, _hx_anonymous(array("fileName" => "MVCHandler.hx", "lineNumber" => 70, "className" => "ufront.web.MVCHandler", "methodName" => "executeResult")))));
			}
		}
	}
	public function toString() {
		return "ufront.web.MVCHandler";
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
	function __toString() { return $this->toString(); }
}
function ufront_web_MVCHandler_0(&$_g, &$ctx, $r) {
	{
		return $_g->executeResult($ctx);
	}
}
function ufront_web_MVCHandler_1(&$context, &$controller, $result) {
	{
		$context->actionContext->actionResult = $result;
		return tink_core_Noise::$Noise;
	}
}
