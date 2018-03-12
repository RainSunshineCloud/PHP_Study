<?php
class FileStore implements Store
{
	public $data_dir = './data/';


	public function storeRequestToken($parm)
	{

		file_put_contents($this->data_dir.'RequestToken',json_encode($parm));
	
	}
	public function storeAppToken($parm)
	{

		file_put_contents($this->data_dir.'App',json_encode($parm));
	
	}
	public function storeAccessToken($parm)
	{
		file_put_contents($this->data_dir.'AccessToken',json_encode($parm));
	}

	public function storeOAuthorizeToken($parm)
	{
		file_put_contents($this->data_dir.'OAuthorizeToken',json_encode($parm));
	}

	public function getRequestSecret($parm = [])
	{
		$arr = json_decode(file_get_contents($this->data_dir.'RequestToken'),true);
		return $arr['secret'];
	}

	public function getAccessToken($parm = [])
	{
		return json_decode(file_get_contents($this->data_dir.'AccessToken'),true);
	}

	public function getOAuthorizeToken($parm = [])
	{
		return json_decode(file_get_contents($this->data_dir.'OAuthorizeToken'),true);
	}

	public function getCustomerSecret($parm)
	{
		return json_decode(file_get_contents($this->data_dir.'hostmsg'),true)['ST'];
	}

		public function checkRequestToken($parm = [])
	{
		
		$arr = json_decode(file_get_contents($this->data_dir.'RequestToken'),true);
		// var_dump($arr);

		// var_dump(urlencode($parm));

		if ($arr['token'] == $parm) {
			return true;
		} 
		return false;
	}

	public function checkAccessToken($parm )
	{
		return json_decode(file_get_contents($this->data_dir.'AccessToken'),true);
	}

	public function checkOAuthorizeToken($parm)
	{
		$arr = json_decode(file_get_contents($this->data_dir.'OAuthorizeToken'),true);
		if (isset($arr[$parm])) {
			return true;
		}

	}

	public function checkCustomerSecret($parm)
	{
		return json_decode(file_get_contents($this->data_dir.'hostmsg'),true)['ST'];
	}


	public function checkAppToken($parm)
	{
		$arr = json_decode(file_get_contents($this->data_dir.'OAuthorizeToken'),true);
		if (isset($arr[$parm])) {
			return true;
		}

	}


}
