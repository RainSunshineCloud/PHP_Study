<<<<<<< HEAD
<?php
$fp = stream_socket_client("tcp://127.0.0.1:8000", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "sdfdssfdksljfks\n");
    fclose($fp);
}
=======
<?php

$errorstr = '';
$errorno = null;
$timeout = 30;
$socket = stream_socket_client('udp://127.0.0.1:8080',$errorno,$errorstr,30);

stream_socket_sendto($socket,"我上了你\n");
echo stream_socket_recvfrom($socket,200);
>>>>>>> 4fe70687231886788d082012aaaac654e45f0143
