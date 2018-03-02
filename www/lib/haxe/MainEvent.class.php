<?php

// Generated by Haxe 3.4.4
class haxe_MainEvent {
	public function __construct($f, $p) {
		if(!php_Boot::$skip_constructor) {
		$this->f = $f;
		$this->priority = $p;
		$this->nextRun = -1;
	}}
	public $f;
	public $prev;
	public $next;
	public $nextRun;
	public $priority;
	public function delay($t) {
		$tmp = null;
		if($t === null) {
			$tmp = -1;
		} else {
			$tmp = Sys::time() + $t;
		}
		$this->nextRun = $tmp;
	}
	public function stop() {
		if($this->f === null) {
			return;
		}
		$this->f = null;
		$this->nextRun = -1;
		if($this->prev === null) {
			haxe_MainLoop::$pending = $this->next;
		} else {
			$this->prev->next = $this->next;
		}
		if($this->next !== null) {
			$this->next->prev = $this->prev;
		}
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
	function __toString() { return 'haxe.MainEvent'; }
}