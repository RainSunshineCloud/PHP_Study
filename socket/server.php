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
	 * 处理连接后要处理的事情
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * 
	 */
	public function communicationHandle() {
		$call_back = function ($recv_buf) {
			echo $recv_buf;
		};
		$this -> createCommunication($call_back);
	}

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
			$this->communicationHandle();
			if ($this->close_server === true) {
				break;
			}

		}
		socket_close($this->communicate_socket);
		return $this->setCloseMsg();
	}

	/**
	 * 创建一个消息接收器
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * @param    callBack $call_back 	接收消息后的处理函数,实参为收到的数据
	 * @return   null     				创建一个接收消息的接收器
	 */
	public function createCommunication ($call_back) 
	{
		$all_msg = '';
		while ($recv_buf = socket_read($this->communicate_socket,$this->max_length,$this->communicate_flag)) {	
			


			$all_msg .= $recv_buf;
			$call_back($recv_buf);
			if ( $this->isEndFlag($all_msg) ) {
				break;
			}
		}
		socket_send($this->communicate_socket, $this->send_msg, strlen($this->send_msg),$this->send_flag);
		socket_close($this->communicate_socket);
	}

	/**
	 * 判断文件是否传递完毕
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 * @param    [type]     $msg [description]
	 * @return   [type]          [description]
	 */
	private function isEndFlag ($msg)
	{
		if ($this->end_flag == null ) {
			return false;
		}
		$start = -strlen($this->end_flag);
		if (substr($msg,$start) == $this->end_flag ) {
			return true;
		} else {
			return false;
		}		
	}

	/**
	 * 设置关闭服务器后要传递的信息
	 * @Author   RyanWu
	 * @DateTime 2018-03-26
	 */
	public function setCloseMsg($msg)
	{

	}

}






