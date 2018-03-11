<?php
	$token = $_GET['token'];
?>
<html>
	<head></head>
	<body>
		<form action='./oauth.php' method='post'>
			<input name='username'>
			<input type='hidden' name='token' value='<?= $token?>'>
			<input type='password' name='pwd'>
			<input type='submit'>
		</form>
	</body>
</html>