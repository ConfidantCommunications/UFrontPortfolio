<?php

class ufront_web_result_TemplateSource extends Enum {
	public static function TFromEngine($path, $templatingEngine = null) { return new ufront_web_result_TemplateSource("TFromEngine", 1, array($path, $templatingEngine)); }
	public static function TFromString($str, $templatingEngine = null) { return new ufront_web_result_TemplateSource("TFromString", 0, array($str, $templatingEngine)); }
	public static $TNone;
	public static $TUnknown;
	public static $__constructors = array(1 => 'TFromEngine', 0 => 'TFromString', 2 => 'TNone', 3 => 'TUnknown');
	}
ufront_web_result_TemplateSource::$TNone = new ufront_web_result_TemplateSource("TNone", 2);
ufront_web_result_TemplateSource::$TUnknown = new ufront_web_result_TemplateSource("TUnknown", 3);
