<?php

class Server
{
	private  $serv = null;
	protected $redis = Redis();
	public function __construct()
	{
		$this->serv = new swoole_websocket_server('0.0.0.0',8081);
		$this->serv->set([
			'worker_num'=>8,
			'daemonize'=>false
		]);
		$this->redis = new Redis();
		$this->redis->connect('localhost','6379');
		$this->serv->on('open',[$this,'onOpen']);
		$this->serv->on('message',[$this,'onMessage']);
		$this->serv->on('close',[$this,'onClose']);
		$this->serv->start();
	}


	public function onOpen($serv,$frame)
	{

		$this->redis->set($frame->fd.'connect',1);//开启连接

		// $serv->push($frame->fd,);

	}

	public function onMessage($serv,$frame)
	{	
		$from
		$key = $from.'-message-'.$to;
		$content = $frame->data;
		$storage = [
			'time'=>time(),
			'status'=>1,
			'from'=>$from,
			'to'=>$,
			'content'=>$content,
		];
		$this->redis->hSet($key,$status,json_encode($storage));
		
		$this->redis->hIncrBy($to,$from,1);
		$serv->push($frame->fd,$frame->data);
	}

	public function onClose($serv,$frame)
	{
		$this->redis->set($frame->fd.'connect',2);//关闭连接
	}

}



$server = new Server();


