<?php
require('./Download.class.php');
$file = '../audio/2.mp4';
$name = time().'.mp4';
$obj = new FileDownload();
$flag = $obj->download($file, $name);
//$flag = $obj->download($file, $name, true); // 断点续传
if(!$flag){
    echo 'file not exists';
}
?>