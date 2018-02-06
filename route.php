<?php


Route::post('/b',function(){
	return 222;
});

Route::put('/e',function(){
	return 111;
});
Route::put('/c',function(){

	$request = $_SERVER;
	return $request;
});




class Route 
{

	private static $obj = null;
	public  static $err = [];

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-29
	 * @param    调用静态类     $method [description]
	 * @param    [type]     $args   [description]
	 * @return   [type]             [description]
	 */
	public static function __callStatic($method,$args) {
	    if (self::$obj === null ) {
			self::$obj = new Response();
		}
		
		self::$obj->vertifyMethod($method,$args[0],$args[1],self::$err);
	}
}

class Response
{	
	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-29
	 * @param    string     $method 请求方法
	 *
	 */
	public static function vertifyMethod($method,$path,$handle,&$error){

		$method = strtoupper($method);
		if ($method !== $_SERVER['REQUEST_METHOD']) {
			return false;
		} 
		//请求方式
	    if (empty($_SERVER['REQUEST_METHOD']) ) {
	        self::$error = [
	            'errMsg'=> '客户端请求方式有误；',
	            'errorNo'=> 100,
	       ];
	       return false;
	       exit;
	    } 

	    //请求方法
	    $request = strtoupper($_SERVER['REQUEST_METHOD']);
	    if (!in_array($request,['GET','POST','PUT','DELETE'])) {
	        self::$error = [
	            'errMsg'=> '客户端请求方式有误；',
	            'errorNo'=> 100,
	       ];
	       return false;
	       exit;
	    }

	    self::pathRoute($path,$handle);
	}


	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-29
	 * @param    string     $path      路径
	 * @param    mix        $handle    处理方式
	 * @return   根据路径处理
	 */
	public static function pathRoute($path,$handle)
	{

		if ($_SERVER['REQUEST_URI'] == $path) {
			self::out(self::handle($handle));
			exit;

		} else {
			return false;
		}
	}

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-29
	 * @param    mix                $handle 用户定义的处理方式 
	 * @return   mix 				使用函数处理结果
	 */
	public static function handle($handle) {
		//选择处理方式
	    switch (true) {
	    	case $handle instanceof Closure://匿名函数
	    		return $handle();

	        case is_string($handle) && strpos($handle,'@') !==false://方法名
	            $arr = explode($handle,'@');
	            return ((new $arr[0])->$arr[1]);


	        case function_exists((string)$handle)://函数名
	            return $handle();


	        default://其他情况
	            self::$error = [
	                'errMsg'=>'处理请求的方式只能是函数和方法',
	                'errorNo'=>101,
	            ];
	            return false;

	    }
	}

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-29
	 * @param    mix     $res 输出方式
	 * @return   [type]       
	 */
	public static function out($res) {

		switch ( gettype($res) ) {
			case 'object':
			case 'array' :
				echo "<pre>";  
				    print_r($res);  
				echo "</pre>"; 
			break;
			default:
				echo $res;
		}
	}


}
