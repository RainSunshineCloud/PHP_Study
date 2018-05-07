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
 	private static  $clo = [];
 	private static  $objs = null;
 	private static  $not_DI = [];
 	private static  $self_obj = null;

 	public function registers (array $array)
 	{
 		foreach ($array as $k => $v) {
 			$func = function (... $obj) use ($v) {
 				return new $v(... $obj);
 			} ;
 			self::register($k,$func);
 		}
 	
 	}
 	/**
 	 * @Author   RyanWu
 	 * @DateTime 2018-02-01
 	 * @param    注册名称      $name 注册名
 	 * @param    对象    $obj  注册的对象
 	 * @return   
 	 */
	public static function register($name,$obj)
	{
		if ($obj instanceof Closure) {
			static::$clo[$name] = $obj;
		} else {
			static::$objs[$name] = $obj;
		}


	}

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-02-01
	 * @param    string     $name register绑定的名称
	 * @param    array      $parm 该类依赖的名称
	 */
	public static function DI($name,$parm =[])
	{

		if ( !is_array($parm) ) {
			$parm = array($parm);
		}

		foreach ($parm as $k => $v) {
			//不用依赖的直接跳过
			if (in_array($v,self::$not_DI)) continue;
			//需要依赖的直接返回依赖的值
			if (isset(self::$clo[$v])) {
				$parm[$k] = call_user_func(self::$clo[$v]);
			} else {
				$parm[$k] = self::$objs[$v];
			}

		}

		$res = self::$clo[$name];

		if (isset(self::$clo[$name])) {

			return call_user_func_array(self::$clo[$name],$parm);
		} else {
			return self::$objs[$name];
		}

	}

	/**
	 * @Author   RyanWu
	 * @DateTime 2018-02-01
	 * @param    array     $arr  非依赖属性
	 */
	public static function NDI($arr)
	{
		$obj = new Container();
		if (!is_array($arr)) {
			$arr = [$arr];
		}
		self::$not_DI = $arr;
		return $obj;
	}
}

/*
*具体类的实现
*/
class Fire implements SuperInterface 
{
	public function public ()
	{

	}

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

// //容器注册1
// Container::register('Superman',function($obj1,$obj2){
// 	return new Superman($obj1,$obj2);
// });

Container::register('fire',function ($obj){
	return new Fire($obj);
});

// Container::register('water',function () {
// 	return new Water();
// });

// Container::register('nuddle',function (){
// 	return new Nuddle();
// });

//容器注册2
Container::registers([
	'Superman' => Superman::class,
	'fire' => Fire::class,
	'water' => Water::class,
	'nuddle' => Nuddle::class,
]);
	Container::DI('fire','water');
$Superman = Container::DI('Superman',['fire','nuddle']);

$Superman->getPower();
$Superman->eat();

