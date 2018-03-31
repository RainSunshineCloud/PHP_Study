<?php

//jsonp 无法使用post请求，只能使用get请求

$arr =['a'=>1,'b'=>2,'c'=>3];
$str = $_GET['callback'].'('.json_encode($arr).')';

echo $str;