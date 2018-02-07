<?php
/*
static 和self在用法上的差别
1.static 只能用于调用静态类或静态属性
2.使用static是调用的类，self则是定义时的类;


__CLASS__ 则是定义时的类名；
*/

class Obj1
{
	public static function test()
	{
		echo __CLASS__;
	}

	public static function getTest()
	{
		 self::test();
	}
}


class Obj2 extends Obj1
{
	public static function test()
	{
		echo __CLASS__;
	}


}


Obj2::test();


