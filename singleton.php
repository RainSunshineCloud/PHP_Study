<?php
class Singleton 
{	

	static $obj = null;
	/**
	 * 拒绝实例化
	 * @Author   RyanWu
	 * @DateTime 2018-01-30
	 */
	private  function __construct ()
	{

	}

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-01-30
	 * @param    方法     $classname 类名
	 * 
	 */
	public 	static function getObj($classname)
	{

		if (self::$obj[$classname] === null) {
			self::$obj[$classname] = new Api();
		}
		return self::$obj[$classname];
	}


}


function Single($classname)
{
	return Singleton::getObj($classname);
}



class Api
{
	public function get($name)
	{	

		echo $name.'给你一个吻！';
	}
}

Single('Api')->get('你妹');




