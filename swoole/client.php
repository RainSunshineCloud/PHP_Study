<?php

ini_set('memory_limit','8000M');
class Client
{
	private $client = null;

	public function __construct()
	{
		$this->client = new swoole_client(SWOOLE_SOCK_TCP);
	}

	public function connect()
	{
		if (!$this->client->connect('127.0.0.1',8080,1)) {
			echo $this->client->errMsg[$this->client->errCode];
		}

		fwrite(STDOUT,'请输入msg:');
		$msg = fgets(STDIN);
		$this->client->send($msg);
		$msg = $this->client->recv();
		echo 'get message'.$msg;
	}
}


$client = new Client();
$client->connect();