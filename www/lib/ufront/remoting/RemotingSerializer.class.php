<?php

class ufront_remoting_RemotingSerializer extends haxe_Serializer {
	public function __construct($dir) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
		$this->direction = $dir;
		$this->uploads = new haxe_ds_StringMap();
	}}
	public $uploads;
	public $direction;
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
	static function run($obj, $direction) {
		$s = new ufront_remoting_RemotingSerializer($direction);
		$s->serialize($obj);
		return $s->toString();
	}
	function __toString() { return 'ufront.remoting.RemotingSerializer'; }
}
