<?php

function array_save_php_file($filename='',$arr,$filepath='./')
{
	//防止文件提交格式不对
	$filepath = rtrim(str_replace('\\','/',$filepath),'/').'/';

	//防止没有该文件夹
	if (!is_dir($filepath))
		mkdir($filepath,0777,true);
	//防止没有该文件
	$filename = $filepath.$filename;
	if (!is_file($filename))
		touch($filename);

	//往文件放数据
	
	$str = '<?php return ['.join($arr,',').'];';
	file_put_contents($filename,$str);

}

$arr = [1,1];

array_save_php_file('get.php',$arr);

$arr = include './get.php';

var_dump($arr);