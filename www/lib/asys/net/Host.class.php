<?php

// Generated by Haxe 3.4.4
class asys_net_Host {
	public function __construct($name) {
		if(!php_Boot::$skip_constructor) {
		$this->ipTrigger = new tink_core_FutureTrigger();
		$this->host = $name;
		$this->instance = new sys_net_Host($name);
		$this->address = Std::string($this->instance);
		$this->ipTrigger->trigger($this->instance->ip);
	}}
	public $host;
	public $ip;
	public $address;
	public $ipTrigger;
	public $instance;
	public function processIp($err, $address, $_ = null) {
		$tmp = null;
		if($this->host !== $address) {
			$tmp = $err !== null;
		} else {
			$tmp = true;
		}
		if($tmp) {
			$this->ipTrigger->trigger(0);
			return;
		}
		$this->address = $address;
		$parts = _hx_explode(".", $address);
		$res = 0;
		$res = $res + (Std::parseInt($parts[0]) << 24);
		$res = $res + (Std::parseInt($parts[1]) << 16);
		$res = $res + (Std::parseInt($parts[2]) << 8);
		$res = $res + Std::parseInt($parts[3]);
		$this->ipTrigger->trigger($res);
	}
	public function toString() {
		return $this->address;
	}
	public function reverse() {
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst(tink_core_TypedError::catchExceptions((property_exists($this->instance, "reverse") ? $this->instance->reverse: array($this->instance, "reverse")), null, _hx_anonymous(array("fileName" => "Host.hx", "lineNumber" => 57, "className" => "asys.net.Host", "methodName" => "reverse")))));
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
	static function localhost() {
		return isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
	}
	function __toString() { return $this->toString(); }
}
