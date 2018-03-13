<?php

include './DCT.class.php';
include './CompareImg.class.php';
include './PHash.class.php';
include './functions.php';
$file = ['./1.jpg','./2.jpg','./3.jpg','./4.jpg','./5.jpg','./6.jpg','./7.jpg','./8.jpg'];
	$arr1 = CompareImg::getCompareImg('./1.jpg',['x'=>'32','y'=>'32'])->getGray();//获取灰度值
	$arr1 = DCT::getDCT($arr1);
	$arr1 = PHash::DCTHash($arr1);

foreach ($file as $v) {
	$arr = CompareImg::getCompareImg($v,['x'=>'32','y'=>'32'])->getGray();
	$arr = DCT::getDCT($arr);
	$arr = PHash::DCTHash($arr);
	if ( abs($arr[0] - $arr1[0]) < 1 ) {
		$sort[] = getDistance($arr1[1],$arr[1]);
		$sort[] = $v;
	} 
}
$arr = [];
for (){

}
var_dump($sort);


