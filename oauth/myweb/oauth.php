<?php

$info = [
		"CK"=> "e8daf15a130a1664d2d5395379d260",
		"ST"=> "7dfbb03a0e",
		"req_url"=> "http://www.otherweb.com/oauth.php?action=request",
		"acc_url"=> "http://www.otherweb.com/oauth.php?action=access"
	];


try{

	$oauth = new OAuth($info['CK'],$info['ST'],OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_FORM);

	if (isset($_GET['action']) && $_GET['action'] == 'request_token'){
		

		$arr = $oauth->getRequestToken($info['req_url']);
		// var_dump($arr);
		// exit;
		header('Location:'.$arr['login_url'].'&token='.$arr['token']);
	
	} else {
		$arr = $oauth->getAccessToken($info['acc_url']);
		var_dump($arr);
	}

} catch (OAuthException $e) {
	
	echo $e->getMessage();
}






