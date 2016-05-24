<?php

class ufront_log_MessageType extends Enum {
	public static $MError;
	public static $MLog;
	public static $MTrace;
	public static $MWarning;
	public static $__constructors = array(3 => 'MError', 1 => 'MLog', 0 => 'MTrace', 2 => 'MWarning');
	}
ufront_log_MessageType::$MError = new ufront_log_MessageType("MError", 3);
ufront_log_MessageType::$MLog = new ufront_log_MessageType("MLog", 1);
ufront_log_MessageType::$MTrace = new ufront_log_MessageType("MTrace", 0);
ufront_log_MessageType::$MWarning = new ufront_log_MessageType("MWarning", 2);
