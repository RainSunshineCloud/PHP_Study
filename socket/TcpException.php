<?php

class TcpException extends Exception
{
	public function __construct() 
	{
		$this->code = socket_last_error();
		$this->message = socket_strerror($this->code);
	}
}