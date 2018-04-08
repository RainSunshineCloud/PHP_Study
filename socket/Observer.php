<?php
/*
观察者模式
 */
class Observer 
{	
	static $observer_obj = [];
	static $client = [];
	static $parm = [];

	/**
	 * 事件绑定
	 * @Author   RyanWu
	 * @DateTime 2018-04-08
	 * @param    [type]     $callback [description]
	 * @return   [type]               [description]
	 */
	public static function register($callback)
	{
		self::$observer_obj[] = $callback;
	}

	public static function bind(array $parm)
	{
		foreach ($parm as $k => $v) {
			self::$parm[] = $parm;	
		}
	}

	/**
	 * 监听器，监听接收客户端请求
	 * @Author   RyanWu
	 * @DateTime 2018-04-08
	 */
	public static function acceptClient()
	{	
		foreach (self::$observer_obj as $obj) {
			$obj();
		}

	}
}


Observer::register(function () {
	$str = '';
	$obj = self::$parm['server'];
	while (true) {
		$str .= socket_read($obj->communicate_socket, 100);	
		if (substr_compare($str, $obj->end_flag, -4,4,true)) {
			break;
		}
	}
	socket_send($obj->communicate_socket, $buf, strlen($buf),MSG_EOF);
	socket_close($obj->communicate_socket);
});


