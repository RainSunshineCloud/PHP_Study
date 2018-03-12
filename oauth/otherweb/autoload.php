<?php

function __autoload($className)
{
	$class_dir = [
	 	'./storage/',
	 	'./response/',
	 	'./server/'
	];

	$interface_dir = './interface/';//接口目录

	foreach ($class_dir as $v) {
		$path = $v.$className.'.class.php';
		if (file_exists($path)) {
			include_once $path;
			return ;
		}	
	}

	$path = $interface_dir.$className.'.interface.php';

	if (file_exists($path)) {
		include_once $path;
		return ;
	}
}

