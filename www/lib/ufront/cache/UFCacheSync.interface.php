<?php

interface ufront_cache_UFCacheSync {
	function getSync($id);
	function setSync($id, $value);
	function getOrSetSync($id, $fn = null);
	function removeSync($id);
	function clearSync();
	//;
}
