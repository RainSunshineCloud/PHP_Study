<?php

class TranSaction
{
	static public  $error = [];//错误代码放置位置
	static private $obj = '';	//当前对象
	static private $is_ok = true;	//用于isOk方法判断是否ok
	static private $begin = false;	//是否开启事务

	/**
	 * 开启事务
	 * @param  [callback]  $call_back 要执行的sql语句的回调
	 * @param  [str] 	   $errormsg  错误提示
	 * @return [obj]		返回当前实例
	 */
	static public function begin($call_back,$errormsg='')
	{
		if (self::$begin) {
			DB::beginTranSation();
		}

		if (self::$is_ok && !$call_back()) 
		{
			self::$error = $errormsg;	
		}
		return self::getInstence();
	}

	/**
	 * 判断当前事务是否有问题
	 * @return obj 返回当前对象
	 */
	static public function isOk()
	{
		if (empty(self::$error)) {
			self::$is_ok = false;
			DB::rollBack();
		} 
		return self::getInstence();
		
	}

	/**
	 * @return obj 返回单例
	 */
	static private function getInstence() 
	{
		if (empty($this->obj)) {
			$this->obj = new self();
		}
		return $this->obj;
	}

	/**
	 * @param  bool  $break 返回错误码或直接停止代码运行，并直接输出
	 * @return array 返回错误码
	 */
	static public function end($break = false)
	{
		if (self::$is_ok) {
			DB::rollBack();
		}
		if ($break ) {
			print_r(self::$error);
			exit;
		}
		return self::$error;
	}
}