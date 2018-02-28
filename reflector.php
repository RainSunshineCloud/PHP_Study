<?php
/**
*@const D
*@return null
*
*/
final class Test
{
	public static $a=1;
	public static $b=2;
	protected $c;
	const D = [1,2];
	public  function __construct()
	{
		echo 11;
	}

	/*
	*测试1
	*/
	public static function d()
	{
		//测试2
		echo 11;
	}

	//测试3
	protected function e(array $b)
	{
		echo 333;
	}
}

$classes = new ReflectionClass('test');

//反射出类相关数据为字符串,主要分为静态和非静态。方法包含形参限制
$str = Reflection::export($classes,true);
echo $str;
echo '<hr>';

//反射出类相关方法2
echo $classes->__toString();
echo '<hr>';

//反射出类的修饰符
$modifier = $classes->getModifiers();
echo $modifier;
$arr = Reflection::getModifierNames($modifier);
var_dump($arr);
echo '<hr>';

//反射出类名
$className = $classes->getName();
echo $className;
echo '<hr>';

//反射出常量的值
$mix = $classes->getConstant('D');

//反射出所有类的值
$mix = $classes->getConstants();
var_dump($mix);
echo '<hr>';

//反射出构造函数
$constructor = $classes->getConstructor();
var_dump($constructor);
echo '<hr>';

//反射出类的属性,只用通过类修改的属性值才会被反射出来
Test::$b = 3;
$classes->b = 4;
$properties = $classes->getDefaultProperties();
var_dump($properties);
echo '<hr>';

//获取类的注释，其他注释获取不到，类的注释格式必须标准
$docComment = $classes->getDocComment();
var_dump($docComment);
echo '<hr>';

//获取最后一行的行数
$endLine = $classes->getEndLine();
var_dump($endLine);
echo '<hr>';
//获取起始行的行数
$startLine = $classes->getStartLine();
var_dump($startLine);
echo '<hr>';

//获取定义类的文件名(绝对路径)
$fileName = $classes->getFileName();
var_dump($fileName);
echo '<hr>';

//重新生成一个对象，其中__construct的参数由该值传入
$obj = $classes->newInstance('aaa');
var_dump($obj::$b);
echo '<hr>';

//通过ReflectionClassConstant查看返回的备注
$obj = new ReflectionClassConstant('test','D');
$docComment = $obj->getDocComment();
var_dump($docComment);
echo '<hr>';
$name = $obj->getName();
$arr = $obj->getvalue();
echo $name;
var_dump($arr);
