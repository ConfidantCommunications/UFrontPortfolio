<?php

// Generated by Haxe 3.4.4
class tink_io__Worker_Worker_Impl_ {
	public function __construct(){}
	static $EAGER;
	static $pool;
	static function ensure($this1) {
		if($this1 === null) {
			return tink_io__Worker_Worker_Impl_::get();
		} else {
			return $this1;
		}
	}
	static function get() {
		return tink_io__Worker_Worker_Impl_::$pool[Std::random(tink_io__Worker_Worker_Impl_::$pool->length)];
	}
	static function work($this1, $task) {
		return $this1->work($task);
	}
	function __toString() { return 'tink.io._Worker.Worker_Impl_'; }
}
tink_io__Worker_Worker_Impl_::$EAGER = new tink_io__Worker_EagerWorker();
tink_io__Worker_Worker_Impl_::$pool = (new _hx_array(array(tink_io__Worker_Worker_Impl_::$EAGER)));