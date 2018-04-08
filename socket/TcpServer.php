<?php
/*
使用socket_read 能够通过\r或者\n强制输出，使用socket_recv则不会
msg_waitall 会阻塞等等到返回数据 获取的数据会从队列移除
msg_downwait 不会阻塞 ，获取的数据会从队列移除
msg_peek 不会组塞，数据不会从队列移除
msg_oob 暂时不知
 */

class TcpServer
{
	public  static $serv_ip = '127.0.0.1';
	public  static $serv_port = 8080;
	private static $listen_socket = null;
	public  static $communicate_socket = null;
	public  static $close_server = false;

	private function __construct(){}
	/**
	 * 创建一个监听器
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * @return   mix    返回用户定义的关闭后的信息
	 */
	public static function createListen ()
	{
		
		self::$listen_socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
		socket_bind(self::$listen_socket,self::$serv_ip,self::$serv_port);
		socket_listen(self::$listen_socket);
		while(true) {
			self::$communicate_socket = socket_accept(self::$listen_socket);
			Observer::acceptClient();
			Observer::waitChildProcess();
			if (self::$close_server === true) {
				break;
			}
		}
		socket_close(self::$communicate_socket);
	}
}




