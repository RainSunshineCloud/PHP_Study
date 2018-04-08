<?php
/*
使用socket_read 能够通过\r或者\n强制输出，使用socket_recv则不会
msg_waitall 会阻塞等等到返回数据 获取的数据会从队列移除
msg_downwait 不会阻塞 ，获取的数据会从队列移除
msg_peek 不会组塞，数据不会从队列移除
msg_oob 暂时不知
 */
include './Observer.php';
class TcpServer
{
	public   $serv_ip = '127.0.0.1';
	public   $serv_port = 8080;
	private  $listen_socket = null;
	private  $communicate_socket = null;
	public   $end_flag = "EOF;\r\n";
	public   $close_server = false;
	public   $max_length = 10;
	public   $communicate_flag = PHP_NORMAL_READ;
	public   $send_flag = MSG_EOF;
	public   $send_msg = '';


	/**
	 * 创建一个监听器
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * @return   mix    返回用户定义的关闭后的信息
	 */
	public function createListen ()
	{
		
		$this->listen_socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
		socket_bind($this->listen_socket,$this->serv_ip,$this->serv_port);
		socket_listen($this->listen_socket);
		while(true) {
			$this->communicate_socket = socket_accept($this->listen_socket);
			Observer::bind(['server'=>$this]);
			Observer::acceptClient();
			if ($this->close_server === true) {
				break;
			}
		}
		socket_close($this->communicate_socket);
		return $this->setCloseMsg();
	}
}


$obj = new TcpServer();

$obj->createListen();



