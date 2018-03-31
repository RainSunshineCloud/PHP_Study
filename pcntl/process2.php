<?php
/*
为0时不发送信号
由于时从上到下执行的，所以发送信号要在前面
 */
function fork() {
	$pid = pcntl_fork(); 
	switch ($pid) {
		case -1:
			exit('出错了');

		case 0:
			echo '我是儿子';

			
		default:
			echo posix_getpid();
			pcntl_wait($status);
			echo '退出';
	}
}	




pcntl_signal(SIGALRM,'fork');

posix_kill(posix_getpid(),SIGALRM);

pcntl_signal_dispatch();



