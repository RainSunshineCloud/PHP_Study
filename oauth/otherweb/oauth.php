<?php

$uri = $_GET['p'];
$provider = new OAuthProvider();
switch ( $uri ) {
	case 'request_token':
		echo $provider->generateToken(16);
		break;
	case 'oauthorize':
		echo 222;
		break;
	case 'access_token':
		echo 333;
		break;
	case 'api':
		echo 444;
		break;

}



//



