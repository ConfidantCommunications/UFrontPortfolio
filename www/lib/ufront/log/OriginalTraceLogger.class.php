<?php

// Generated by Haxe 3.4.2
class ufront_log_OriginalTraceLogger implements ufront_app_UFInitRequired, ufront_app_UFLogHandler{
	public function __construct() {
		;
	}
	public $originalTrace;
	public function init($app) {
		$this->originalTrace = (property_exists($app, "originalTrace") ? $app->originalTrace: array($app, "originalTrace"));
		return ufront_core_SurpriseTools::success();
	}
	public function dispose($app) {
		return ufront_core_SurpriseTools::success();
	}
	public function log($ctx, $appMessages) {
		{
			$_g = 0;
			$_g1 = $ctx->messages;
			while($_g < $_g1->length) {
				$msg = $_g1[$_g];
				$_g = $_g + 1;
				$this->originalTrace($msg->msg, $msg->pos);
				unset($msg);
			}
		}
		return ufront_core_SurpriseTools::success();
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
	function __toString() { return 'ufront.log.OriginalTraceLogger'; }
}
