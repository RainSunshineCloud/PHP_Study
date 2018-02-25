<?php
// 在序列化时，无法将方法序列化，只能序列化属性
//json化与序列化一样，均只对属性有效。而且json化时不是在原有的对象或类上重写，而是直接生成一个新的类。
// 故而使用类时最好直接使用文件导入。

class A
{
	public $name = 3;
	public function getName()
	{
		echo $this->name;
	}
}

$obj = new A();
$str = serialize($obj);
// $str = json_encode($obj);
file_put_contents('./str',$str);

$str = file_get_contents('./str');

$obj = unserialize($str);
// $obj = json_decode($str);
var_dump($obj);
$obj -> getName();
