<?php

/*
创建出一个进程
在创建进程的瞬间相当于做了个快照，快照照完后子进程就不再使用父进程的数据，但父进程可以监听子进程
 */

$i = 2;
$pid = pcntl_fork();

switch ($pid) {
	case -1:
		exit('创建失败');
	case 0 :
		echo '子进程';
		for (;$i < 10;$i++) {
			echo $i."\n";
			sleep(1);
		}
		break;
	default:
		for (;$i < 10;$i++) {
			echo $i."\n";
			sleep(1);
		}
		echo posix_getpid()."\n";//获取进程号
		pcntl_wait($status);//等待子进程成为僵尸进程
		echo pcntl_wifexited($status);
}