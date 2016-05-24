<?php

interface ufront_web_upload_UFFileUpload {
	//;
	//;
	//;
	//;
	function getBytes();
	function getString($encoding = null);
	function writeToFile($filePath);
	function process($onData, $partSize = null);
	//;
}
