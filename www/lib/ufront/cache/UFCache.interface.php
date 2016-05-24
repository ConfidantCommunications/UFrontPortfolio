<?php

interface ufront_cache_UFCache {
	function get($id);
	function set($id, $value);
	function getOrSet($id, $fn = null);
	function remove($id);
	function clear();
	//;
}
