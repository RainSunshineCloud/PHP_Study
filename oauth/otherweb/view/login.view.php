<?php
	$token = $_GET['token'];
?>
<html>
	<head></head>
	<body>
		<form action='./oauth.php?action=Oauthorize&oauth_token='<?=$token?> method='post'>
			<input name='username'>
			<input type='password' name='pwd'>
			<input type='submit'>
		</form>
	</body>
</html>