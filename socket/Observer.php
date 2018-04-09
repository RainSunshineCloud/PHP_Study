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

		//不阻塞主进程的方法1：交给init进程接管子进程
		// pcntl_signal(SIGCHLD, SIG_IGN);
		//不阻塞主进程的方法2：会不阻塞，但在执行该语句之前（即下一次循环）这个过程中有可能是僵尸。感觉没啥用
		// pcntl_wait($status,WNOHANG);
		// 不阻塞主进程的方法3：不会阻塞,与方法2差不多，使用declare在每执行一次低级语句都会检查一次是否有信号
		// declare(ticks = 1);
		// pcntl_signal(SIGCHLD,function () {
		// 	$status = '';
		// 	echo pcntl_wait($status);
		// });
	}
}



