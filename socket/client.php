<?php
class TcpClient
{
	public static $serv_ip = '127.0.0.1';
	public static $serv_port = 8080;
	public static $max_length = 100;
	public static $recv_flags = MSG_WAITALL;
	public static $send_flags = MSG_EOF;
	protected static $socket = null;
	public static $send_msg = "ssEOF;\r\n";

	/**
	 * 创建一个TcpClient
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * @return   str    返回错误信息
	 */
	public static function create ($call_back) 
	{	
		try{
			self::$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
			if ( self::$socket == false ) {
				 throw new TcpException();
			}
			$res = socket_connect(self::$socket,self::$serv_ip,self::$serv_port);

			if ( $res == false ) {
				  throw new TcpException();
			}

			$res = socket_send(self::$socket ,self::$send_msg,strlen(self::$send_msg),self::$send_flags);

			if ( $res == false ) {
				  throw new TcpException();
			}

			while($res = socket_recv(self::$socket, $recv_buf, self::$max_length, self::$recv_flags)) {
				$call_back($recv_buf);
			}

			if ( $res === false ) {
				  throw new TcpException();
			}
			socket_close(self::$socket);

		} catch (TcpException $e) {
			return $e -> getMessage();
		}
	}


}


TcpClient::create(function ($recv_buf) {
	echo $recv_buf;
});
