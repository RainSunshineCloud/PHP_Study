<?php

$errorstr = '';
$errorno = null;
$timeout = 30;
$socket = stream_socket_client('udp://127.0.0.1:8080',$errorno,$errorstr,30);

stream_socket_sendto($socket,"我上了你\n");
echo stream_socket_recvfrom($socket,200);