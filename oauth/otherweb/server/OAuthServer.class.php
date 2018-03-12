<?php

class OAuthServer
{	
	use CheckParam;
	public $store = null;//存储方式
	public $access_parm = [];//access_token附加参数
	public $oauthorize_parm = [];//oauthorize_token附加参数
	protected $host = 'http://www.otherweb.com/';
	protected $access_url = 'oauth.php?action=access';
	protected $oauthorize_url = 'oauth.php?action=login';
	protected $stepName = [
		'app',
		'request',
		'oauthorize',
		'access'
	];

	/*
	*@param  obj  $store 符合 Store的接口
	*/
	public function __construct (Store $store)
	{	

		$this->access_url = $this->host.$this->access_url;
		$this->oauthorize_url = $this->host.$this->oauthorize_url;

		$this->action =$action= isset($_GET['action'])?strtolower($_GET['action']):'getApi';
		$this->store = $store;

		try {
			$this->provider = new OAuthProvider();
			$this->provider->timestampNonceHandler([$this,'checktimestampNonce']);
			$this->provider->consumerHandler([$this,'checkKeyAndSecret']);
			$this->provider->tokenHandler([$this,'checkRequestToken']);
			echo $this->$action();

		} catch (OAuthException $e) {

			echo $this->provider->reportProblem($e);
		}

	}



	public function app()
	{
		$data = Response::Token($this->store,$this->action);
		$method = 'store'.$this->action.'Token';
		$this->store->$method($data);
		return http_build_query($data);
	}


	public function request()
	{
		
		$this->provider->isRequestTokenEndpoint(true);	
		$this->provider->checkOAuthRequest();
		$data = Response::Token($this->store,$this->action);
		$method = 'store'.$this->action.'Token';
		$this->store->$method($data);
		$data['login_url'] = $this->oauthorize_url;
		header('Locaton:http://www.baidu.com');
		return http_build_query($data);
	}


	public function oauthorize()
	{
		$res = $this->checkOAuthorizeToken();
		if (!$res) {
			return 'fuck hack';
		}
		$data = Response::Token($this->store,$this->action);
		$method = 'store'.$this->action.'Token';
		$this->store->$method($data);
		return http_build_query($data);
	}


	public function access()
	{
		$this->provider->checkOAuthRequest();
		$data = Response::Token($this->store,$this->action);
		$method = 'store'.$this->action.'Token';
		$this->store->$method($data);
		return http_build_query($data);
	}


	public function getApi()
	{

	}
}