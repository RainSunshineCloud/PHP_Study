<html>
<h1 id='my'>dsf</h1>
<button onClick='getData()'>请求www.test2.com</button>
<script src='http://www.test2.com/jquery.js'></script>
<script>
	//受同源策略影响无法请求
	// $.ajax({
	// 	url:'http://www.test2.com/app.php',
	// 	dataType:'json',
	// 	data: 'a = 1',
	// 	success: function(data){
	// 		console.log(data);
	// 	}
	// });

	//jsonp 请求
	function getData()
	{
		$.ajax({
			url:'http://www.test2.com/app.php',
			dataType:'jsonp',
			data: 'a = 1',
			jsonp: 'callback',
			type: 'post',
			success: function(data){

				alert(data.a);
			},
			error: function () {
				
			}
		});
	}
	

</script>
	
<html>