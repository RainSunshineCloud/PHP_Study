<?php

// //CSPRNG 用于生成随机数
$key = random_bytes(6);//随机位数
$type = random_int(1,199);//随机数
// //相较于random，random_int产生重复的几率更小，但仍有重复的危险


// //hash
$logs = hash_algos();
// var_dump($logs);//返回密码算法列表
$context = hash_init($logs[0]);
$context_copy = hash_copy($context);

// var_dump(hash_equals('aaa','aaa'));//可防止时序攻击

// var_dump(hash_file($logs[0],'./curl.php'));//可生成证书。
// $logs = hash_hmac_algos();//7.2新增？
// var_dump($logs);
echo hash_hmac_file($logs[0],'./curl.php','aaa');//用于出售的加密证书
// echo hash_final($context);//生成摘要信息？
// echo hash_hkdf($logs[0],'333');//生成hash值


