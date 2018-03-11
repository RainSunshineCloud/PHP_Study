<?php

class FileStore implements Store
{

	public function storeRequestToken($parm)
	{
		file_put_contents('./RequestToken',json_encode($parm));
	}

	public function storeAccessToken($parm)
	{
		file_put_contents('./AccessToken',json_encode($parm));
	}

	public function storeOAuthorizeToken($parm)
	{
		file_put_contents('./OAuthorizeToken',json_decode($parm));
	}

	public function getRequestToken($parm = [])
	{
		return json_decode(file_get_contents('./RequestToken'),true);
	}

	public function getAccessToken($parm = [])
	{
		return json_decode(file_get_contents('./AccessToken'),true);
	}

	public function getOAuthorizeToken($parm = [])
	{
		return json_decode(file_get_contents('./OAuthorizeToken'),true);
	}

	public function getCustomerSecret($parm)
	{
		return json_decode(file_get_contents('./hostmsg'),true)['ST'];
	}
}
