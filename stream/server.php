<?php


$socket = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);
if (!$socket) {
  echo "$errstr ($errno)<br />\n";
} else {
  while ($conn = stream_socket_accept($socket)) {
  	$str = stream_socket_recvfrom($conn,400,STREAM_PEEK);
  	stream_socket_sendto($conn,"sdfs\n");
   	echo $str;
    fclose($conn);
  }
}
