<?php

class ufront_remoting_RemotingUnserializer extends haxe_Unserializer {
	public function __construct($buf, $uploads = null) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct($buf);
		if($uploads !== null) {
			$this->uploads = $uploads;
		} else {
			$this->uploads = new haxe_ds_StringMap();
		}
	}}
	public $uploads;
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
	function __toString() { return 'ufront.remoting.RemotingUnserializer'; }
}
