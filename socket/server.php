<?php
include './Observer.php';
include './TcpCommunicate.php';
include './TcpServer.php';
include './TcpException.php';

//注册事件

Observer::register(function (){
	$pid = pcntl_fork();
	TcpCommunicate::$socket = TcpServer::$communicate_socket;
	switch ($pid) {
		case -1:
			break;
		case 0:
			echo 1;
			posix_getpid();
			TcpCommunicate::recv();
			sleep(10);
			TcpCommunicate::send('dsfds');
			TcpCommunicate::close();
			exit;//记住子进程一定要杀掉，否则会出现多个子进程
		default:
			break;
	}

});


TcpServer::createListen();

