<?php
include './autoload.php';

if (isset($_GET['action'])&&$_GET['action'] !='login') {
	var_dump($_GET);
	new OAuthServer(new FileStore());

}else {

	if ($_GET['action']== 'login') {
		include './view/login.view.php';
	}

}
