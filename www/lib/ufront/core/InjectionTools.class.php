<?php

class ufront_core_InjectionTools {
	public function __construct(){}
	static function listMappings($injector, $arr = null, $prefix = null) {
		if($prefix === null) {
			$prefix = "";
		}
		return (new _hx_array(array("Injector mappings not available unless compiled with -debug.")));
	}
	function __toString() { return 'ufront.core.InjectionTools'; }
}
