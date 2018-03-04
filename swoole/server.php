<?php

class Server
{
	private  $serv = null;
	public function __construct()
	{
		$this->serv = new swoole_server('0.0.0.0',8080);
		$this->serv->set([
			'worker_num'=>8,
			'daemonize'=>false
		]);

		$this->serv->on('start',[$this,'onStart']);
		$this->serv->on('connect',[$this,'onConnect']);
		$this->serv->on('receive',[$this,'onReceive']);
		$this->serv->on('close',[$this,'onClose']);

		$this->serv->start();
	}



	public function onStart($serv)
	{
		echo "start\n";
	}


	public function onConnect($serv,$fd,$from_id)
	{
		echo $from_id.'=>'.$fd."\n";
		$serv->send($fd,'hello'.$fd);
	}

	public function onReceive($serv,$fd,$from_id,$data)
	{
		echo $fd.'=>'.$data."\n";
		$serv->send($fd,$data);
	}

	public function onClose($serv,$fd,$from_id)
	{
		echo $fd."close"."\n";
	}

}



$server = new Server();


