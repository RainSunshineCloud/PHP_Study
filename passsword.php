<?php

// //CSPRNG 用于生成随机数
// $key = random_bytes(6);//随机位数
// $type = random_int(1,199);//随机数
// //相较于random，random_int产生重复的几率更小，但仍有重复的危险


// //hash
// $logs = hash_algos();
// // var_dump($logs);//返回密码算法列表
// $context = hash_init($logs[0]);
// $context_copy = hash_copy($context);

// var_dump(hash_equals('aaa','aaa'));//可防止时序攻击

// var_dump(hash_file($logs[0],'./curl.php'));//可生成证书。
// $logs = hash_hmac_algos();//7.2新增？
// var_dump($logs);
// echo hash_hmac_file($logs[0],'./curl.php','aaa');//用于出售的加密证书
// echo hash_final($context);//生成摘要信息？
// echo hash_hkdf($logs[0],'333');//生成hash值
// $str = "qqqqdsfdsqq";
// $key = "Secr3taaaaaaaaaaaaaaaaaa";
$cipher = MCRYPT_3DES;
$mode = 'cfb';
// $size = mcrypt_get_iv_size($cipher,$mode);//获取iv要生成的字符大小。
// $iv = mcrypt_create_iv($size,MCRYPT_RAND);//创建初始向量（类似加盐值）
// echo $str = mcrypt_encrypt($cipher,$key,$str,$mode,$iv);//密码
// echo '<br>';
// echo mcrypt_decrypt($cipher,$key,$str,$mode,$iv);
echo mcrypt_get_block_size($cipher,$mode);
/*
MCRYPT_MODE_ECB 电码本，相同明文加密成相同密文，可通过不断变化key得到不同的密文。相对不安全，以块为单位进行加密
MCRYPT_MODE_CBC  密码分组连接，通过iv得到不同的密文，相对更安全。以块为单位进行加密
MCRYPT_MODE_CFB  密码反馈，和CBC相同，但加密的块更小
MCRYPT_MODE_OFB  输出返回，和CFB一样，只是不会造成一个块加密失败，后面的块也加密失败。


 */
