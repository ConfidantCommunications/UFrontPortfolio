<?php

// Generated by Haxe 3.4.4
class asys_net_Socket {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->createSocket();
	}}
	public $input;
	public $output;
	public $socket;
	public $host;
	public $port;
	public function createSocket() {
		$this->socket = new sys_net_Socket();
	}
	public function setStreams() {
		$this->output = tink_io__Sink_Sink_Impl_::ofOutput("socket output", $this->socket->output, null);
		$this->input = tink_io__Source_Source_Impl_::ofInput("socket input", $this->socket->input, null);
	}
	public function connect($host, $port) {
		$this->host = $host;
		$this->port = $port;
		$v = null;
		try {
			$this->socket->connect($host->instance, $port);
			$this->setStreams();
			$v = tink_core_Outcome::Success(tink_core_Noise::$Noise);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$v1 = Std::string($e);
				$v = tink_core_Outcome::Failure(new tink_core_TypedError(null, $v1, _hx_anonymous(array("fileName" => "Socket.hx", "lineNumber" => 49, "className" => "asys.net.Socket", "methodName" => "connect"))));
			}
		}
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($v));
	}
	public function close() {
		$this->socket->close();
	}
	public function setTimeout($timeout) {
		$this->socket->setTimeout($timeout);
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
	function __toString() { return 'asys.net.Socket'; }
}