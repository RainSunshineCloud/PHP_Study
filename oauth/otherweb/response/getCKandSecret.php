<?php

function new_consumer_key() {
    $fp = fopen('/dev/urandom','rb');
    $entropy = fread($fp, 32);
    fclose($fp);
    $entropy .= uniqid(mt_rand(), true);
    $hash = sha1($entropy);

    return [
	    	'CK'=>substr($hash,0,30),
	    	'ST'=>substr($hash,30,10),
	    	'req_url'=>'www.other.com/oauth.php?action=request',
	    	'acc_url'=>'www.other.com/oauth.php?action=access',
	    	'oauthorize_url'=>'www.other.com/oauth.php?action=oauthorize',
    	];
}


$str = json_encode(new_consumer_key());
file_put_contents('./hostmsg',$str);

echo $str;
