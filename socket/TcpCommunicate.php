<?php

class TcpCommunicate 
{
	public static $msg;
	public static $socket;
	public static $length = 10;
	public static $flags = PHP_NORMAL_READ;
	public static $send_flags = MSG_EOF;
	public static $str = '';
	public static $end_flag = "EOF;\n\r";

	public static function send($msg)
	{
		self::$msg = $msg;
		if (!substr_compare(self::$msg, self::$end_flag, -4,4,true)) {
			self::$msg.=self::$end_flag;
		}
		socket_send(self::$socket,self::$msg, strlen(self::$msg), self::$send_flags);
	}

	public static function recv()
	{
		while (true) {
			self::$str .= socket_read(self::$socket,self::$length,self::$flags);
			if (substr_compare(self::$str, self::$end_flag, -4,4,true)) {
				break;
			}
		}

		return self::$str;

	}

	public static function close()
	{
		socket_shutdown(self::$socket,1);
	}
}