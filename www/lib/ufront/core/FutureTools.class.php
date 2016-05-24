<?php

class ufront_core_FutureTools {
	public function __construct(){}
	static function asFuture($data) {
		return tink_core__Future_Future_Impl_::sync($data);
	}
	function __toString() { return 'ufront.core.FutureTools'; }
}
