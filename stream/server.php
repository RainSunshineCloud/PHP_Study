<<<<<<< HEAD
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
=======
<?php
$errorstr = '';
$errorno = null;
$timeout = 300;
// $socket = stream_socket_server('tcp://127.0.0.1:8081',$errorno,$errorstr,$timeout);

// while($fp = stream_socket_accept($socket,$timeout)) {
// 	echo fgets($fp,200);
// 	echo stream_socket_sendto($fp,"你上了我\n");
// }


$timeout = 3;
$socket = stream_socket_server('udp://127.0.0.1:8080',$errorno,$errorstr,STREAM_SERVER_BIND);

while($fp = stream_socket_recvfrom($socket,100,0,$peer)) {
	echo $fp;
	stream_socket_sendto($socket,"你上了我\n",0,$peer);
}


/*
在使用tcp连接时因为三次握手，所以必须使用stream_socket_accept来接受客户端发送的连接请求，建立连接。

*/
>>>>>>> 4fe70687231886788d082012aaaac654e45f0143
