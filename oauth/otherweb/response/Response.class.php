<?php

class Response
{	


	/**
	 * 响应token
	 */
	public static function  Token($store,$stepName)
	{

		$token = urlencode(OAuthProvider::generateToken(30));
		$secret = urlencode(OAuthProvider::generateToken(10));
		$method = 'check'.$stepName.'Token';
		while ($store->$method($token)) {
			$token = urlencode(OAuthProvider::generateToken(30));
			$secret = urlencode(OAuthProvider::generateToken(10));
		}

		return ['token'=>$token,'secret'=>$secret];
	}

	/*
		相应json数据
	 */
	public static function Json()
	{

	}
}