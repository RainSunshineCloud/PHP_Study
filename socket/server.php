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
			posix_getpid();
			sleep(10);
			echo TcpCommunicate::recv();
			TcpCommunicate::send('dsfds');
			TcpCommunicate::close();
			TcpServer::$close_server = true;//关掉子进程的监听
		default:
			Observer::waitChildProcess();
			break;
	}

});


TcpServer::createListen();

