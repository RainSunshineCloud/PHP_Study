<?php
/*
*类，用于依赖某些类
*/
class Superman
{
	public function __construct (SuperInterface $obj1,ManInterface $obj2)
	{

		return $this->obj = [$obj1,$obj2];
	}

	public function getPower ()
	{
		$this->obj[0] -> getPower();
	}

	public function eat ()
	{
		$this->obj[1] -> eat();
	}
}
/*
接口，用于定义需要的的类
*/
interface SuperInterface
{
	public function getPower();
}

interface ManInterface
{
	public function eat();
}
/*
*容器类
*/
class Container
{
 	private static $clo = [];
 	private static $objs = null;

	public static function register($name,$obj)
	{
		if ($obj instanceof Closure) {
			self::$clo[$name] = $obj;
		} else {
			self::$objs[$name] = $obj;
		}

	}


	public static function instance($name,$parm =[])
	{
		if ( !is_array($parm) ) {
			$parm = array($parm);
		}

		foreach ($parm as $k => $v) {

			if (isset(self::$clo[$v])) {
				$parm[$k] = call_user_func(self::$clo[$v]);
			} else {
				$parm[$k] = self::$objs[$v];
			}
		}
		if (isset(self::$clo[$name])) {

			return call_user_func_array(self::$clo[$name],$parm);
		} else {
			return self::$objs[$name];
		}
	}
}

/*
*具体类的实现
*/
class Fire implements SuperInterface
{
	public function getPower()
	{
		echo 'Fire';
	}
}

class Water implements SuperInterface
{
	public function getPower()
	{
		echo 'water';
	}
}
class Nuddle implements ManInterface
{
	public function eat()
	{
		echo 'nuddle';
	}
}

//容器注册
Container::register('Superman',function($obj1,$obj2){
	return new Superman($obj1,$obj2);
});

Container::register('fire',function (){
	return new Fire();
});

Container::register('water',function () {
	return new Water();
});
Container::register('nuddle',function (){
	return new Nuddle();
});

//实例化
$Superman = Container::instance('Superman',['water','nuddle']);

$Superman->getPower();
$Superman->eat();

