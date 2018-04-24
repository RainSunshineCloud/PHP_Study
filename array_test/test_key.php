<?php
//php7以后遍历数组指针不会后移，php56会后移一次
$arr = [1,2,3];
echo key($arr);
foreach($arr as $v){
}
echo key($arr);
