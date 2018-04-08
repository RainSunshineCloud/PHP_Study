<?php
/*
观察者模式
 */
class Observer 
{	
	static $observer_obj = [];

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


	public static function waitChildProcess()
	{
		$status = '';
		pcntl_wait($status,WNOHANG);
	}
}



