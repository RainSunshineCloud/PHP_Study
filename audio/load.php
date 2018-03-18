<?php
set_time_limit(0);
$size = filesize('./2.mp4');
$speed = 100000;
$fp = fopen('./2.mp4','rb');

header('content-type:application/octet-stream');
header('Cache-control:public');
header('content-Disposition:attachment;filename=js');

if (isset($_SERVER['HTTP_RANGE'])) {
	$range = $_SERVER['HTTP_RANGE'];
	list($start,$end) = explode('-',$range);
	if (empty($end)) {
		$end = $size - 1;
	}
	$start = ltrim($start,'bytes=') + 1;
	$length = $end - $start + 1;
	file_put_contents('./test',$start,FILE_APPEND);
	header('HTTP/1.1 206 partial content');
	// header('HTTP/1.1 200 OK');
	header('Accept-Ranges:bytes');
	header('content-length:'.$length);
	header('content-range:bytes '.$start.'-'.$end.'/'.$size);
	fseek($fp,1);
} else {
	header('HTTP/1.1 200 OK');
	header('Content-Length:'.$size);
	// file_put_contents('./test',$size,FILE_APPEND);
}



while (!feof($fp)) {
	echo fread($fp,$speed);
	flush();
	ob_flush();
	sleep(1);

}
fclose($fp);

