<?php

class ufront_remoting_RemotingDirection extends Enum {
	public static $RDClientToServer;
	public static $RDServerToClient;
	public static $__constructors = array(0 => 'RDClientToServer', 1 => 'RDServerToClient');
	}
ufront_remoting_RemotingDirection::$RDClientToServer = new ufront_remoting_RemotingDirection("RDClientToServer", 0);
ufront_remoting_RemotingDirection::$RDServerToClient = new ufront_remoting_RemotingDirection("RDServerToClient", 1);
