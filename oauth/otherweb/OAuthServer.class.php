<?php

class OAuthServer
{	
	public $store = null;//存储方式
	public $access_parm = [];//access_token附加参数
	public $oauthorize_parm = [];//oauthorize_token附加参数
	protected $host = 'http://www.otherweb.com/';
	protected $access_url = 'oauth.php?action=access';
	protected $oauthorize_url = 'login.php?action=oauthorize';
	private $step = [
			'request',
			'oauthorize',
			'access'
	];

	private $res = false; //OAuth验证结果

	/*
	*@param  obj  $store 符合 Store的接口
	*/
	public function __construct (Store $store)
	{	


		$this->access_url = $this->host.$this->access_url;
		$this->oauthorize_url = $this->host.$this->oauthorize_url;
		$this->store = $store;

		if (isset($_GET['action']) && in_array($_GET['action'],$this->step) ) {
			$this->action = $_GET['action'];
		} else {
			$this->action = 'Api';
		}

		/*
		oauth验证
		*/
		// if ($this->action == 'oauthorize') {
		// 	$token = $this->response();
		// 	$this->checkToken();
		// 	header('callback');
		// 	exit;
		// } 

		/*
		其他验证
		*/
		try {
			$this->provider = $provider = new OAuthProvider();
			$provider->consumerHandler([$this,'checkKey']);
			$provider->timestampNonceHandler([$this,'checktimestampNonce']);
			$provider->tokenHandler([$this,'checkToken']);
			if ($this->action == 'request') {
				$this->provider->isRequestTokenEndpoint(true);	
			}
			$provider->checkOAuthRequest();
			$this->response();
			
		

		} catch (OAuthException $e) {

			echo $e->getMessage();	
		}

	}

	/*
	* 检查CK和secret
	*/
	public function checkKey($provider) {
		
		$secret = $this->store->getcustomerSecret($provider->consumer_key);
		if (empty($secret)) {
			return OAUTH_CONSUMER_KEY_UNKNOWN;
		}
		$provider->consumer_secret = '7dfbb03a0e';
		return OAUTH_OK;
		

	}	

	/*
	* 检查token
	*/
	public function checkToken($provider) {
		
		switch ($this->action) {

			case 'oauthorize':

			case 'access':

			default:


		}
		return OAUTH_OK;
	}

	/*
	*检查时间戳和随机字符串
	*/
	public function checktimestampNonce($provider)
	{
		var_dump($provider);
		if (empty($provider->nonce)) {
			return 'false';
		}
		if (empty($provider->timestamp)) {
			return 'false';
		}
		return OAUTH_INVALID_SIGNATURE;
		return OAUTH_OK;
	}

	/*
	* 响应数据
	*/
	public function response () 
	{

		switch ( $this->action ) {
			case 'request':

				$token = urlencode($this->provider -> generateToken(10));
				$secret = urlencode($this->provider -> generateToken(16));
				$this->store->storeRequestToken(['token'=>$token,'secret'=>$secret]);

				$arr = [
					'login_url'=>$this->getUrl('oauthorize_url'),
					'request_token' => $token,
					'request_secret' => $secret,
				];
					
				echo http_build_query($arr);
	
				break;
			case 'oauthorize':
				return urlencode(OAuthProvider::generateToken(21));
				break;
			case 'access':
				$token = urlencode($this->provider -> generateToken(10));
				$secret = urlencode($this->provider -> generateToken(16));
			    $arr = [
					'access_token' => $token,
					'access_secret' => $secret,
			    ];
			    echo http_build_query($arr);
			    break;
		}


	}


	/*
	* 获取url
	*/
	private function getUrl($actionUrl)
	{
		
		$parm = str_replace('_url','_parm',$actionUrl);
		if (!empty($this->$parm)) {
			$parm = '&'.http_build_query($this->$parm);
		} else  {
			$parm = '';
		}
		return $this->$actionUrl.$parm;	
	}

}