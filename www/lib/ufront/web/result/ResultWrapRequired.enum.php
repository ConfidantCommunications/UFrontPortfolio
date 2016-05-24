<?php

class ufront_web_result_ResultWrapRequired extends Enum {
	public static $WRFuture;
	public static $WROutcome;
	public static $WRResultOrError;
	public static $__constructors = array(0 => 'WRFuture', 1 => 'WROutcome', 2 => 'WRResultOrError');
	}
ufront_web_result_ResultWrapRequired::$WRFuture = new ufront_web_result_ResultWrapRequired("WRFuture", 0);
ufront_web_result_ResultWrapRequired::$WROutcome = new ufront_web_result_ResultWrapRequired("WROutcome", 1);
ufront_web_result_ResultWrapRequired::$WRResultOrError = new ufront_web_result_ResultWrapRequired("WRResultOrError", 2);
