<?php

$arr = $_POST;

unset($arr['oauth_signature']);

arsort($arr,SORT_STRING);

$str = '';
foreach ($arr as $k=>$v) {
	$str .= $k.'='.urlencode($v).'&';
}
$str = rtrim($str,'&');

$method='POST';
$url = urlencode('http://www.otherweb.com/oauth.php?action=request');
$baseString = $method.'&'.$str;

// $str = join($arr,'');
// echo $str;
var_dump(base64_encode(hash_hmac('sha1',$baseString,'7dfbb03a0e',true)));

include_once './OAuthServer.class.php';
include_once './Store.interface.php';
include_once './FileStore.class.php';

if (isset($_POST['token'])) {
	$token = OAuthServer::checkRequestToken($_POST['token']);
	header('Location:http://www.myweb.com/oauth.php?token='.$token);
	exit;
} 


$file_store = new FileStore;

new OAuthServer($file_store);