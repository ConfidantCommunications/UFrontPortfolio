<?php

class ufront_remoting_RemotingError extends Enum {
	public static function RApiFailure($remotingCallString, $data) { return new ufront_remoting_RemotingError("RApiFailure", 6, array($remotingCallString, $data)); }
	public static function RApiNotFound($remotingCallString, $errorMessage) { return new ufront_remoting_RemotingError("RApiNotFound", 1, array($remotingCallString, $errorMessage)); }
	public static function RClientCallbackException($remotingCallString, $e) { return new ufront_remoting_RemotingError("RClientCallbackException", 3, array($remotingCallString, $e)); }
	public static function RHttpError($remotingCallString, $responseCode, $responseData) { return new ufront_remoting_RemotingError("RHttpError", 0, array($remotingCallString, $responseCode, $responseData)); }
	public static function RNoRemotingResult($remotingCallString, $responseData) { return new ufront_remoting_RemotingError("RNoRemotingResult", 5, array($remotingCallString, $responseData)); }
	public static function RServerSideException($remotingCallString, $e, $stack) { return new ufront_remoting_RemotingError("RServerSideException", 2, array($remotingCallString, $e, $stack)); }
	public static function RUnknownException($e) { return new ufront_remoting_RemotingError("RUnknownException", 7, array($e)); }
	public static function RUnserializeFailed($remotingCallString, $troubleLine, $err) { return new ufront_remoting_RemotingError("RUnserializeFailed", 4, array($remotingCallString, $troubleLine, $err)); }
	public static $__constructors = array(6 => 'RApiFailure', 1 => 'RApiNotFound', 3 => 'RClientCallbackException', 0 => 'RHttpError', 5 => 'RNoRemotingResult', 2 => 'RServerSideException', 7 => 'RUnknownException', 4 => 'RUnserializeFailed');
	}
