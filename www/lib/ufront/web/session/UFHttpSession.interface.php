<?php

interface ufront_web_session_UFHttpSession {
	function get_id();
	//;
	function init();
	function clear();
	function get($name);
	function set($name, $value);
	function exists($name);
	function remove($name);
	function isActive();
	function isReady();
	function close();
	function setExpiry($lifetime);
	function commit();
	function triggerCommit();
	function regenerateID();
	//;
}