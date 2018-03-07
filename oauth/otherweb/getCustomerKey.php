<?php

$fp = fopen('/dev/urandom','r');
$str = md5(fgets($fp,32));
fclose($fp);
$str .= uniqid(mt_rand(),true);

echo json_encode([substr($str,0,32),substr($str,32)]);
